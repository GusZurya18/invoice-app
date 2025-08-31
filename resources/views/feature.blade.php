<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - InvoicePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800">
        <!-- Navigation -->
        <nav class="flex items-center justify-between px-6 py-4 lg:px-12">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white">InvoicePro</span>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-purple-200 transition-colors">Home</a>
                <a href="{{ route('feature') }}" class="text-white hover:text-purple-200 transition-colors">Feature</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-purple-200 transition-colors">Contact</a>
            </div>

            <!-- Sign In Button -->
            <div class="hidden md:block">
                <a  href="{{ route('login') }}" class="bg-white text-purple-700 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition-colors">
                    Sign In
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>

        <!-- Features Section -->
        <div class="px-6 py-12 lg:px-12">
            <!-- Header Section -->
            <div class="max-w-4xl mx-auto mb-12">
                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        Powerful Features for Smart Invoicing
                        <span class="text-yellow-400 ml-2">⚡</span>
                    </h1>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Discover all the tools you need to manage your invoices,<br>
                        track payments, and grow your business efficiently.
                    </p>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 5 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 6 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 7 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 8 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>

                <!-- Feature Card 9 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-3">Smart Invoice Creative</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Create Professional invoices in second with our intuitive templates. Customize your invoice and export your invoices fast with this features.
                    </p>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Ready to Experience These Features?</h2>
                    <p class="text-gray-600 text-lg mb-8">Let's go join us!</p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors shadow-lg">
                            Get's Started
                        </button>
                        <button class="bg-transparent border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition-colors">
                            Add Your Company!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div class="md:hidden fixed inset-0 bg-purple-900 bg-opacity-95 z-50 hidden" id="mobile-menu">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="#" class="text-white text-2xl hover:text-purple-200">Home</a>
            <a href="#" class="text-purple-200 text-2xl font-medium">Feature</a>
            <a href="#" class="text-white text-2xl hover:text-purple-200">Contact</a>
            <button class="bg-white text-purple-700 px-8 py-3 rounded-full font-medium">
                Sign In
            </button>
            <button class="text-white text-xl" onclick="toggleMobileMenu()">Close</button>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Add hover effects to feature cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.bg-white.rounded-2xl.p-6');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>