<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CompanySetting;
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
        $company = CompanySetting::current(); // TAMBAHAN
        
        return view('invoices.create', compact('customers', 'products', 'company')); // UPDATED
    }

    public function show(Invoice $invoice, Request $request) {
        $lang = $request->get('lang', 'id');
        app()->setLocale($lang);

        return view('invoices.show', compact('invoice'));
    }

    public function store(Request $request) {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'tax_rate' => 'nullable|numeric|min:0|max:100', // TAMBAHAN
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        DB::transaction(function () use ($request) {
            // Ambil tax rate: dari input atau default company
            $company = CompanySetting::current();
            $taxRate = $request->filled('tax_rate') ? $request->tax_rate : $company->tax_rate;
            
            $invoice = Invoice::create([
                'code' => 'INV' . time(),
                'customer_id' => $request->customer_id,
                'status' => $request->status,
                'notes' => $request->notes,
                'discount_percent' => $request->discount_percent ?? 0,
                'tax_rate' => $taxRate, // TAMBAHAN
                'payment_proof' => $request->hasFile('payment_proof') 
                    ? $request->file('payment_proof')->store('payments', 'public') 
                    : null,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'paid_status' => 'pending',
            ]);

            $subtotal = 0;

            foreach($request->items as $item){
                $product = Product::lockForUpdate()->find($item['product_id']);
                $lineTotal = $product->price * $item['quantity'];

                $invoice->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total' => $lineTotal
                ]);

                $subtotal += $lineTotal;

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

            // Hitung total dengan diskon dan pajak
            $discount = ($request->discount_percent ?? 0) * $subtotal / 100;
            $subtotalAfterDiscount = $subtotal - $discount;
            
            $taxAmount = $subtotalAfterDiscount * ($taxRate / 100);
            
            $grandTotal = $subtotalAfterDiscount + $taxAmount;

            $invoice->update([
                'total_amount' => $grandTotal
            ]);
        });

        return redirect()->route('invoices.index')->with('success','Invoice berhasil dibuat');
    }

    public function edit(Invoice $invoice) {
        $customers = Customer::all();
        $products = Product::all();
        $company = CompanySetting::current(); // TAMBAHAN
        
        return view('invoices.edit', compact('invoice', 'customers', 'products', 'company')); // UPDATED
    }

    public function update(Request $request, Invoice $invoice) {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'tax_rate' => 'nullable|numeric|min:0|max:100', // TAMBAHAN
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

            // Ambil tax rate
            $company = CompanySetting::current();
            $taxRate = $request->filled('tax_rate') ? $request->tax_rate : $company->tax_rate;

            $invoice->update([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
                'notes' => $request->notes,
                'discount_percent' => $request->discount_percent ?? 0,
                'tax_rate' => $taxRate, // TAMBAHAN
                'payment_proof' => $request->hasFile('payment_proof') 
                    ? $request->file('payment_proof')->store('payments', 'public') 
                    : $invoice->payment_proof,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'paid_status' => $request->status === 'paid' ? 'done' : 'pending',
            ]);

            // hapus item lama
            $invoice->items()->delete();

            $subtotal = 0;

            foreach($request->items as $item){
                $product = Product::lockForUpdate()->find($item['product_id']);
                $lineTotal = $product->price * $item['quantity'];

                $invoice->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total' => $lineTotal
                ]);

                $subtotal += $lineTotal;

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

            // Hitung total dengan diskon dan pajak
            $discount = ($request->discount_percent ?? 0) * $subtotal / 100;
            $subtotalAfterDiscount = $subtotal - $discount;
            $taxAmount = $subtotalAfterDiscount * ($taxRate / 100);
            $grandTotal = $subtotalAfterDiscount + $taxAmount;

            $invoice->update([
                'total_amount' => $grandTotal
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

    public function pdf(Invoice $invoice, Request $request)
    {
        $lang = $request->get('lang', 'id');
        app()->setLocale($lang);
        
        $pdf = Pdf::loadView('invoices.invoice_pdf', compact('invoice'));
        return $pdf->download($invoice->code . '_' . $lang . '.pdf');
    }

    public function bulkDelete(Request $request)
    {
        // Decode JSON dari frontend jika berupa string
        $invoiceIds = $request->invoice_ids;
        if (is_string($invoiceIds)) {
            $invoiceIds = json_decode($invoiceIds, true);
        }

        // Validasi data
        if (empty($invoiceIds) || !is_array($invoiceIds)) {
            return redirect()->back()->with('error', 'Tidak ada invoice yang dipilih.');
        }

        // Validasi semua ID ada di database
        $existingInvoices = Invoice::whereIn('id', $invoiceIds)->pluck('id')->toArray();
        $invalidIds = array_diff($invoiceIds, $existingInvoices);
        
        if (!empty($invalidIds)) {
            return redirect()->back()->with('error', 'Beberapa invoice tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($invoiceIds) {
                $invoices = Invoice::whereIn('id', $invoiceIds)->with('items')->get();

                foreach ($invoices as $invoice) {
                    // Restore stok jika invoice sudah dibayar
                    if ($invoice->status === 'paid') {
                        foreach($invoice->items as $item){
                            $product = Product::lockForUpdate()->find($item->product_id);
                            if ($product) {
                                $product->increment('stock', $item->quantity);
                                Log::info("Restore stok {$product->name} karena invoice dihapus (bulk)", [
                                    'quantity' => $item->quantity,
                                    'after' => $product->fresh()->stock
                                ]);
                            }
                        }
                    }

                    // Hapus invoice
                    $invoice->delete();
                }
            });

            $count = count($invoiceIds);
            return redirect()->back()->with('success', "{$count} invoice berhasil dihapus.");

        } catch (\Exception $e) {
            Log::error('Bulk delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus invoice: ' . $e->getMessage());
        }
    }
}