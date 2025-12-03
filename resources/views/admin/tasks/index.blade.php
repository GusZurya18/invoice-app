@extends('layouts.admin')

@section('content')
<div class="min-h-screen rounded-xl bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 py-4 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section with Filters -->
        <div class="bg-white shadow-sm rounded-2xl p-4 md:p-6 mb-6">
            <div class="flex flex-col space-y-4">
                <!-- Top Row: Add Button and Bulk Delete -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-4">
                        <a href="{{ route('admin.tasks.create') }}" 
                           class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Task Baru
                        </a>
                        
                        <!-- Bulk Delete Button -->
                        <button id="bulkDeleteBtn" 
                                onclick="bulkDelete()"
                                class="hidden items-center justify-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus (<span id="selectedCount">0</span>)
                        </button>
                    </div>
                </div>

                <!-- Bottom Row: Filter Tabs and Search Bar -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Filter Tabs -->
                    <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0">
                        <a href="?status={{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 md:px-4 py-2 text-xs md:text-sm font-medium rounded-lg transition whitespace-nowrap {{ request('status') == null || request('status') == '' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100' }}">
                            All
                        </a>
                        <a href="?status=done{{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 md:px-4 py-2 text-xs md:text-sm font-medium rounded-lg transition whitespace-nowrap {{ request('status') == 'done' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100' }}">
                            Done
                        </a>
                        <a href="?status=pending{{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 md:px-4 py-2 text-xs md:text-sm font-medium rounded-lg transition whitespace-nowrap {{ request('status') == 'pending' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100' }}">
                            Pending
                        </a>
                        <a href="?status=in_progress{{ request('search') ? '&search=' . request('search') : '' }}" 
                           class="px-3 md:px-4 py-2 text-xs md:text-sm font-medium rounded-lg transition whitespace-nowrap {{ request('status') == 'in_progress' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100' }}">
                            In Progress
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative flex-shrink-0 w-full md:w-80">
                        <form action="" method="GET" class="relative">
                            @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari task, assignee..." 
                                   class="w-full pl-10 pr-10 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            @if(request('search'))
                                <a href="?{{ request('status') ? 'status=' . request('status') : '' }}" 
                                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Search Results Info -->
                @if(request('search'))
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">
                            Menampilkan hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
                        </span>
                        <a href="?{{ request('status') ? 'status=' . request('status') : '' }}" 
                           class="text-indigo-600 hover:text-indigo-700 font-medium">
                            Reset pencarian
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Table Card -->
        <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
            @if($tasks->count() > 0)
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-6 py-4 text-left">
                                    <input type="checkbox" 
                                           id="selectAll"
                                           onclick="toggleSelectAll(this)"
                                           class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Judul Task
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Assigned To
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Priority
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Start Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Dateline
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($tasks as $task)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" 
                                               class="task-checkbox w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                               value="{{ $task->id }}"
                                               onclick="updateBulkDeleteButton()">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ Str::limit($task->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $task->assignee->name ?? 'Belum ditugaskan' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($task->status == 'done')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-green-100 text-green-700">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Done
                                            </span>
                                        @elseif($task->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-orange-100 text-orange-700">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-700">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                                </svg>
                                                In Progress
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-700">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full
                                            @if($task->priority == 'high') bg-red-100 text-red-800
                                            @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $task->start_date ? $task->start_date->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $task->deadline ? $task->deadline->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.tasks.show', $task) }}" 
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-500 hover:bg-green-600 text-white transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.tasks.edit', $task) }}" 
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.tasks.destroy', $task) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus task ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
                <div class="md:hidden divide-y divide-gray-100">
                    @foreach($tasks as $task)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start space-x-3">
                                <div class="pt-1">
                                    <input type="checkbox" 
                                           class="task-checkbox w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                           value="{{ $task->id }}"
                                           onclick="updateBulkDeleteButton()">
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $task->title }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">{{ Str::limit($task->description, 60) }}</p>
                                    
                                    <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
                                        <div>
                                            <span class="text-gray-500">Assigned:</span>
                                            <span class="text-gray-900 font-medium ml-1">{{ Str::limit($task->assignee->name ?? 'Belum ditugaskan', 15) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Priority:</span>
                                            <span class="ml-1 px-2 py-0.5 inline-flex text-xs font-semibold rounded-full
                                                @if($task->priority == 'high') bg-red-100 text-red-800
                                                @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Start:</span>
                                            <span class="text-gray-900 ml-1">{{ $task->start_date ? $task->start_date->format('d/m/Y') : '-' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Deadline:</span>
                                            <span class="text-gray-900 ml-1">{{ $task->deadline ? $task->deadline->format('d/m/Y') : '-' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($task->status == 'done')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-100 text-green-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Done
                                                </span>
                                            @elseif($task->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-orange-100 text-orange-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Pending
                                                </span>
                                            @elseif($task->status == 'in_progress')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                                    </svg>
                                                    In Progress
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.tasks.show', $task) }}" 
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-500 hover:bg-green-600 text-white transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.tasks.edit', $task) }}" 
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.tasks.destroy', $task) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus task ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($tasks->hasPages())
                    <div class="px-4 md:px-6 py-4 border-t border-gray-200">
                        {{ $tasks->appends(['search' => request('search'), 'status' => request('status')])->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-12 md:py-16 px-6">
                    @if(request('search'))
                        <svg class="mx-auto h-16 md:h-24 w-16 md:w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="mt-4 text-base md:text-lg font-semibold text-gray-900">Tidak ada hasil yang ditemukan</h3>
                        <p class="mt-2 text-sm text-gray-500">Kami tidak dapat menemukan task dengan kata kunci "<span class="font-semibold">{{ request('search') }}</span>"</p>
                        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center items-center">
                            <a href="?{{ request('status') ? 'status=' . request('status') : '' }}" 
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Hapus Pencarian
                            </a>
                            <a href="{{ route('admin.tasks.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Task Baru
                            </a>
                        </div>
                    @else
                        <svg class="mx-auto h-16 md:h-24 w-16 md:w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-4 text-base md:text-lg font-semibold text-gray-900">
                            {{ request('status') ? 'Tidak ada task dengan status ' . ucfirst(str_replace('_', ' ', request('status'))) : 'Belum ada task yang dibuat' }}
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ request('status') ? 'Belum ada task dengan status tersebut' : 'Klik "Tambah Task Baru" untuk membuat task pertama' }}
                        </p>
                        <div class="mt-6">
                            @if(request('status'))
                                <a href="?" 
                                   class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition mr-3">
                                    Lihat Semua Task
                                </a>
                            @endif
                            <a href="{{ route('admin.tasks.create') }}" 
                               class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Task Baru
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bulk Delete Form -->
<form id="bulkDeleteForm" action="{{ route('admin.tasks.bulk-destroy') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="task_ids" id="taskIdsInput">
</form>

<script>
    // Toggle Select All Checkboxes
    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('.task-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
        });
        updateBulkDeleteButton();
    }

    // Update Bulk Delete Button visibility and count
    function updateBulkDeleteButton() {
        const checkboxes = document.querySelectorAll('.task-checkbox:checked');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const selectedCount = document.getElementById('selectedCount');
        
        if (checkboxes.length > 0) {
            bulkDeleteBtn.classList.remove('hidden');
            bulkDeleteBtn.classList.add('inline-flex');
            selectedCount.textContent = checkboxes.length;
        } else {
            bulkDeleteBtn.classList.add('hidden');
            bulkDeleteBtn.classList.remove('inline-flex');
        }
        
        // Update select all checkbox state
        const allCheckboxes = document.querySelectorAll('.task-checkbox');
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = allCheckboxes.length === checkboxes.length && allCheckboxes.length > 0;
        }
    }

    // Bulk Delete Function
    function bulkDelete() {
        const checkboxes = document.querySelectorAll('.task-checkbox:checked');
        
        if (checkboxes.length === 0) {
            alert('Pilih minimal satu task untuk dihapus');
            return;
        }
        
        if (!confirm(`Yakin ingin menghapus ${checkboxes.length} task yang dipilih?`)) {
            return;
        }
        
        const taskIds = Array.from(checkboxes).map(cb => cb.value);
        document.getElementById('taskIdsInput').value = JSON.stringify(taskIds);
        document.getElementById('bulkDeleteForm').submit();
    }
</script>

<style>
    /* Hide scrollbar for filter tabs on mobile */
    @media (max-width: 768px) {
        .overflow-x-auto::-webkit-scrollbar {
            display: none;
        }
        
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
    }
</style>
@endsection