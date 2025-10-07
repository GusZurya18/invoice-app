<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Your App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600">Join us today and get started</p>
            </div>

            <!-- Register Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-purple-600"></i>Full Name
                        </label>
                        <div class="relative">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                value="{{ old('name') }}"
                                required 
                                autofocus 
                                autocomplete="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Enter your full name"
                            >
                        </div>
                        <!-- Laravel Error Display -->
                        @error('name')
                            <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-purple-600"></i>Email Address
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                value="{{ old('email') }}"
                                required 
                                autocomplete="username"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Enter your email"
                            >
                        </div>
                        @error('email')
                            <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>Password
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Create a password"
                                oninput="checkPasswordStrength()"
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('password')"
                            >
                                <i class="fas fa-eye" id="toggleIconPassword"></i>
                            </button>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex space-x-1">
                                <div class="h-1 flex-1 bg-gray-200 rounded" id="strength1"></div>
                                <div class="h-1 flex-1 bg-gray-200 rounded" id="strength2"></div>
                                <div class="h-1 flex-1 bg-gray-200 rounded" id="strength3"></div>
                                <div class="h-1 flex-1 bg-gray-200 rounded" id="strength4"></div>
                            </div>
                            <p class="text-xs mt-1 text-gray-600" id="strengthText">Password strength</p>
                        </div>
                        @error('password')
                            <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Confirm your password"
                                oninput="checkPasswordMatch()"
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('password_confirmation')"
                            >
                                <i class="fas fa-eye" id="toggleIconConfirm"></i>
                            </button>
                        </div>
                        <div class="mt-2 text-sm" id="matchText"></div>
                        @error('password_confirmation')
                            <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            required
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mt-1"
                        >
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I agree to the 
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Terms of Service</a> 
                            and 
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 font-semibold transition duration-200 transform hover:scale-105"
                        >
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-800">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    Protected by industry-standard encryption
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId === 'password' ? 'toggleIconPassword' : 'toggleIconConfirm');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBars = ['strength1', 'strength2', 'strength3', 'strength4'];
            const strengthText = document.getElementById('strengthText');
            
            // Reset bars
            strengthBars.forEach(bar => {
                document.getElementById(bar).className = 'h-1 flex-1 bg-gray-200 rounded';
            });
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password) || /[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
            
            const colors = ['bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
            const texts = ['Very Weak', 'Weak', 'Good', 'Strong'];
            const textColors = ['text-red-600', 'text-yellow-600', 'text-blue-600', 'text-green-600'];
            
            if (strength > 0) {
                for (let i = 0; i < strength; i++) {
                    document.getElementById(strengthBars[i]).className = `h-1 flex-1 rounded ${colors[strength - 1]}`;
                }
                strengthText.textContent = texts[strength - 1];
                strengthText.className = `text-xs mt-1 ${textColors[strength - 1]}`;
            } else {
                strengthText.textContent = 'Password strength';
                strengthText.className = 'text-xs mt-1 text-gray-600';
            }
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('matchText');
            
            if (confirmPassword === '') {
                matchText.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchText.textContent = '✓ Passwords match';
                matchText.className = 'mt-2 text-sm text-green-600';
            } else {
                matchText.textContent = '✗ Passwords do not match';
                matchText.className = 'mt-2 text-sm text-red-600';
            }
        }

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const button = form.querySelector('button[type="submit"]');
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';
                button.disabled = true;
            });
        });
    </script>
</body>
</html>