<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur - InvoicePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800">
        <!-- Navigasi -->
        <nav class="flex items-center justify-between px-6 py-4 lg:px-12">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white">InvoicePro</span>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-200 transition-colors">Beranda</a>
                <a href="{{ route('feature') }}" class="text-white hover:text-blue-200 transition-colors">Fitur</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-blue-200 transition-colors">Kontak</a>
            </div>

            <!-- Tombol Masuk -->
            <div class="hidden md:block">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition-colors">
                    Masuk
                </a>
            </div>

            <!-- Tombol Mobile -->
            <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>

        <!-- Section Fitur -->
        <div class="px-6 py-12 lg:px-12">
            <!-- Header -->
            <div class="max-w-4xl mx-auto mb-12">
                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        Fitur Lengkap untuk Pengelolaan Invoice Cerdas
                        <span class="text-yellow-400 ml-2">⚡</span>
                    </h1>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Semua alat yang Anda butuhkan untuk membuat invoice,<br>
                        memantau pembayaran, dan mengembangkan bisnis Anda.
                    </p>
                </div>
            </div>

            <!-- Grid Fitur -->
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Fitur 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Pembuatan Invoice Otomatis</h3>
                    <p class="text-gray-600 text-center text-sm">Buat invoice profesional hanya dalam hitungan detik
                        dengan template siap pakai dan mudah disesuaikan.</p>
                </div>
                <!-- Fitur 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Manajemen Pelanggan</h3>
                    <p class="text-gray-600 text-center text-sm">Kelola data pelanggan, riwayat transaksi, dan invoice
                        dalam satu dashboard terpusat.</p>
                </div>
                <!-- Fitur 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Pelacakan Pembayaran</h3>
                    <p class="text-gray-600 text-center text-sm">Pantau status pembayaran secara real-time: lunas, belum
                        dibayar, atau jatuh tempo.</p>
                </div>
                <!-- Fitur 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Laporan Keuangan</h3>
                    <p class="text-gray-600 text-center text-sm">Dapatkan laporan penjualan dan pemasukan secara
                        otomatis untuk membantu pengambilan keputusan.</p>
                </div>
                <!-- Fitur 5 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Ekspor & Cetak Invoice</h3>
                    <p class="text-gray-600 text-center text-sm">Unduh invoice dalam format PDF atau cetak langsung
                        sesuai kebutuhan bisnis Anda.</p>
                </div>
                <!-- Fitur 6 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Multi Perusahaan</h3>
                    <p class="text-gray-600 text-center text-sm">Kelola lebih dari satu perusahaan atau brand dalam satu
                        akun dengan mudah.</p>
                </div>
                <!-- Fitur 7 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Keamanan Data</h3>
                    <p class="text-gray-600 text-center text-sm">Data invoice dan pelanggan Anda tersimpan aman dengan
                        sistem keamanan modern.</p>
                </div>
                <!-- Fitur 8 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Akses Multi Perangkat</h3>
                    <p class="text-gray-600 text-center text-sm">Akses aplikasi InvoicePro kapan saja melalui laptop,
                        tablet, maupun smartphone.</p>
                </div>
                <!-- Fitur 9 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Pengaturan Pajak & Diskon</h3>
                    <p class="text-gray-600 text-center text-sm">Atur pajak, diskon, dan total otomatis agar perhitungan
                        invoice selalu akurat.</p>
                </div>
            </div>

            <!-- CTA -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Siap Menggunakan InvoicePro?</h2>
                    <p class="text-gray-600 text-lg mb-8">Daftar sekarang dan kelola invoice bisnis Anda dengan lebih
                        mudah.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-lg">Mulai
                            Sekarang</button>
                        <button
                            class="bg-transparent border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-colors">Tambahkan
                            Perusahaan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="md:hidden fixed inset-0 bg-blue-900 bg-opacity-95 z-50 hidden" id="mobile-menu">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="#" class="text-white text-2xl">Beranda</a>
            <a href="#" class="text-blue-200 text-2xl font-medium">Fitur</a>
            <a href="#" class="text-white text-2xl">Kontak</a>
            <button class="bg-white text-blue-700 px-8 py-3 rounded-full font-medium">Masuk</button>
            <button class="text-white text-xl" onclick="toggleMobileMenu()">Tutup</button>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
</body>

</html>
