<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 <div class="p-6">
        <div class="mb-6">
            <h3 class="text-2xl font-bold">Selamat datang, {{ $user->name }}!</h3>
            <a href="{{ route('invoices.create') }}" class="mt-2 inline-block bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">+ Add Invoice</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-gray-500">Total Produk</div>
                <div class="text-2xl font-bold">{{ $totalProducts }}</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-gray-500">Total Kategori</div>
                <div class="text-2xl font-bold">{{ $totalCategories }}</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-gray-500">Total Customer</div>
                <div class="text-2xl font-bold">{{ $totalCustomers }}</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-gray-500">Total Pendapatan</div>
                <div class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h4 class="text-lg font-semibold mb-4">Produk Penjualan Terbanyak</h4>
            <canvas id="topProductsChart" height="100"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('topProductsChart').getContext('2d');
        const chart = new Chart(ctx, {
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
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>


