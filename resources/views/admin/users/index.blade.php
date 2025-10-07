@extends('layouts.admin')

@section('content')
    <div class="p-8" style="background: ; min-height: 100vh;">
        <h1 class="text-3xl font-bold mb-8 text-white">Kelola User</h1>

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

        <!-- Stats Cards (Optional - sesuai design Figma) -->
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
            <div class="px-6 py-4 border-b" style="border-color: #e2e8f0;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('role') == null ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                           style="{{ request('role') == null ? 'background-color: #6366f1;' : '' }}">
                            All
                        </a>
                        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('role') == 'admin' ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                           style="{{ request('role') == 'admin' ? 'background-color: #6366f1;' : '' }}">
                            Admin
                        </a>
                        <a href="{{ route('admin.users.index', ['role' => 'user']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('role') == 'user' ? 'text-white' : 'text-gray-600 hover:bg-gray-50' }}" 
                           style="{{ request('role') == 'user' ? 'background-color: #6366f1;' : '' }}">
                            User
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 rounded-lg hover:bg-gray-50">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
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
                                    <!-- Delete Button -->
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

            <!-- Custom Pagination -->
            <div class="px-6 py-4 border-t" style="border-color: #e2e8f0; background-color: #fafbfc;">
                @if($users->hasPages())
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-semibold text-gray-900">{{ $users->firstItem() }}</span> - 
                            <span class="font-semibold text-gray-900">{{ $users->lastItem() }}</span> dari 
                            <span class="font-semibold text-gray-900">{{ $users->total() }}</span> user
                        </div>
                        <div class="flex items-center space-x-2">
                            {{-- Previous Button --}}
                            @if($users->onFirstPage())
                                <span class="px-4 py-2 rounded-lg text-gray-400 cursor-not-allowed text-sm font-medium" style="background-color: #f1f5f9;">
                                    ← Previous
                                </span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" 
                                   class="px-4 py-2 rounded-lg text-white text-sm font-medium hover:opacity-90 transition" style="background-color: #6366f1;">
                                    ← Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            <div class="flex space-x-1">
                                @foreach(range(1, $users->lastPage()) as $page)
                                    @if($page == $users->currentPage())
                                        <span class="w-10 h-10 rounded-lg text-white text-sm font-bold flex items-center justify-center shadow-sm" style="background-color: #6366f1;">
                                            {{ $page }}
                                        </span>
                                    @elseif($page == 1 || $page == $users->lastPage() || abs($page - $users->currentPage()) <= 2)
                                        <a href="{{ $users->url($page) }}" 
                                           class="w-10 h-10 rounded-lg text-sm font-medium flex items-center justify-center hover:bg-gray-100 transition" style="background-color: #f8fafc; color: #64748b;">
                                            {{ $page }}
                                        </a>
                                    @elseif(abs($page - $users->currentPage()) == 3)
                                        <span class="px-2 flex items-center text-gray-400">...</span>
                                    @endif
                                @endforeach
                            </div>

                            {{-- Next Button --}}
                            @if($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" 
                                   class="px-4 py-2 rounded-lg text-white text-sm font-medium hover:opacity-90 transition" style="background-color: #6366f1;">
                                    Next →
                                </a>
                            @else
                                <span class="px-4 py-2 rounded-lg text-gray-400 cursor-not-allowed text-sm font-medium" style="background-color: #f1f5f9;">
                                    Next →
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
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
    </style>
@endsection