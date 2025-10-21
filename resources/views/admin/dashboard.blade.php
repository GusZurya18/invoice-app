@extends('layouts.admin')

@section('content')
<div class="min-h-screen p-6">
    
    {{-- Header Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali, {{ $adminName }}! 👋</h1>
        <p class="text-gray-600 mb-6">Berikut adalah overview bisnis komprehensif untuk membantu Anda membuat keputusan strategis dan laporan keuangan</p>
        <div class="flex gap-3">
        </div>
    </div>

    {{-- Financial Cards Row 1 --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-emerald-600 text-sm font-semibold">↗ Invoice terbayar</p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Net Profit</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
            <p class="text-blue-600 text-sm font-semibold">↗ Revenue - Expenses</p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-orange-400 to-orange-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Total Expense</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
            <p class="text-red-600 text-sm font-semibold">↗ Total pengeluaran</p>
        </div>
    </div>

    {{-- Financial Cards Row 2 --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Payment Collection Rate</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($paymentCollectionRate, 1) }}%</p>
            <p class="text-purple-600 text-sm font-semibold">{{ $paidInvoices }}/{{ $totalInvoices }} invoice</p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Revenue YTD (After Tax)</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($totalRevenueYTDAfterTax, 0, ',', '.') }}</p>
            <p class="text-indigo-600 text-sm font-semibold">Sudah dipotong pajak 11%</p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="bg-gradient-to-br from-teal-400 to-teal-600 p-3 rounded-2xl w-fit mb-4">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/></svg>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-2">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            <p class="text-teal-600 text-sm font-semibold">Akumulasi total</p>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-blue-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Total Produk</h3>
            <p class="text-2xl font-bold">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-green-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Total Kategori</h3>
            <p class="text-2xl font-bold">{{ $totalCategories }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-purple-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Total Invoice</h3>
            <p class="text-2xl font-bold">{{ $totalInvoices }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-pink-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Total Customer</h3>
            <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-orange-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Total User</h3>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-green-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Invoice Lunas</h3>
            <p class="text-2xl font-bold text-green-600">{{ $paidInvoices }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-5">
            <div class="bg-red-50 p-2.5 rounded-xl w-fit mb-3">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-gray-500 text-xs mb-1">Invoice Belum Lunas</h3>
            <p class="text-2xl font-bold text-red-600">{{ $unpaidInvoices }}</p>
        </div>
    </div>

    {{-- Charts --}}
    <div class="bg-white rounded-3xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-bold mb-4">Grafik Penjualan Bulanan</h3>
        <canvas id="salesChart" style="max-height: 300px;"></canvas>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <h3 class="text-lg font-bold mb-4">Produk Penjualan Terbanyak</h3>
            <canvas id="topProductsChart" style="max-height: 300px;"></canvas>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <h3 class="text-lg font-bold mb-4">Penjualan Berdasarkan Kategori</h3>
            <canvas id="categoryChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6">
        <h3 class="text-lg font-bold mb-4">Persentase Penjualan Produk</h3>
        <canvas id="productPercentageChart" style="max-height: 350px;"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
(function() {
    'use strict';
    
    // Monthly Sales
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Penjualan',
                data: @json($monthlyData),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // Top Products
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($topProducts->pluck('product_name')) !!},
            datasets: [{
                label: 'Total Terjual',
                data: {!! json_encode($topProducts->pluck('total_sold')) !!},
                backgroundColor: '#6366f1',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // Category Sales
    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($categorySales->pluck('category')) !!},
            datasets: [{
                label: 'Total',
                data: {!! json_encode($categorySales->pluck('total_sold')) !!},
                backgroundColor: '#ef4444',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // Product Percentage
    new Chart(document.getElementById('productPercentageChart'), {
        type: 'doughnut',
        data: {
            labels: @json($productLabels),
            datasets: [{
                data: @json($productData),
                backgroundColor: ['#3b82f6', '#22c55e', '#ef4444', '#eab308', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#84cc16', '#06b6d4']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 15, font: { size: 11 } }
                }
            }
        }
    });
})();
</script>
@endsection