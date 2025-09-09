<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers      = \App\Models\User::count(); // <--- ini tambahan buat nampilin total user di dashboard admin
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalInvoices   = Invoice::count();
        $totalCustomers  = Customer::count();
        $totalPendapatan = Invoice::where('status', 'paid')->sum('total_amount');

        $paidInvoices   = Invoice::where('status', 'paid')->count();
        $unpaidInvoices = Invoice::where('status', '!=', 'paid')->count();

         $monthlySales = Invoice::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Format untuk Chart.js
        $months = [1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $labels = [];
        $data   = [];

        foreach ($monthlySales as $row) {
            $labels[] = $months[$row->month];
            $data[]   = $row->total;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalCategories',
            'totalInvoices',
            'totalCustomers',
            'totalPendapatan',
            'paidInvoices',
            'unpaidInvoices',
            'labels',
            'data'
        ));
    }
}
