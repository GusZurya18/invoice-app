@extends('layouts.admin')

@section('content')
    <div class="p-4 md:p-8" style="background: ; min-height: 100vh;">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 md:mb-8 text-white">Kelola User</h1>

        @if(session('success'))
            <div class="text-white p-4 rounded-xl mb-6 shadow-sm" style="background-color: #10b981;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="text-white p-4 rounded-xl mb-6 shadow-sm" style="background-color: #ef4444;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-2xl p-5 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-gray-800">{{ $users->total() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Total Users</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #6366f1;">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <!-- Table Header Actions -->
            <div class="px-4 md:px-6 py-4 border-b" style="border-color: #e2e8f0;">
                <div class="flex flex-col space-y-3">
                    <!-- Top Row: Filter Tabs and Search -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 gap-3">
                        <!-- Filter Tabs -->
                        <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0">
                            <a href="{{ route('admin.users.index', ['search' => request('search')]) }}" 
                               class="px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium whitespace-nowrap {{ request('role') == null ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                               style="{{ request('role') == null ? 'background-color: #6366f1;' : '' }}">
                                All
                            </a>
                            <a href="{{ route('admin.users.index', ['role' => 'admin', 'search' => request('search')]) }}" 
                               class="px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium whitespace-nowrap {{ request('role') == 'admin' ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                               style="{{ request('role') == 'admin' ? 'background-color: #6366f1;' : '' }}">
                                Admin
                            </a>
                            <a href="{{ route('admin.users.index', ['role' => 'user', 'search' => request('search')]) }}" 
                               class="px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium whitespace-nowrap {{ request('role') == 'user' ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                               style="{{ request('role') == 'user' ? 'background-color: #6366f1;' : '' }}">
                                User
                            </a>
                        </div>

                        <!-- Search Bar -->
                        <div class="flex items-center gap-2">
                            <form action="{{ route('admin.users.index') }}" method="GET" class="flex-1 md:flex-none" id="searchForm">
                                <input type="hidden" name="role" value="{{ request('role') }}">
                                <div class="relative flex items-center">
                                    <input type="text" 
                                           name="search" 
                                           id="searchInput"
                                           value="{{ request('search') }}"
                                           placeholder="Cari nama atau email..." 
                                           class="w-full md:w-64 pl-10 pr-20 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           style="border-color: #e2e8f0;">
                                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <button type="submit" 
                                            class="absolute right-2 px-3 py-1 rounded-md text-white text-xs font-medium hover:opacity-90 transition"
                                            style="background-color: #6366f1;">
                                        Cari
                                    </button>
                                </div>
                            </form>

                            @if(request('search'))
                                <a href="{{ route('admin.users.index', ['role' => request('role')]) }}" 
                                   class="p-2 rounded-lg hover:bg-gray-50 text-gray-600" title="Clear search">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Active Search Info -->
                    @if(request('search'))
                        <div class="flex items-center justify-between bg-blue-50 px-4 py-2 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm text-blue-800">
                                    Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong>
                                    <span class="text-blue-600">({{ $users->total() }} user ditemukan)</span>
                                </span>
                            </div>
                            <a href="{{ route('admin.users.index', ['role' => request('role')]) }}" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Hapus filter
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            @if($users->count() > 0)
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr style="background-color: #f1f5f9;">
                                <th class="p-4 text-left">
                                    <input type="checkbox" class="w-4 h-4 rounded" style="accent-color: #6366f1;">
                                </th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                <th class="p-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50 transition duration-150" style="border-color: #f1f5f9;">
                                <td class="p-4">
                                    <input type="checkbox" class="w-4 h-4 rounded" style="accent-color: #6366f1;">
                                </td>
                                <td class="p-4">
                                    <span class="text-sm font-medium text-gray-700">{{ $user->id }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="text-sm font-semibold text-gray-900">{{ $user->name }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="text-sm text-gray-600">{{ $user->email }}</span>
                                </td>
                                <td class="p-4">
                                    @if($user->role == 'admin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold" style="background-color: #dbeafe; color: #1e40af;">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                            </svg>
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold" style="background-color: #dcfce7; color: #166534;">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                              onsubmit="return confirm('Yakin hapus user ini?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-red-200 transition" style="background-color: #fee2e2;">
                                                <svg class="w-4 h-4" style="color: #dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden divide-y" style="border-color: #f1f5f9;">
                    @foreach($users as $user)
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-xs font-medium text-gray-500">ID: {{ $user->id }}</span>
                                    @if($user->role == 'admin')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold" style="background-color: #dbeafe; color: #1e40af;">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                            </svg>
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold" style="background-color: #dcfce7; color: #166534;">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-base font-bold text-gray-900 mb-1">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus user ini?')" class="inline-block ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-lg flex items-center justify-center hover:bg-red-200 transition" style="background-color: #fee2e2;">
                                    <svg class="w-4 h-4" style="color: #dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="px-4 md:px-6 py-4 border-t" style="border-color: #e2e8f0; background-color: #fafbfc;">
                    @if($users->hasPages())
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                            <!-- Info Text -->
                            <div class="text-xs md:text-sm text-gray-600 text-center md:text-left">
                                Menampilkan <span class="font-semibold text-gray-900">{{ $users->firstItem() }}</span> - 
                                <span class="font-semibold text-gray-900">{{ $users->lastItem() }}</span> dari 
                                <span class="font-semibold text-gray-900">{{ $users->total() }}</span> user
                            </div>
                            
                            <!-- Pagination Controls -->
                            <div class="flex items-center justify-center space-x-2">
                                {{-- Previous Button --}}
                                @if($users->onFirstPage())
                                    <span class="px-3 md:px-4 py-2 rounded-lg text-gray-400 cursor-not-allowed text-xs md:text-sm font-medium" style="background-color: #f1f5f9;">
                                        <span class="hidden md:inline">← Previous</span>
                                        <span class="md:hidden">←</span>
                                    </span>
                                @else
                                    <a href="{{ $users->appends(request()->except('page'))->previousPageUrl() }}" 
                                       class="px-3 md:px-4 py-2 rounded-lg text-white text-xs md:text-sm font-medium hover:opacity-90 transition" style="background-color: #6366f1;">
                                        <span class="hidden md:inline">← Previous</span>
                                        <span class="md:hidden">←</span>
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                <div class="flex space-x-1">
                                    @php
                                        $start = max(1, $users->currentPage() - 1);
                                        $end = min($users->lastPage(), $users->currentPage() + 1);
                                    @endphp
                                    
                                    @if($start > 1)
                                        <a href="{{ $users->appends(request()->except('page'))->url(1) }}" 
                                           class="w-8 md:w-10 h-8 md:h-10 rounded-lg text-xs md:text-sm font-medium flex items-center justify-center hover:bg-gray-100 transition" style="background-color: #f8fafc; color: #64748b;">
                                            1
                                        </a>
                                        @if($start > 2)
                                            <span class="px-1 flex items-center text-gray-400 text-xs">...</span>
                                        @endif
                                    @endif
                                    
                                    @for($page = $start; $page <= $end; $page++)
                                        @if($page == $users->currentPage())
                                            <span class="w-8 md:w-10 h-8 md:h-10 rounded-lg text-white text-xs md:text-sm font-bold flex items-center justify-center shadow-sm" style="background-color: #6366f1;">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $users->appends(request()->except('page'))->url($page) }}" 
                                               class="w-8 md:w-10 h-8 md:h-10 rounded-lg text-xs md:text-sm font-medium flex items-center justify-center hover:bg-gray-100 transition" style="background-color: #f8fafc; color: #64748b;">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endfor
                                    
                                    @if($end < $users->lastPage())
                                        @if($end < $users->lastPage() - 1)
                                            <span class="px-1 flex items-center text-gray-400 text-xs">...</span>
                                        @endif
                                        <a href="{{ $users->appends(request()->except('page'))->url($users->lastPage()) }}" 
                                           class="w-8 md:w-10 h-8 md:h-10 rounded-lg text-xs md:text-sm font-medium flex items-center justify-center hover:bg-gray-100 transition" style="background-color: #f8fafc; color: #64748b;">
                                            {{ $users->lastPage() }}
                                        </a>
                                    @endif
                                </div>

                                {{-- Next Button --}}
                                @if($users->hasMorePages())
                                    <a href="{{ $users->appends(request()->except('page'))->nextPageUrl() }}" 
                                       class="px-3 md:px-4 py-2 rounded-lg text-white text-xs md:text-sm font-medium hover:opacity-90 transition" style="background-color: #6366f1;">
                                        <span class="hidden md:inline">Next →</span>
                                        <span class="md:hidden">→</span>
                                    </a>
                                @else
                                    <span class="px-3 md:px-4 py-2 rounded-lg text-gray-400 cursor-not-allowed text-xs md:text-sm font-medium" style="background-color: #f1f5f9;">
                                        <span class="hidden md:inline">Next →</span>
                                        <span class="md:hidden">→</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-16 px-4">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center mb-6" style="background-color: #f1f5f9;">
                        @if(request('search'))
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        @if(request('search'))
                            Tidak Ada Hasil
                        @else
                            Tidak Ada User
                        @endif
                    </h3>
                    
                    <p class="text-gray-600 text-center mb-6 max-w-md">
                        @if(request('search'))
                            Pencarian untuk "<strong>{{ request('search') }}</strong>" tidak menemukan hasil yang cocok.
                            @if(request('role'))
                                Coba hapus filter role atau gunakan kata kunci lain.
                            @else
                                Coba gunakan kata kunci lain atau periksa ejaan Anda.
                            @endif
                        @else
                            @if(request('role'))
                                Belum ada user dengan role {{ request('role') }}.
                            @else
                                Belum ada user yang terdaftar dalam sistem.
                            @endif
                        @endif
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        @if(request('search') || request('role'))
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-6 py-2.5 rounded-lg text-white text-sm font-medium hover:opacity-90 transition inline-flex items-center justify-center" 
                               style="background-color: #6366f1;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset Filter
                            </a>
                        @endif
                        
                        @if(request('search'))
                            <a href="{{ route('admin.users.index', ['role' => request('role')]) }}" 
                               class="px-6 py-2.5 rounded-lg text-gray-700 text-sm font-medium hover:bg-gray-50 transition inline-flex items-center justify-center border" 
                               style="border-color: #e2e8f0;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus Pencarian
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Smooth transitions */
        button, a {
            transition: all 0.2s ease;
        }
        
        /* Hover effects */
        tr:hover {
            background-color: #f9fafb;
        }
        
        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Search input animation */
        input[type="text"]:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            /* Hide horizontal scrollbar on mobile for filter tabs */
            .overflow-x-auto::-webkit-scrollbar {
                display: none;
            }
            
            /* Smooth scroll for filter tabs */
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
        }
    </style>

    <script>
        // Auto submit on Enter key
        document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });
    </script>
@endsection