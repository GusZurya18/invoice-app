<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = Customer::count();
        $totalInvoices = Invoice::count();
        $totalPendapatan = Invoice::where('status', 'paid')->sum('total_amount');

        // Data untuk chart: produk terlaris
        $topProducts = InvoiceItem::selectRaw('product_name, SUM(quantity) as total_sold')
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Data untuk chart persentase penjualan produk
        $sales = InvoiceItem::with('product')
            ->selectRaw('product_id, SUM(quantity) as total_qty')
            ->groupBy('product_id')
            ->get();

        $labels = $sales->map(fn($s) => $s->product?->name ?? 'Unknown');
        $data   = $sales->pluck('total_qty');

        return view('dashboard', compact(
            'user',
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'totalInvoices',
            'totalPendapatan',
            'topProducts',
            'labels',
            'data'
        ));
    }
}