@extends('layouts.master')

@section('title', 'Invoice Management')

@section('page-title', 'Invoice Management')

@section('content')
    <div class="w-full px-3 sm:px-4 lg:px-6 py-4 sm:py-6 lg:py-8">
       
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 lg:mb-6 gap-3 animate-fade-in">
            <h1 class="text-xl sm:text-2xl lg:text-4xl font-bold text-white">Invoices</h1>
           
            {{-- Top Search --}}
            <div class="flex items-center gap-2 sm:gap-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-initial">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInputTop"
                           class="w-full sm:w-64 lg:w-72 pl-10 pr-3 py-2 text-sm bg-white rounded-full border-0 focus:ring-2 focus:ring-white focus:ring-opacity-30 text-gray-900 placeholder-gray-500 transition-all duration-300"
                           placeholder="Cari invoice...">
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 lg:gap-5 mb-4 lg:mb-6">
            {{-- Total Invoice Card --}}
            <div class="stat-card bg-white rounded-lg lg:rounded-2xl p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-all duration-300" style="animation-delay: 0.1s">
                <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2">
                    <div class="min-w-0 flex-1 w-full">
                        <p class="text-xs text-gray-600 mb-0.5 sm:mb-1 truncate">Total Invoices</p>
                        <p class="text-lg sm:text-xl lg:text-3xl font-bold text-gray-900 counter-number" data-target="{{ $totalInvoices }}">0</p>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-blue-500 rounded-lg lg:rounded-xl flex items-center justify-center flex-shrink-0 icon-float">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                        </svg>
                    </div>
                </div>
            </div>
           
            {{-- Paid Invoices Card --}}
            <div class="stat-card bg-white rounded-lg lg:rounded-2xl p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-all duration-300" style="animation-delay: 0.2s">
                <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2">
                    <div class="min-w-0 flex-1 w-full">
                        <p class="text-xs text-gray-600 mb-0.5 sm:mb-1 truncate">Paid</p>
                        <p class="text-lg sm:text-xl lg:text-3xl font-bold text-gray-900 counter-number" data-target="{{ $paidInvoices }}">0</p>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-green-500 rounded-lg lg:rounded-xl flex items-center justify-center flex-shrink-0 icon-float">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                        </svg>
                    </div>
                </div>
            </div>
           
            {{-- Pending Invoices Card --}}
            <div class="stat-card bg-white rounded-lg lg:rounded-2xl p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-all duration-300" style="animation-delay: 0.3s">
                <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2">
                    <div class="min-w-0 flex-1 w-full">
                        <p class="text-xs text-gray-600 mb-0.5 sm:mb-1 truncate">Pending</p>
                        <p class="text-lg sm:text-xl lg:text-3xl font-bold text-gray-900 counter-number" data-target="{{ $pendingInvoices }}">0</p>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-orange-500 rounded-lg lg:rounded-xl flex items-center justify-center flex-shrink-0 icon-float">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                        </svg>
                    </div>
                </div>
            </div>
           
            {{-- Not Paid Card --}}
            <div class="stat-card bg-white rounded-lg lg:rounded-2xl p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-all duration-300" style="animation-delay: 0.4s">
                <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2">
                    <div class="min-w-0 flex-1 w-full">
                        <p class="text-xs text-gray-600 mb-0.5 sm:mb-1 truncate">Not Paid</p>
                        <p class="text-lg sm:text-xl lg:text-3xl font-bold text-gray-900 counter-number" data-target="{{ $unpaidInvoices }}">0</p>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-red-500 rounded-lg lg:rounded-xl flex items-center justify-center flex-shrink-0 icon-float">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,6A1.5,1.5 0 0,1 13.5,7.5A1.5,1.5 0 0,1 12,9A1.5,1.5 0 0,1 10.5,7.5A1.5,1.5 0 0,1 12,6M12,17C10.5,17 9.27,16.12 8.75,14.87L10.07,14.41C10.36,15.11 11.1,15.5 12,15.5C12.9,15.5 13.64,15.11 13.93,14.41L15.25,14.87C14.73,16.12 13.5,17 12,17Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Controls Section --}}
        <div class="bg-white rounded-lg lg:rounded-2xl p-3 sm:p-4 lg:p-5 mb-4 lg:mb-6 shadow-sm animate-slide-up" style="animation-delay: 0.5s">
            {{-- Mobile Layout: Stacked --}}
            <div class="flex flex-col gap-3 lg:hidden">
                {{-- Create Button --}}
                <a href="{{ route('invoices.create') }}"
                   class="btn-animated inline-flex items-center justify-center px-4 py-2.5 text-sm bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Invoice
                </a>

                {{-- Filter Tabs - Scrollable on Mobile --}}
                <div class="overflow-x-auto -mx-3 px-3 hide-scrollbar">
                    <div class="inline-flex bg-gray-100 rounded-lg p-1 min-w-full">
                        <button class="filter-tab px-3 py-2 text-xs font-medium rounded-md transition-all duration-300 active whitespace-nowrap flex-1" data-filter="all">All</button>
                        <button class="filter-tab px-3 py-2 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap flex-1" data-filter="paid">Paid</button>
                        <button class="filter-tab px-3 py-2 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap flex-1" data-filter="unpaid">Unpaid</button>
                        <button class="filter-tab px-3 py-2 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap flex-1" data-filter="pending">Pending</button>
                        <button class="filter-tab px-3 py-2 text-xs font-medium rounded-md transition-all duration-300 whitespace-nowrap flex-1" data-filter="draft">Draft</button>
                    </div>
                </div>

                {{-- Search & Date Filter Row --}}
                <div class="flex gap-2">
                    {{-- Search Input --}}
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput"
                               class="w-full pl-10 pr-3 py-2 text-sm bg-gray-100 rounded-lg border-0 focus:ring-2 focus:ring-purple-500 text-gray-900 placeholder-gray-500 transition-all duration-300"
                               placeholder="Cari invoice...">
                    </div>
                    
                    {{-- Date Filter --}}
                    <input type="month" id="dateFilter"
                           class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all duration-300 border-0 focus:ring-2 focus:ring-purple-500 flex-shrink-0">
                </div>
            </div>

            {{-- Desktop Layout: Horizontal --}}
            <div class="hidden lg:flex items-center justify-between gap-4">
                {{-- Left Side: Create Button & Filter Tabs --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('invoices.create') }}"
                       class="btn-animated inline-flex items-center justify-center px-4 py-2.5 text-sm bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-300 flex-shrink-0">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Invoice
                    </a>

                    <div class="inline-flex bg-gray-100 rounded-lg p-1">
                        <button class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 active whitespace-nowrap" data-filter="all">All</button>
                        <button class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 whitespace-nowrap" data-filter="paid">Paid</button>
                        <button class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 whitespace-nowrap" data-filter="unpaid">Unpaid</button>
                        <button class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 whitespace-nowrap" data-filter="pending">Pending</button>
                        <button class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 whitespace-nowrap" data-filter="draft">Draft</button>
                    </div>
                </div>

                {{-- Right Side: Search & Date Filter --}}
                <div class="flex items-center gap-3">
                    {{-- Search Input --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInputBottom"
                               class="w-64 pl-10 pr-3 py-2 text-sm bg-gray-100 rounded-lg border-0 focus:ring-2 focus:ring-purple-500 text-gray-900 placeholder-gray-500 transition-all duration-300"
                               placeholder="Cari invoice...">
                    </div>
                    
                    {{-- Date Filter --}}
                    <input type="month" id="dateFilter"
                           class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all duration-300 border-0 focus:ring-2 focus:ring-purple-500 flex-shrink-0">
                </div>
            </div>
        </div>

        {{-- Hidden Form for Bulk Delete --}}
        <form id="bulkDeleteForm" action="{{ route('invoices.bulk-delete') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="invoice_ids" id="bulkDeleteIds">
        </form>

        {{-- Hidden Form for Single Delete --}}
        <form id="singleDeleteForm" action="" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        {{-- Table Section --}}
        <div class="bg-white rounded-lg lg:rounded-2xl shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 0.6s">
            {{-- Bulk Actions Header --}}
            <div class="bg-gray-50 px-3 sm:px-4 lg:px-5 py-3 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <input type="checkbox" id="selectAll" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2 transition-all duration-200">
                   
                    <div id="bulkActions" class="hidden flex items-center gap-2">
                        <span class="text-xs text-gray-700">
                            <span id="selectedCount">0</span> dipilih
                        </span>
                        <button id="bulkDeleteBtn" type="button"
                                class="btn-animated inline-flex items-center px-2.5 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-all duration-300">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                        <button id="clearSelection" type="button" class="text-xs text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">Clear</button>
                    </div>
                </div>
            </div>

            {{-- Desktop Table View (Hidden on Mobile) --}}
            <div class="hidden md:block overflow-x-auto" id="tableContainer">
                <table class="w-full divide-y divide-gray-200" id="invoiceTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-3 text-left">
                                <input type="checkbox" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded transition-all duration-200">
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden xl:table-cell">Diskon</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paid</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @forelse($invoices as $inv)
                        <tr class="table-row-animated hover:bg-gray-50 transition-all duration-200"
                            data-customer="{{ strtolower($inv->customer->name ?? '') }}"
                            data-code="{{ strtolower($inv->code) }}"
                            data-status="{{ $inv->status }}"
                            data-paid="{{ $inv->paid_status }}"
                            data-date="{{ $inv->start_date ? $inv->start_date->format('Y-m') : '' }}">
                            <td class="px-3 py-3">
                                <input type="checkbox" class="row-checkbox w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded transition-all duration-200" data-id="{{ $inv->id }}">
                            </td>
                            <td class="px-3 py-3 text-xs font-medium text-gray-900">
                                {{ $inv->code }}
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-900">
                                {{ Str::limit($inv->customer->name ?? '-', 15) }}
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-900">
                                {{ ucfirst($inv->status) }}
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-900">
                                Rp {{ number_format($inv->total_amount, 2, ',', '.') }}
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-900 hidden xl:table-cell">
                                {{ $inv->discount_percent }}%
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-900">
                                {{ $inv->due_date ? $inv->due_date->format('d/m/y') : '-' }}
                            </td>
                            <td class="px-3 py-3">
                                @if($inv->paid_status === 'done')
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        <svg class="w-2.5 h-2.5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                        </svg>
                                        Done
                                    </span>
                                @elseif($inv->due_date && now()->gt($inv->due_date))
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex gap-1">
                                    <a href="{{ route('invoices.show', $inv) }}" class="action-btn w-7 h-7 bg-green-500 hover:bg-green-600 text-white rounded-md flex items-center justify-center transition-all duration-200" title="View">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                   
                                    <a href="{{ route('invoices.edit', $inv) }}" class="action-btn w-7 h-7 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md flex items-center justify-center transition-all duration-200" title="Edit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                   
                                    <button type="button" class="delete-btn action-btn w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-md flex items-center justify-center transition-all duration-200" data-invoice-id="{{ $inv->id }}" data-invoice-code="{{ $inv->code }}" data-url="{{ route('invoices.destroy', $inv) }}" title="Delete">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>

                                    <a href="{{ route('invoices.pdf', $inv) }}" class="action-btn w-7 h-7 bg-blue-500 hover:bg-blue-600 text-white rounded-md flex items-center justify-center transition-all duration-200" title="PDF" target="_blank">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyState">
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada invoice</h3>
                                    <p class="text-sm text-gray-500">Mulai dengan membuat invoice pertama Anda</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- No Results State --}}
                <div id="noResults" class="hidden px-6 py-12 text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada hasil</h3>
                        <p class="text-sm text-gray-500">Coba ubah pencarian atau filter</p>
                    </div>
                </div>
            </div>

            {{-- Mobile Card View (Visible only on Mobile) --}}
            <div class="md:hidden" id="mobileCardContainer">
                <div id="mobileCards" class="divide-y divide-gray-200">
                    @forelse($invoices as $inv)
                    <div class="mobile-card p-4 hover:bg-gray-50 transition-all duration-200"
                         data-customer="{{ strtolower($inv->customer->name ?? '') }}"
                         data-code="{{ strtolower($inv->code) }}"
                         data-status="{{ $inv->status }}"
                         data-paid="{{ $inv->paid_status }}"
                         data-date="{{ $inv->start_date ? $inv->start_date->format('Y-m') : '' }}">
                        
                        {{-- Card Header --}}
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-start gap-2 flex-1 min-w-0">
                                <input type="checkbox" class="row-checkbox mt-1 w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded flex-shrink-0 transition-all duration-200" data-id="{{ $inv->id }}">
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $inv->code }}</p>
                                    <p class="text-xs text-gray-600 truncate">{{ $inv->customer->name ?? '-' }}</p>
                                </div>
                            </div>
                            
                            {{-- Paid Status Badge --}}
                            @if($inv->paid_status === 'done')
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800 flex-shrink-0 ml-2">
                                    <svg class="w-2.5 h-2.5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                    Done
                                </span>
                            @elseif($inv->due_date && now()->gt($inv->due_date))
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800 flex-shrink-0 ml-2">
                                    Overdue
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 flex-shrink-0 ml-2">
                                    Pending
                                </span>
                            @endif
                        </div>

                        {{-- Card Content --}}
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <p class="text-xs text-gray-500">Total</p>
                                <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Due Date</p>
                                <p class="text-sm font-medium text-gray-900">{{ $inv->due_date ? $inv->due_date->format('d/m/y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="text-sm font-medium text-gray-900">{{ ucfirst($inv->status) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Diskon</p>
                                <p class="text-sm font-medium text-gray-900">{{ $inv->discount_percent }}%</p>
                            </div>
                        </div>

                        {{-- Card Actions --}}
                        <div class="flex gap-2">
                            <a href="{{ route('invoices.show', $inv) }}" class="btn-animated flex-1 flex items-center justify-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-all duration-300">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                           
                            <a href="{{ route('invoices.edit', $inv) }}" class="btn-animated flex-1 flex items-center justify-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-lg transition-all duration-300">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                           
                            <a href="{{ route('invoices.pdf', $inv) }}" class="btn-animated w-10 h-10 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-all duration-300" target="_blank" title="PDF">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>

                            <button type="button" class="delete-btn btn-animated w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center transition-all duration-300" data-invoice-id="{{ $inv->id }}" data-invoice-code="{{ $inv->code }}" data-url="{{ route('invoices.destroy', $inv) }}" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div id="emptyStateMobile" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-base font-medium text-gray-900 mb-1">Belum ada invoice</h3>
                            <p class="text-sm text-gray-500">Mulai dengan membuat invoice pertama Anda</p>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- No Results State Mobile --}}
                <div id="noResultsMobile" class="hidden px-6 py-12 text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="text-base font-medium text-gray-900 mb-1">Tidak ada hasil</h3>
                        <p class="text-sm text-gray-500">Coba ubah pencarian atau filter</p>
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="bg-white px-3 sm:px-4 lg:px-5 py-3 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-xs text-gray-700 text-center sm:text-left">
                        <span id="showingFrom">1</span>-<span id="showingTo">10</span> dari <span id="totalItems">{{ $invoices->total() ?? 0 }}</span>
                    </p>
                   
                    <div class="flex items-center gap-1">
                        <button id="prevBtn" class="px-2 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                       
                        <div class="flex items-center gap-1" id="pageNumbers"></div>
                       
                        <button id="nextBtn" class="px-2 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-2">Are You Sure To Delete This Invoice?</h3>
                <p id="deleteInvoiceCode" class="text-sm text-gray-500 mb-6"></p>
                
                <div class="flex gap-3 justify-center">
                    <button id="cancelDelete" type="button" class="btn-animated px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-all duration-300">
                        Cancel
                    </button>
                    <button id="confirmDelete" type="button" class="btn-animated px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-300">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Bulk Delete Confirmation Modal --}}
    <div id="bulkDeleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-2">Are You Sure To Delete These Invoices?</h3>
                <p id="bulkDeleteCount" class="text-sm text-gray-500 mb-6"></p>
                
                <div class="flex gap-3 justify-center">
                    <button id="cancelBulkDelete" type="button" class="btn-animated px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-all duration-300">
                        Cancel
                    </button>
                    <button id="confirmBulkDelete" type="button" class="btn-animated px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-300">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Modal --}}
    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-6">Your invoice have been Delete Successfully</h3>
                
                <button id="closeSuccess" type="button" class="btn-animated px-8 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-all duration-300">
                    Close
                </button>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation Function
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 1500;
        const start = 0;
        let startTimestamp = null;
        
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            // Easing function
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(easeOutQuart * (target - start) + start);
            
            element.textContent = current;
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                element.textContent = target;
            }
        };
        
        window.requestAnimationFrame(step);
    }
    
    // Animate all counters
    const counterElements = document.querySelectorAll('.counter-number');
    setTimeout(() => {
        counterElements.forEach((element, index) => {
            setTimeout(() => {
                animateCounter(element);
            }, index * 100);
        });
    }, 300);
    
    // Animate stat cards on load
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Animate table rows on load
    const tableRows = document.querySelectorAll('.table-row-animated');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            row.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 700 + (index * 50));
    });
    
    // Animate mobile cards on load
    const mobileCards = document.querySelectorAll('.mobile-card');
    mobileCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 700 + (index * 50));
    });

    const searchInput = document.getElementById('searchInput');
    const searchInputTop = document.getElementById('searchInputTop');
    const searchInputBottom = document.getElementById('searchInputBottom');
    const filterTabs = document.querySelectorAll('.filter-tab');
    const dateFilter = document.getElementById('dateFilter');
    const tableBody = document.getElementById('tableBody');
    const noResults = document.getElementById('noResults');
    const mobileCardsContainer = document.getElementById('mobileCards');
    const noResultsMobile = document.getElementById('noResultsMobile');
   
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageNumbers = document.getElementById('pageNumbers');
    const showingFrom = document.getElementById('showingFrom');
    const showingTo = document.getElementById('showingTo');
    const totalItems = document.getElementById('totalItems');
   
    const selectAllCheckbox = document.getElementById('selectAll');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const clearSelection = document.getElementById('clearSelection');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
   
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');
    const bulkDeleteIds = document.getElementById('bulkDeleteIds');
    const singleDeleteForm = document.getElementById('singleDeleteForm');

    // Modal Elements
    const deleteModal = document.getElementById('deleteModal');
    const bulkDeleteModal = document.getElementById('bulkDeleteModal');
    const successModal = document.getElementById('successModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelBulkDelete = document.getElementById('cancelBulkDelete');
    const confirmBulkDelete = document.getElementById('confirmBulkDelete');
    const closeSuccess = document.getElementById('closeSuccess');
    const deleteInvoiceCode = document.getElementById('deleteInvoiceCode');
    const bulkDeleteCount = document.getElementById('bulkDeleteCount');

    let currentDeleteUrl = '';
    let currentDeleteInvoiceId = '';
   
    let currentFilter = 'all';
    let currentSearch = '';
    let currentDate = '';
    let currentPage = 1;
    let itemsPerPage = 10;
    let allRows = [];
    let allMobileCardsArray = [];
    let isMobile = window.innerWidth < 768;

    function init() {
        allRows = Array.from(tableBody?.querySelectorAll('tr:not(#emptyState)') || []);
        allMobileCardsArray = Array.from(mobileCardsContainer?.querySelectorAll('.mobile-card') || []);
        updatePagination();
        initializeTabStyling();
        checkViewport();
        attachDeleteHandlers();
    }

    function checkViewport() {
        isMobile = window.innerWidth < 768;
    }

    window.addEventListener('resize', function() {
        checkViewport();
    });

    function initializeTabStyling() {
        const activeTab = document.querySelector('.filter-tab.active');
        if (activeTab) {
            activeTab.classList.add('bg-white', 'text-purple-600', 'shadow-sm');
            activeTab.classList.remove('text-gray-500');
        }
       
        filterTabs.forEach(tab => {
            if (!tab.classList.contains('active')) {
                tab.classList.add('text-gray-500', 'hover:text-gray-700');
            }
        });
    }

    // Delete Handlers
    function attachDeleteHandlers() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                currentDeleteUrl = this.getAttribute('data-url');
                currentDeleteInvoiceId = this.getAttribute('data-invoice-id');
                const invoiceCode = this.getAttribute('data-invoice-code');
                deleteInvoiceCode.textContent = `Invoice: ${invoiceCode}`;
                showModal(deleteModal);
            });
        });
    }

    function showModal(modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        // Trigger animation
        const modalContent = modal.querySelector('.modal-content');
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95) translateY(-20px)';
        setTimeout(() => {
            modalContent.style.transition = 'all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)';
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1) translateY(0)';
        }, 10);
    }

    function hideModal(modal) {
        const modalContent = modal.querySelector('.modal-content');
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95) translateY(-20px)';
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }

    // Single Delete
    cancelDelete.addEventListener('click', function() {
        hideModal(deleteModal);
    });

    confirmDelete.addEventListener('click', function() {
        if (currentDeleteUrl) {
            singleDeleteForm.action = currentDeleteUrl;
            singleDeleteForm.submit();
            hideModal(deleteModal);
            setTimeout(() => showModal(successModal), 500);
        }
    });

    // Bulk Delete
    bulkDeleteBtn?.addEventListener('click', function() {
        const checkedBoxes = Array.from(rowCheckboxes).filter(checkbox => checkbox.checked);
        const invoiceIds = checkedBoxes.map(checkbox => checkbox.getAttribute('data-id'));
       
        if (invoiceIds.length === 0) {
            alert('Tidak ada invoice yang dipilih.');
            return;
        }
       
        bulkDeleteCount.textContent = `You are about to delete ${invoiceIds.length} invoice(s)`;
        showModal(bulkDeleteModal);
    });

    cancelBulkDelete.addEventListener('click', function() {
        hideModal(bulkDeleteModal);
    });

    confirmBulkDelete.addEventListener('click', function() {
        const checkedBoxes = Array.from(rowCheckboxes).filter(checkbox => checkbox.checked);
        const invoiceIds = checkedBoxes.map(checkbox => checkbox.getAttribute('data-id'));
        
        if (invoiceIds.length > 0) {
            bulkDeleteIds.value = JSON.stringify(invoiceIds);
            bulkDeleteForm.submit();
            hideModal(bulkDeleteModal);
            setTimeout(() => showModal(successModal), 500);
        }
    });

    closeSuccess.addEventListener('click', function() {
        hideModal(successModal);
    });

    // Close modals on backdrop click
    [deleteModal, bulkDeleteModal, successModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideModal(modal);
            }
        });
    });

    // ESC key to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!deleteModal.classList.contains('hidden')) hideModal(deleteModal);
            if (!bulkDeleteModal.classList.contains('hidden')) hideModal(bulkDeleteModal);
            if (!successModal.classList.contains('hidden')) hideModal(successModal);
        }
    });

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => {
                t.classList.remove('active', 'bg-white', 'text-purple-600', 'shadow-sm');
                t.classList.add('text-gray-500', 'hover:text-gray-700');
            });
           
            this.classList.add('active', 'bg-white', 'text-purple-600', 'shadow-sm');
            this.classList.remove('text-gray-500', 'hover:text-gray-700');
           
            currentFilter = this.getAttribute('data-filter');
            currentPage = 1;
            filterInvoices();
        });
    });

    // Search input di mobile/filter container
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase();
            // Sinkronkan dengan search input lainnya
            if (searchInputTop) searchInputTop.value = this.value;
            if (searchInputBottom) searchInputBottom.value = this.value;
            currentPage = 1;
            filterInvoices();
        });
    }

    // Search input di header (top)
    if (searchInputTop) {
        searchInputTop.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase();
            // Sinkronkan dengan search input lainnya
            if (searchInput) searchInput.value = this.value;
            if (searchInputBottom) searchInputBottom.value = this.value;
            currentPage = 1;
            filterInvoices();
        });
    }

    // Search input di desktop/filter container
    if (searchInputBottom) {
        searchInputBottom.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase();
            // Sinkronkan dengan search input lainnya
            if (searchInputTop) searchInputTop.value = this.value;
            if (searchInput) searchInput.value = this.value;
            currentPage = 1;
            filterInvoices();
        });
    }

    dateFilter.addEventListener('change', function() {
        currentDate = this.value;
        currentPage = 1;
        filterInvoices();
    });

    function filterInvoices() {
        let filteredRows = allRows.filter(row => matchesFilters(row));
        let filteredCards = allMobileCardsArray.filter(card => matchesFilters(card));

        if (isMobile) {
            displayMobileCards(filteredCards);
        } else {
            displayRows(filteredRows);
        }
        
        updatePagination(isMobile ? filteredCards.length : filteredRows.length);
    }

    function matchesFilters(element) {
        const customer = element.getAttribute('data-customer') || '';
        const code = element.getAttribute('data-code') || '';
        const status = element.getAttribute('data-status') || '';
        const paidStatus = element.getAttribute('data-paid') || '';
        const date = element.getAttribute('data-date') || '';

        const matchesSearch = currentSearch === '' ||
                            customer.includes(currentSearch) ||
                            code.includes(currentSearch);

        let matchesFilter = true;
        if (currentFilter !== 'all') {
            switch(currentFilter) {
                case 'paid':
                    matchesFilter = paidStatus === 'done';
                    break;
                case 'unpaid':
                    matchesFilter = paidStatus === 'overdue';
                    break;
                case 'pending':
                    matchesFilter = paidStatus === 'pending';
                    break;
                case 'draft':
                    matchesFilter = status === 'draft';
                    break;
            }
        }

        // Perbaikan filter date - pastikan format sama persis (Y-m)
        const matchesDate = currentDate === '' || date === currentDate;

        return matchesSearch && matchesFilter && matchesDate;
    }

    function displayRows(filteredRows = allRows) {
        allRows.forEach(row => {
            row.style.display = 'none';
        });

        if (filteredRows.length === 0) {
            noResults?.classList.remove('hidden');
            document.getElementById('invoiceTable').style.display = 'none';
            return;
        } else {
            noResults?.classList.add('hidden');
            document.getElementById('invoiceTable').style.display = 'table';
        }

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const rowsToShow = filteredRows.slice(startIndex, endIndex);

        rowsToShow.forEach(row => {
            row.style.display = '';
        });
    }

    function displayMobileCards(filteredCards = allMobileCardsArray) {
        allMobileCardsArray.forEach(card => {
            card.style.display = 'none';
        });

        if (filteredCards.length === 0) {
            noResultsMobile?.classList.remove('hidden');
            return;
        } else {
            noResultsMobile?.classList.add('hidden');
        }

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const cardsToShow = filteredCards.slice(startIndex, endIndex);

        cardsToShow.forEach(card => {
            card.style.display = '';
        });
    }

    function updatePagination(filteredCount = (isMobile ? allMobileCardsArray.length : allRows.length)) {
        const totalPages = Math.ceil(filteredCount / itemsPerPage);
        const startItem = filteredCount === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentPage * itemsPerPage, filteredCount);

        showingFrom.textContent = startItem;
        showingTo.textContent = endItem;
        totalItems.textContent = filteredCount;

        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;

        generatePageNumbers(totalPages);
    }

    function generatePageNumbers(totalPages) {
        pageNumbers.innerHTML = '';
        if (totalPages <= 1) return;

        const maxVisiblePages = isMobile ? 3 : 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage < maxVisiblePages - 1) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        if (startPage > 1) {
            addPageButton(1);
            if (startPage > 2) {
                addEllipsis();
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            addPageButton(i);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                addEllipsis();
            }
            addPageButton(totalPages);
        }
    }

    function addPageButton(pageNum) {
        const button = document.createElement('button');
        button.textContent = pageNum;
        button.className = `px-2 py-1 text-xs font-medium rounded-md transition-all duration-200 ${
            pageNum === currentPage
                ? 'bg-purple-600 text-white'
                : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'
        }`;
       
        button.addEventListener('click', () => {
            currentPage = pageNum;
            filterInvoices();
        });
       
        pageNumbers.appendChild(button);
    }

    function addEllipsis() {
        const ellipsis = document.createElement('span');
        ellipsis.textContent = '...';
        ellipsis.className = 'px-1 text-xs text-gray-700';
        pageNumbers.appendChild(ellipsis);
    }

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            filterInvoices();
        }
    });

    nextBtn.addEventListener('click', () => {
        const items = isMobile ? allMobileCardsArray : allRows;
        const visibleItems = items.filter(item => item.style.display !== 'none');
        const totalPages = Math.ceil(visibleItems.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            filterInvoices();
        }
    });

    function updateBulkActions() {
        const visibleCheckboxes = Array.from(rowCheckboxes).filter(checkbox => {
            const parent = checkbox.closest('tr') || checkbox.closest('.mobile-card');
            return parent && parent.style.display !== 'none';
        });
       
        const checkedBoxes = visibleCheckboxes.filter(checkbox => checkbox.checked);
        const count = checkedBoxes.length;
       
        if (count > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = count;
        } else {
            bulkActions.classList.add('hidden');
        }
       
        if (count === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (count === visibleCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
            selectAllCheckbox.checked = false;
        }
    }

    selectAllCheckbox?.addEventListener('change', function() {
        const visibleCheckboxes = Array.from(rowCheckboxes).filter(checkbox => {
            const parent = checkbox.closest('tr') || checkbox.closest('.mobile-card');
            return parent && parent.style.display !== 'none';
        });
       
        visibleCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
       
        updateBulkActions();
    });

    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    clearSelection?.addEventListener('click', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        updateBulkActions();
    });

    init();
});
</script>

