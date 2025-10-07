@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang,{{ $adminName }}👋</h1>
        <p class="text-gray-600 mt-1">Berikut ringkasan statistik sistem Anda.</p>
    </div>

        {{-- 🔥 NEW FINANCIAL METRICS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        {{-- Total Revenue --}}
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-emerald-100 text-sm font-medium">Total Revenue</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-emerald-100 text-xs mt-1">Invoice terbayar</p>
                </div>
                <div class="bg-emerald-400 bg-opacity-30 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Net Profit --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-blue-100 text-sm font-medium">Net Profit</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
                    <p class="text-blue-100 text-xs mt-1">Revenue - Expenses</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Expense --}}
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-red-100 text-sm font-medium">Total Expense</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    <p class="text-red-100 text-xs mt-1">Total pengeluaran</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Payment Collection Rate --}}
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-purple-100 text-sm font-medium">Payment Collection Rate</h3>
                    <p class="text-2xl font-bold">{{ number_format($paymentCollectionRate, 1) }}%</p>
                    <p class="text-purple-100 text-xs mt-1">{{ $paidInvoices }}/{{ $totalInvoices }} invoice</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Revenue YTD (After Tax) --}}
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-indigo-100 text-sm font-medium">Revenue YTD (After Tax)</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalRevenueYTDAfterTax, 0, ',', '.') }}</p>
                    <p class="text-indigo-100 text-xs mt-1">Sudah dipotong pajak 11%</p>
                </div>
                <div class="bg-indigo-400 bg-opacity-30 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Produk</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Kategori</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalCategories }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Invoice</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalInvoices }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Customer</h3>
            <p class="text-3xl font-bold text-pink-600">{{ $totalCustomers }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total User</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-teal-600">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Invoice Lunas</h3>
            <p class="text-3xl font-bold text-green-600">{{ $paidInvoices }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Invoice Belum Lunas</h3>
            <p class="text-3xl font-bold text-red-600">{{ $unpaidInvoices }}</p>
        </div>
    </div>

    {{-- Grafik Penjualan Bulanan --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Penjualan Bulanan</h3>
        <canvas id="salesChart" height="100"></canvas>
    </div>
    
    {{-- Produk Terbanyak --}}
    <div class="bg-white rounded-2xl shadow p-6 mt-6">
        <h4 class="text-lg font-semibold mb-4">Produk Penjualan Terbanyak</h4>
        <canvas id="topProductsChart" height="100"></canvas>
    </div>

    {{-- Persentase Produk --}}
    <div class="bg-white rounded-2xl shadow p-6 mt-6">
        <h3 class="text-lg font-bold mb-4">Persentase Penjualan Produk</h3>
        <canvas id="productPercentageChart" height="150"></canvas>
    </div>

    {{-- Penjualan per Kategori --}}
    <div class="bg-white rounded-2xl shadow p-6 mt-6">
        <h2 class="text-lg font-bold mb-4">Penjualan Berdasarkan Kategori</h2>
        <canvas id="categoryChart" height="120"></canvas>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    // 🔹 Grafik Penjualan Bulanan
    new Chart(document.getElementById('salesChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Total Penjualan',
                data: @json($monthlyData),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } }
        }
    });

    // 🔹 Top Products
    new Chart(document.getElementById('topProductsChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($topProducts->pluck('product_name')) !!},
            datasets: [{
                label: 'Total Terjual',
                data: {!! json_encode($topProducts->pluck('total_sold')) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // 🔹 Persentase Produk
    new Chart(document.getElementById('productPercentageChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: @json($productLabels),
            datasets: [{
                label: 'Persentase Penjualan',
                data: @json($productData),
                backgroundColor: [
                    '#3b82f6','#22c55e','#ef4444','#eab308',
                    '#8b5cf6','#ec4899','#14b8a6','#f97316',
                    '#84cc16','#06b6d4'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 🔹 Category Chart
    new Chart(document.getElementById('categoryChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($categorySales->pluck('category')) !!},
            datasets: [{
                label: 'Total Terjual',
                data: {!! json_encode($categorySales->pluck('total_sold')->map(fn($v) => (int) $v)) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
