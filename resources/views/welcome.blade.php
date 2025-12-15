<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvoicePro - Aplikasi Invoice Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800">
        <!-- Navigation -->
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

            <!-- Navigation Links -->
            <div class="hidden md:flex items-end space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-200 transition-colors">Beranda</a>
                <a href="{{ route('feature') }}" class="text-white hover:text-blue-200 transition-colors">Fitur</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-blue-200 transition-colors">Kontak</a>
            </div>

            <!-- Sign In Button -->
            <div class="hidden md:block">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition-colors">
                    Masuk
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>

        <!-- Hero Section -->
        <div class="flex flex-col lg:flex-row items-center justify-between px-6 py-12 lg:px-12 lg:py-20">
            <!-- Left Content -->
            <div class="flex-1 text-center lg:text-left mb-12 lg:mb-0">
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-tight mb-6">
                    Cari aplikasi
                    <span class="text-blue-200">Invoice yang sederhana?</span>
                </h1>

                <p class="text-xl text-blue-100 mb-8 max-w-lg mx-auto lg:mx-0">
                    Kelola invoice dan pembayaran bisnis Anda secara online dengan mudah.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}"
                        class="bg-white text-blue-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg">
                        Mulai Sekarang
                    </a>
                </div>
            </div>

            <!-- Right Illustration -->
            <div class="flex-1 flex justify-center lg:justify-end">
                <div class="relative">
                    <div
                        class="w-80 h-80 lg:w-96 lg:h-96 bg-blue-500 bg-opacity-30 rounded-full flex items-center justify-center">
                        <div class="relative">
                            <!-- Head -->
                            <div class="w-20 h-20 bg-orange-300 rounded-full relative mb-4 mx-auto">
                                <div class="absolute -top-2 left-2 w-16 h-12 bg-gray-800 rounded-t-full"></div>
                                <div class="absolute top-6 left-4 w-2 h-2 bg-gray-800 rounded-full"></div>
                                <div class="absolute top-6 right-4 w-2 h-2 bg-gray-800 rounded-full"></div>
                                <div
                                    class="absolute top-10 left-1/2 transform -translate-x-1/2 w-4 h-2 border-b-2 border-gray-800 rounded-b-full">
                                </div>
                            </div>

                            <div class="w-24 h-32 bg-indigo-900 rounded-t-3xl mx-auto relative">
                                <div
                                    class="absolute -left-8 top-4 w-6 h-16 bg-orange-300 rounded-full transform rotate-12">
                                </div>
                                <div class="absolute -left-12 top-2 w-4 h-4 bg-orange-300 rounded-full"></div>
                                <div class="absolute -right-6 top-8 w-6 h-12 bg-orange-300 rounded-full"></div>
                            </div>

                            <div
                                class="absolute -right-12 top-8 w-32 h-40 bg-white rounded-lg shadow-xl p-4 transform rotate-6">
                                <div class="text-center mb-3">
                                    <h3 class="text-indigo-600 font-bold text-lg">INVOICE</h3>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-1 bg-blue-300 rounded w-3/4"></div>
                                    <div class="h-1 bg-blue-300 rounded w-1/2"></div>
                                    <div class="h-1 bg-blue-300 rounded w-2/3"></div>
                                    <div class="h-1 bg-blue-300 rounded w-1/3"></div>
                                </div>

                                <div class="absolute right-2 top-12 space-y-2">
                                    <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden fixed inset-0 bg-blue-900 bg-opacity-95 z-50 hidden" id="mobile-menu">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="#" class="text-white text-2xl hover:text-blue-200">Beranda</a>
            <a href="#" class="text-white text-2xl hover:text-blue-200">Fitur</a>
            <a href="#" class="text-white text-2xl hover:text-blue-200">Kontak</a>
            <button class="bg-white text-blue-700 px-8 py-3 rounded-full font-medium">
                Masuk
            </button>
            <button class="text-white text-xl" onclick="toggleMobileMenu()">Tutup</button>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.md\\:hidden button');
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            }
        });
    </script>
</body>

</html>
