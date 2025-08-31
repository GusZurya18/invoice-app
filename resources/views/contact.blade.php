<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - InvoicePro</title>
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
                <a  href="{{ route('login') }}"      class="bg-white text-purple-700 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition-colors">
                    Sign In
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>

        <!-- Contact Form Section -->
        <div class="flex items-center justify-center px-6 py-12 lg:px-12">
            <div class="w-full max-w-lg">
                <!-- Contact Form Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8">
                    <!-- Logo in form -->
                    <div class="flex items-center justify-center mb-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-purple-600">InvoicePro</span>
                        </div>
                    </div>

                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Contact Us</h1>
                        <p class="text-gray-600">Let's us know your suggestion to grow our invoicing app!</p>
                    </div>

                    <!-- Form -->
                    <form class="space-y-6">
                        <!-- Basic Company Information Section -->
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="w-6 h-6 bg-gray-800 rounded flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">1</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Basic Company Information</h3>
                            </div>

                            <!-- Full Name -->
                            <div class="mb-4">
                                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="fullName" 
                                    name="fullName" 
                                    placeholder="John Doe"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all"
                                    required
                                >
                            </div>

                            <!-- Email Address -->
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="yourmail@gmail.com"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all"
                                    required
                                >
                            </div>

                            <!-- Message -->
                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Message
                                </label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="5"
                                    placeholder="Please describe your issue or question in detail..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all resize-none"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-purple-700 transition-colors shadow-lg flex items-center justify-center space-x-2"
                        >
                            <span>Send Message</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div class="md:hidden fixed inset-0 bg-purple-900 bg-opacity-95 z-50 hidden" id="mobile-menu">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="#" class="text-white text-2xl hover:text-purple-200">Home</a>
            <a href="#" class="text-white text-2xl hover:text-purple-200">Feature</a>
            <a href="#" class="text-purple-200 text-2xl font-medium">Contact</a>
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

        // Add click handler to mobile menu button
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.md\\:hidden button');
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            }

            // Form submission handler
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(form);
                const fullName = formData.get('fullName');
                const email = formData.get('email');
                const message = formData.get('message');

                // Simple validation
                if (!fullName || !email) {
                    alert('Please fill in all required fields.');
                    return;
                }

                // Here you would normally send the data to your server
                alert('Thank you for your message! We will get back to you soon.');
                
                // Reset form
                form.reset();
            });
        });
    </script>
</body>
</html>