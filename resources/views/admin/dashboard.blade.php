@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Admin! 👋</h1>
            <p class="text-gray-600 mt-1">Berikut ringkasan statistik sistem Anda.</p>
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
                <p class="text-3xl font-bold text-teal-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
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

    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total Penjualan',
                data: @json($data),
                borderColor: 'rgb(59, 130, 246)', // Tailwind blue-500
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: value => 'Rp ' + value.toLocaleString('id-ID') }
                }
            }
        }
    });
</script>
@endsection
