<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    $user = auth()->user();
    $totalProducts = \App\Models\Product::count();
    $totalCategories = \App\Models\Category::count();
    $totalCustomers = \App\Models\Customer::count();
    $totalPendapatan = \App\Models\Invoice::where('status', 'paid')->sum('total_amount');

    // Data untuk chart: produk terlaris
    $topProducts = \App\Models\InvoiceItem::selectRaw('product_name, SUM(quantity) as total_sold')
        ->groupBy('product_name')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    return view('dashboard', compact(
        'user',
        'totalProducts',
        'totalCategories',
        'totalCustomers',
        'totalPendapatan',
        'topProducts'
    ));
    }
}
