<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'InvoicePro')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom styles for navigation */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background-color: #e5e7eb;
            color: #374151;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }
       
        .nav-link:hover {
            background-color: #d1d5db;
            transform: translateX(2px);
        }
       
        .nav-link.active {
            background: linear-gradient(to right, #8b5cf6, #7c3aed);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
       
        .nav-link.active:hover {
            background: linear-gradient(to right, #7c3aed, #6d28d9);
            transform: translateX(2px);
        }
       
        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 20;
            background: linear-gradient(to right, #8b5cf6, #7c3aed);
            color: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem;
            cursor: pointer;
        }
       
        /* Overlay for mobile */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 15;
        }
       
        /* Settings dropdown */
        .settings-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
       
        .settings-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            border-radius: 0.5rem;
            z-index: 1000;
            margin-top: 0.5rem;
        }
       
        .settings-dropdown.active .settings-dropdown-content {
            display: block;
        }
       
        .settings-dropdown-item {
            color: #374151;
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s ease;
        }
       
        .settings-dropdown-item:hover {
            background-color: #f3f4f6;
        }
       
        .settings-dropdown-item:last-child {
            border-bottom: none;
            border-radius: 0 0 0.5rem 0.5rem;
        }
       
        .settings-dropdown-item:first-child {
            border-radius: 0.5rem 0.5rem 0 0;
        }
       
        /* Responsive design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 16;
            }
           
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }
           
            .mobile-menu-btn {
                display: block;
            }
           
            .mobile-overlay.open {
                display: block;
            }
           
            main {
                margin-left: 0 !important;
            }
        }
       
        @media (min-width: 1025px) {
            .sidebar {
                transform: translateX(0) !important;
            }
           
            .mobile-menu-btn {
                display: none;
            }
           
            .mobile-overlay {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 min-h-screen">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuButton">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Main Container with proper layout -->
    <div class="flex min-h-screen">
        <!-- Fixed Sidebar -->
        <div class="sidebar fixed left-0 top-0 h-screen w-64 bg-white backdrop-blur-md p-5 z-10 overflow-y-auto shadow-lg">
            <!-- Logo -->
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <span class="text-black font-semibold text-lg">Admin Panel</span>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800' : 'bg-gray-200 text-black/80 hover:text-white/80 hover:bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800' }} rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'text-white bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800' : 'bg-gray-200 text-black/80 hover:text-white/80 hover:bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800' }} rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    {{ __('Kelola User') }}
                </a>
                
                <a href="{{ route('admin.tasks.index')}}" class="nav-item flex items-center px-4 py-3 bg-gray-200 text-black/80 hover:text-white/80 hover:bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    {{ __('Task User') }}
                </a>

                <a href="{{ route('admin.company-settings.edit')}}" class="nav-item flex items-center px-4 py-3 bg-gray-200 text-black/80 hover:text-white/80 hover:bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    {{ __('Data Perusahaan') }}
                </a>
               
                <!-- Settings Dropdown -->
                <div class="settings-dropdown mt-8">
                    <a href="#" class="flex items-center px-4 py-3 bg-gray-200 text-black/80 hover:text-white/80 hover:bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 rounded-lg transition-colors" onclick="toggleSettingsDropdown(event)">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
                        </svg>
                        Settings
                        <svg class="w-4 h-4 ml-auto transform transition-transform" fill="currentColor" viewBox="0 0 20 20" id="settingsArrow">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <div class="settings-dropdown-content">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="settings-dropdown-item text-red-600 hover:bg-red-50" onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content Area with proper margin -->
        <main class="flex-1 ml-64 min-h-screen">
            <!-- Header Section -->
            <header class="bg-white/10 backdrop-blur-sm shadow-sm">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white">@yield('page-title', 'Admin Dashboard')</h1>
                        <div class="flex items-center space-x-4">
                            @yield('header-actions')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- JavaScript for navigation and mobile menu -->
    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const sidebar = document.querySelector('.sidebar');

        function toggleMobileMenu() {
            sidebar.classList.toggle('open');
            mobileOverlay.classList.toggle('open');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', toggleMobileMenu);
        }
       
        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', toggleMobileMenu);
        }

        // Close menu when clicking on nav links in mobile view (EXCEPT settings dropdown)
        document.querySelectorAll('.nav-item').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1025) {
                    toggleMobileMenu();
                }
            });
        });

        // Settings dropdown functionality
        function toggleSettingsDropdown(event) {
            event.preventDefault();
            event.stopPropagation(); // Prevent event bubbling
            
            const dropdown = event.currentTarget.closest('.settings-dropdown');
            const arrow = document.getElementById('settingsArrow');
           
            dropdown.classList.toggle('active');
           
            // Rotate arrow
            if (dropdown.classList.contains('active')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.settings-dropdown');
            const arrow = document.getElementById('settingsArrow');
           
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
                if (arrow) {
                    arrow.style.transform = 'rotate(0deg)';
                }
            }
        });

        // Close sidebar when clicking dropdown items in mobile
        document.querySelectorAll('.settings-dropdown-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 1025) {
                    setTimeout(() => {
                        toggleMobileMenu();
                    }, 200); // Small delay for better UX
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('open');
                mobileOverlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    </script>

    @yield('scripts')
</body>
</html>