<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::latest()->paginate(15);

        $totalInvoices = Invoice::count();
        $paidInvoices = Invoice::where('status', 'paid')->count();
        $unpaidInvoices = Invoice::where('status', 'draft')
        ->orWhere('paid_status','overdue')->count();
        $pendingInvoices = Invoice::where('status', 'pending')->count();

        return view('invoices.index', compact(
            'invoices',
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'pendingInvoices'
        ));
    }

    public function create() {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('customers','products'));
    }

public function store(Request $request) {
    $request->validate([
        'customer_id'=>'required|exists:customers,id',
        'status'=>'required',
        'items'=>'required|array',
        'items.*.product_id'=>'required|exists:products,id',
        'items.*.quantity'=>'required|numeric|min:1',
        'discount_percent'=>'nullable|numeric|min:0|max:100',
        'start_date' => 'nullable|date',
        'due_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    DB::transaction(function () use ($request) {
        $invoice = Invoice::create([
            'code'=>'INV'.time(),
            'customer_id'=>$request->customer_id,
            'status'=>$request->status,
            'notes'=>$request->notes,
            'discount_percent'=>$request->discount_percent ?? 0,
            'payment_proof'=>$request->hasFile('payment_proof') ? $request->file('payment_proof')->store('payments','public') : null,
            'start_date' => $request->start_date,
            'due_date'   => $request->due_date,
            'paid_status'=> 'pending',
        ]);

        $total = 0;

        foreach($request->items as $item){
            $product = Product::lockForUpdate()->find($item['product_id']);
            $lineTotal = $product->price * $item['quantity'];

            $invoice->items()->create([
                'product_id'=>$product->id,
                'product_name'=>$product->name,
                'quantity'=>$item['quantity'],
                'unit_price'=>$product->price,
                'total'=>$lineTotal
            ]);

            $total += $lineTotal;

            if ($request->status === 'paid' && $product) {
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup untuk produk {$product->name}");
                }
                $product->decrement('stock', $item['quantity']);
                Log::info("Decrement stok {$product->name}", [
                    'before' => $product->stock + $item['quantity'],
                    'after' => $product->fresh()->stock
                ]);
            }
        }

        // hitung diskon dan simpan total_amount
        $discount = ($request->discount_percent ?? 0) * $total / 100;
        $finalTotal = $total - $discount;

        $invoice->update([
            'total_amount' => $finalTotal
        ]);
    });

    return redirect()->route('invoices.index')->with('success','Invoice berhasil dibuat');
}


    public function edit(Invoice $invoice) {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.edit', compact('invoice','customers','products'));
    }

public function update(Request $request, Invoice $invoice) {
    $request->validate([
        'customer_id'=>'required|exists:customers,id',
        'status'=>'required',
        'items'=>'required|array',
        'items.*.product_id'=>'required|exists:products,id',
        'items.*.quantity'=>'required|numeric|min:1',
        'discount_percent'=>'nullable|numeric|min:0|max:100'
    ]);

    DB::transaction(function () use ($request, $invoice) {
        $oldStatus = $invoice->status;

        // rollback stok kalau sebelumnya paid
        if ($oldStatus === 'paid') {
            foreach($invoice->items as $oldItem){
                $product = Product::lockForUpdate()->find($oldItem->product_id);
                if ($product) {
                    $product->increment('stock', $oldItem->quantity);
                    Log::info("Rollback stok {$product->name}", [
                        'after' => $product->fresh()->stock
                    ]);
                }
            }
        }

        $invoice->update([
            'customer_id'=>$request->customer_id,
            'status'=>$request->status,
            'notes'=>$request->notes,
            'discount_percent'=>$request->discount_percent ?? 0,
            'payment_proof'=>$request->hasFile('payment_proof') ? $request->file('payment_proof')->store('payments','public') : $invoice->payment_proof,
            'start_date' => $request->start_date,
            'due_date'   => $request->due_date,
            'paid_status'=> $request->status === 'paid' ? 'done' : 'pending',
        ]);

        // hapus item lama
        $invoice->items()->delete();

        $total = 0;

        foreach($request->items as $item){
            $product = Product::lockForUpdate()->find($item['product_id']);
            $lineTotal = $product->price * $item['quantity'];

            $invoice->items()->create([
                'product_id'=>$product->id,
                'product_name'=>$product->name,
                'quantity'=>$item['quantity'],
                'unit_price'=>$product->price,
                'total'=>$lineTotal
            ]);

            $total += $lineTotal;

            if ($request->status === 'paid' && $product) {
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup untuk produk {$product->name}");
                }
                $product->decrement('stock', $item['quantity']);
                Log::info("Update decrement stok {$product->name}", [
                    'after' => $product->fresh()->stock
                ]);
            }
        }

        // hitung diskon dan simpan total_amount
        $discount = ($request->discount_percent ?? 0) * $total / 100;
        $finalTotal = $total - $discount;

        $invoice->update([
            'total_amount' => $finalTotal
        ]);
    });

    return redirect()->route('invoices.index')->with('success','Invoice berhasil diupdate');
}


    public function destroy(Invoice $invoice){
        DB::transaction(function () use ($invoice) {
            if ($invoice->status === 'paid') {
                foreach($invoice->items as $item){
                    $product = Product::lockForUpdate()->find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                        Log::info("Restore stok {$product->name} karena invoice dihapus", [
                            'after' => $product->fresh()->stock
                        ]);
                    }
                }
            }
            $invoice->delete();
        });

        return back()->with('success','Invoice berhasil dihapus');
    }

    public function pdf(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.invoice_pdf', compact('invoice'));
        return $pdf->download($invoice->code.'.pdf');
    }
}
