<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        //Ambil Data Admin
        $currentAdmin = Auth::user();
        $adminName = $currentAdmin->name ?? 'Admin';
        // Total Statistik Existing
        $totalUsers      = User::count();
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalInvoices   = Invoice::count();
        $totalCustomers  = Customer::count();
        $totalPendapatan = Invoice::sum('total_amount');
        $paidInvoices    = Invoice::where('status', 'paid')->count();
        $unpaidInvoices  = Invoice::where('status', 'unpaid')->count();

        //  METRICS BARU
        
        // 1. Total Revenue (semua invoice paid)
        $totalRevenue = Invoice::where('status', 'paid')->sum('total_amount');
        
        // 2. Total Expense (asumsi cost = 60% dari selling price)
        $totalExpense = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', 'paid')
            ->sum(DB::raw('invoice_items.quantity * (products.price * 0.6)'));
            // Asumsi cost = 60% dari selling price
        
        // 3. Net Profit
        $netProfit = $totalRevenue - $totalExpense;
        
        // 4. Payment Collection Rate (% invoice yang udah dibayar)
        $paymentCollectionRate = $totalInvoices > 0 ? ($paidInvoices / $totalInvoices) * 100 : 0;
        
        // 5. Total Revenue YTD (Year To Date) - sudah dipotong pajak
        $taxRate = 0.11; // PPN 11% - sesuaikan dengan kebutuhan
        $totalRevenueYTD = Invoice::where('status', 'paid')
            ->whereYear('created_at', date('Y'))
            ->sum('total_amount');
        $totalRevenueYTDAfterTax = $totalRevenueYTD * (1 - $taxRate);

        // Penjualan Bulanan (existing code)
        $monthlySales = Invoice::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $months        = [1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $monthlyLabels = [];
        $monthlyData   = [];

        foreach ($monthlySales as $row) {
            $monthlyLabels[] = $months[$row->month];
            $monthlyData[]   = $row->total;
        }

        // Top Products
        $topProducts = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->select('products.name as product_name', DB::raw('SUM(invoice_items.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Persentase Produk
        $salesData = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(invoice_items.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        $productLabels = $salesData->pluck('name');
        $productData   = $salesData->pluck('total_sold');

        // Kategori
        $categorySales = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(invoice_items.quantity) as total_sold'))
            ->groupBy('categories.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            // Existing data
            'totalUsers',
            'totalProducts',
            'totalCategories',
            'totalInvoices',
            'totalCustomers',
            'totalPendapatan',
            'paidInvoices',
            'unpaidInvoices',
            'monthlyLabels',
            'monthlyData',
            'productLabels',
            'productData',
            'topProducts',
            'categorySales',
            
            //  New metrics
            'totalRevenue',
            'totalExpense',
            'netProfit',
            'paymentCollectionRate',
            'totalRevenueYTD',
            'totalRevenueYTDAfterTax',

            // Admin Data
            'currentAdmin',
            'adminName'

        ));
    }
}