<style>
/* Keyframe Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
}

/* Animation Classes */
.animate-fade-in {
    animation: fadeIn 0.6s ease-out forwards;
}

.animate-slide-up {
    animation: slideUp 0.6s ease-out forwards;
    opacity: 0;
}

/* Icon Float Animation */
.icon-float {
    animation: float 3s ease-in-out infinite;
}

.icon-float:hover {
    animation-play-state: paused;
}

/* Button Animations */
.btn-animated {
    position: relative;
    overflow: hidden;
}

.btn-animated:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-animated:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Action Button Hover */
.action-btn:hover {
    transform: scale(1.1);
}

.action-btn:active {
    transform: scale(0.95);
}

/* Filter Tab Animations */
.filter-tab {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.filter-tab:not(.active):hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-1px);
}

.filter-tab.active {
    transform: translateY(-2px);
}

/* Card Hover Effects */
.stat-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover {
    transform: translateY(-5px);
}

/* Table Row Hover */
.table-row-animated:hover {
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Mobile Card Hover */
.mobile-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-card:hover {
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Checkbox Animation */
input[type="checkbox"] {
    transition: all 0.2s ease;
}

input[type="checkbox"]:checked {
    background-color: #7c3aed;
    border-color: #7c3aed;
    transform: scale(1.1);
}

/* Modal Animations */
.modal-content {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Pagination Button Hover */
#pageNumbers button,
#prevBtn,
#nextBtn {
    transition: all 0.2s ease;
}

#pageNumbers button:hover,
#prevBtn:hover:not(:disabled),
#nextBtn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Input Focus Animation */
input:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    transform: scale(1.02);
}

/* Smooth Scrollbar */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Badge Pulse Animation */
span.inline-flex.items-center.px-2 {
    animation: badgePulse 2s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

/* Smooth transitions for all interactive elements */
button, a, input, select {
    transition: all 0.2s ease-in-out;
}

/* Reduce motion for users who prefer it */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    .icon-float {
        animation: none;
    }
}

/* Mobile specific optimizations */
@media (max-width: 640px) {
    table {
        font-size: 11px;
    }
}

@media (max-width: 767px) {
    .mobile-card {
        border-radius: 0;
    }
    
    button, a, input[type="checkbox"] {
        min-height: 44px;
        min-width: 44px;
    }
    
    input[type="checkbox"] {
        min-height: 20px;
        min-width: 20px;
    }
}

/* Loading State Animation */
@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

.shimmer {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

/* Smooth page transitions */
body {
    transition: opacity 0.3s ease-in-out;
}

/* SVG Icon Animations */
svg {
    transition: transform 0.2s ease;
}

button:hover svg,
a:hover svg {
    transform: scale(1.1);
}

/* Success checkmark animation */
@keyframes checkmark {
    0% {
        transform: scale(0) rotate(-45deg);
    }
    50% {
        transform: scale(1.2) rotate(-45deg);
    }
    100% {
        transform: scale(1) rotate(-45deg);
    }
}

#successModal svg {
    animation: checkmark 0.5s ease-out 0.2s both;
}

/* Delete icon shake animation */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.delete-btn:hover svg {
    animation: shake 0.3s ease;
}
</style>

@endsection