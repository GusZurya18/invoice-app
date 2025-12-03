<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\User;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil company settings
        $company = CompanySetting::current();
        
        // Ambil tahun yang dipilih atau default tahun ini
        $selectedYear = $request->get('year', date('Y'));
        
        // Generate daftar tahun (5 tahun ke belakang)
        $availableYears = [];
        $currentYear = date('Y');
        for ($i = 0; $i < 5; $i++) {
            $availableYears[] = $currentYear - $i;
        }
        
        //Ambil Data Admin
        $currentAdmin = Auth::user();
        $adminName = $currentAdmin->name ?? 'Admin';
        
        // Total Statistik (untuk tahun yang dipilih)
        $totalUsers      = User::count();
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalInvoices   = Invoice::whereYear('created_at', $selectedYear)->count();
        $totalCustomers  = Customer::count();
        $totalPendapatan = Invoice::whereYear('created_at', $selectedYear)->sum('total_amount');
        $paidInvoices    = Invoice::where('status', 'paid')->whereYear('created_at', $selectedYear)->count();
        $unpaidInvoices  = Invoice::where('status', '!=', 'paid')->whereYear('created_at', $selectedYear)->count();

        // METRICS (untuk tahun yang dipilih)
        
        // 1. Total Revenue
        $totalRevenue = Invoice::where('status', 'paid')
            ->whereYear('created_at', $selectedYear)
            ->sum('total_amount');
        
        // 2. Total Expense
        $totalExpense = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', 'paid')
            ->whereYear('invoices.created_at', $selectedYear)
            ->sum(DB::raw('invoice_items.quantity * (products.price * 0.6)'));
        
        // 3. Net Profit
        $netProfit = $totalRevenue - $totalExpense;
        
        // 4. Payment Collection Rate
        $paymentCollectionRate = $totalInvoices > 0 ? ($paidInvoices / $totalInvoices) * 100 : 0;
        
        // 5. Total Revenue YTD After Tax
        $taxRate = $company->tax_rate / 100;
        $totalRevenueYTD = Invoice::where('status', 'paid')
            ->whereYear('created_at', $selectedYear)
            ->sum('total_amount');
        $totalRevenueYTDAfterTax = $totalRevenueYTD * (1 - $taxRate);

        // Penjualan Bulanan (untuk tahun yang dipilih)
        $monthlySales = Invoice::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', $selectedYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $months        = [1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $monthlyLabels = [];
        $monthlyData   = [];

        // Initialize all months with 0
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = $months[$i];
            $monthlyData[] = 0;
        }

        // Fill actual data
        foreach ($monthlySales as $row) {
            $monthlyData[$row->month - 1] = $row->total;
        }

        // Top Products (untuk tahun yang dipilih)
        $topProducts = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->whereYear('invoices.created_at', $selectedYear)
            ->select('products.name as product_name', DB::raw('SUM(invoice_items.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Persentase Produk (untuk tahun yang dipilih)
        $salesData = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->whereYear('invoices.created_at', $selectedYear)
            ->select('products.name', DB::raw('SUM(invoice_items.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        $productLabels = $salesData->pluck('name');
        $productData   = $salesData->pluck('total_sold');

        // Kategori (untuk tahun yang dipilih)
        $categorySales = DB::table('invoice_items')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->whereYear('invoices.created_at', $selectedYear)
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
            
            // New metrics
            'totalRevenue',
            'totalExpense',
            'netProfit',
            'paymentCollectionRate',
            'totalRevenueYTD',
            'totalRevenueYTDAfterTax',

            // Admin Data
            'currentAdmin',
            'adminName',
            
            // Company Data
            'company',
            
            // Year Filter Data
            'selectedYear',
            'availableYears'
        ));
    }
}