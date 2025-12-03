@extends('layouts.master')

@section('title', 'Invoice Details')

@section('page-title', 'Invoice Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ __('invoice.invoice') }} {{ $invoice->code }}</h1>
                        <p class="text-sm text-gray-500">Detail dan informasi lengkap invoice</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <!-- Language Selector -->
                    <div class="relative inline-block">
                        <button onclick="toggleLanguageMenu(event)" id="langButton" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md group">
                            <span class="text-xl mr-2 transition-transform duration-200 group-hover:scale-110">
                                {{ app()->getLocale() == 'id' ? '🇮🇩' : '🇬🇧' }}
                            </span>
                            <span class="font-medium">{{ app()->getLocale() == 'id' ? 'Indonesia' : 'English' }}</span>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-200" id="langChevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <a href="{{ route('invoices.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('invoice.back_to_list') }}
                    </a>
                    
                    <a href="{{ route('invoices.edit', $invoice) }}" 
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('invoice.edit_invoice') }}
                    </a>
                    
                    <button onclick="window.print()" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        {{ __('invoice.print') }}
                    </button>
                    
                    <!-- PDF Download Dropdown -->
                    <div class="relative inline-block">
                        <button onclick="togglePdfMenu(event)" id="pdfButton" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md group">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>{{ __('invoice.download_pdf') }}</span>
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200" id="pdfChevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Language Dropdown Menu (Fixed Position) -->
    <div id="langMenu" class="hidden fixed w-56 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform opacity-0 scale-95 transition-all duration-200" style="z-index: 999999;">
        <div class="py-1">
            <button onclick="changeLanguage('id')" type="button"
                    class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group {{ app()->getLocale() == 'id' ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                <span class="text-2xl mr-3 transition-transform duration-200 group-hover:scale-125">🇮🇩</span>
                <div class="flex-1 text-left">
                    <div class="font-medium text-gray-900">Indonesia</div>
                    <div class="text-xs text-gray-500">Bahasa Indonesia</div>
                </div>
                @if(app()->getLocale() == 'id')
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                @endif
            </button>
            
            <div class="border-t border-gray-100"></div>
            
            <button onclick="changeLanguage('en')" type="button"
                    class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group {{ app()->getLocale() == 'en' ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                <span class="text-2xl mr-3 transition-transform duration-200 group-hover:scale-125">🇬🇧</span>
                <div class="flex-1 text-left">
                    <div class="font-medium text-gray-900">English</div>
                    <div class="text-xs text-gray-500">English Language</div>
                </div>
                @if(app()->getLocale() == 'en')
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                @endif
            </button>
        </div>
    </div>

    <!-- PDF Download Menu (Fixed Position) -->
    <div id="pdfMenu" class="hidden fixed w-56 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden transform opacity-0 scale-95 transition-all duration-200" style="z-index: 999999;">
        <div class="py-1">
            <a href="{{ route('invoices.pdf', ['invoice' => $invoice, 'lang' => 'id']) }}" 
               class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-150 group">
                <span class="text-2xl mr-3 transition-transform duration-200 group-hover:scale-125">🇮🇩</span>
                <div class="flex-1 text-left">
                    <div class="font-medium text-gray-900">PDF Indonesia</div>
                    <div class="text-xs text-gray-500">Download dalam Bahasa Indonesia</div>
                </div>
                <svg class="w-4 h-4 text-red-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </a>
            
            <div class="border-t border-gray-100"></div>
            
            <a href="{{ route('invoices.pdf', ['invoice' => $invoice, 'lang' => 'en']) }}" 
               class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-150 group">
                <span class="text-2xl mr-3 transition-transform duration-200 group-hover:scale-125">🇬🇧</span>
                <div class="flex-1 text-left">
                    <div class="font-medium text-gray-900">PDF English</div>
                    <div class="text-xs text-gray-500">Download in English Language</div>
                </div>
                <svg class="w-4 h-4 text-red-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 print-container">
        <!-- Invoice Card -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
            <!-- Invoice Header -->
            <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 text-white p-8 invoice-header">
                <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                    <svg viewBox="0 0 100 100" class="w-full h-full">
                        <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="2" fill="none" opacity="0.3"/>
                        <circle cx="50" cy="50" r="25" stroke="currentColor" stroke-width="2" fill="none" opacity="0.3"/>
                    </svg>
                </div>
                
                <div class="relative flex justify-between items-start">
                    <div class="space-y-2">
                        <h1 class="text-4xl font-bold tracking-tight">{{ __('invoice.title') }}</h1>
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-100 text-sm font-medium">{{ __('invoice.invoice_number') }}:</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $invoice->code }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="text-right space-y-1">
                        <div class="text-blue-100 text-sm">{{ __('invoice.date') }}</div>
                        <div class="text-2xl font-bold">{{ $invoice->created_at->format('d') }}</div>
                        <div class="text-lg">{{ $invoice->created_at->format('M Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Customer & Invoice Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <!-- Customer Info -->
                    <div class="lg:col-span-2">
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-100">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('invoice.bill_to') }}
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <span class="w-4 h-4 bg-blue-100 rounded-full flex-shrink-0 mt-1 mr-3"></span>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-lg">{{ $invoice->customer->name }}</div>
                                        @if($invoice->customer->email)
                                            <div class="text-gray-600 text-sm flex items-center mt-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $invoice->customer->email }}
                                            </div>
                                        @endif
                                        @if($invoice->customer->phone)
                                            <div class="text-gray-600 text-sm flex items-center mt-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                {{ $invoice->customer->phone }}
                                            </div>
                                        @endif
                                        @if($invoice->customer->address)
                                            <div class="text-gray-600 text-sm flex items-start mt-2">
                                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $invoice->customer->address }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Status & Details -->
                    <div class="space-y-4">
                        <!-- Status Badge -->
                        <div class="bg-white rounded-xl p-4 border-2 {{ $invoice->status === 'paid' ? 'border-green-200' : ($invoice->status === 'pending' ? 'border-yellow-200' : ($invoice->status === 'draft' ? 'border-gray-200' : 'border-red-200')) }}">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600">{{ __('invoice.status') }}</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider
                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' :
                                       ($invoice->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                       ($invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ __('invoice.' . $invoice->status) }}
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600">{{ __('invoice.payment_status') }}</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider
                                    {{ $invoice->paid_status === 'done' ? 'bg-green-100 text-green-800' :
                                       ($invoice->paid_status === 'overdue' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ __('invoice.' . $invoice->paid_status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Date Information -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                            @if($invoice->start_date)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">{{ __('invoice.start_date') }}:</span>
                                <span class="text-sm font-medium">{{ $invoice->start_date->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            
                            @if($invoice->due_date)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">{{ __('invoice.due_date') }}:</span>
                                <span class="text-sm font-medium {{ $invoice->due_date->isPast() && $invoice->paid_status !== 'done' ? 'text-red-600' : '' }}">
                                    {{ $invoice->due_date->format('d/m/Y') }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        {{ __('invoice.items') }}
                    </h3>
                    
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('invoice.no') }}</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('invoice.product') }}</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('invoice.qty') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('invoice.unit_price') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('invoice.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach($invoice->items as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-800 font-semibold">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->product_name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 text-right font-mono">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right font-mono">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Notes & Payment Proof -->
                    <div class="lg:col-span-2 space-y-6">
                        @if($invoice->notes)
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                            <h4 class="font-semibold mb-3 text-amber-800 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('invoice.notes') }}
                            </h4>
                            <p class="text-amber-700 leading-relaxed">{{ $invoice->notes }}</p>
                        </div>
                        @endif

                        @if($invoice->payment_proof)
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6 no-print">
                            <h4 class="font-semibold mb-3 text-green-800 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('invoice.payment_proof') }}
                            </h4>
                            <div class="mt-3">
                                <img src="{{ asset('storage/'.$invoice->payment_proof) }}" 
                                     alt="{{ __('invoice.payment_proof') }}"
                                     class="max-w-full h-auto rounded-lg border shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
                                     onclick="window.open(this.src, '_blank')">
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Payment Summary WITH TAX -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                            <h4 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('invoice.payment_summary') }}
                            </h4>

                            <div class="space-y-4">
                                <!-- Subtotal -->
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">{{ __('invoice.subtotal') }}:</span>
                                    <span class="font-semibold text-gray-900 font-mono">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                                </div>

                                <!-- Discount -->
                                @if($invoice->discount_percent > 0)
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">{{ __('invoice.discount') }}:</span>
                                        <span class="text-blue-600 font-medium">{{ $invoice->discount_percent }}%</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">Potongan:</span>
                                        <span class="text-red-500 font-medium font-mono">-Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600 font-medium">{{ __('invoice.subtotal_after_discount') }}:</span>
                                        <span class="font-semibold text-gray-900 font-mono">Rp {{ number_format($invoice->subtotal_after_discount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <!-- Tax -->
                                @if($invoice->tax_rate > 0)
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">{{ __('invoice.tax') }}:</span>
                                        <span class="text-green-600 font-medium">{{ number_format($invoice->tax_rate, 2) }}%</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">Biaya Pajak:</span>
                                        <span class="text-green-600 font-medium font-mono">+Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <hr class="border-gray-300">
                                
                                <!-- Grand Total -->
                                <div class="flex justify-between items-center py-3 bg-white rounded-lg px-4 shadow-sm border border-gray-100">
                                    <span class="text-lg font-bold text-gray-900">{{ __('invoice.grand_total') }}:</span>
                                    <span class="text-2xl font-bold text-green-600 font-mono">Rp {{ number_format($invoice->grand_total ?? $invoice->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 border-t border-gray-200 p-6 text-center">
                <p class="text-gray-500 text-sm flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ __('invoice.auto_generated') }} {{ $invoice->created_at->format('d/m/Y H:i') }} WIB
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        
        aside, nav, header,
        [class*="sidebar"],
        [class*="navigation"],
        [id*="sidebar"],
        [id*="navigation"] {
            display: none !important;
        }
        
        main {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        @page {
            size: A4;
            margin: 0.5in;
        }
        
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background: white !important;
        }
        
        .min-h-screen {
            min-height: auto !important;
            background: white !important;
        }
        
        .print-container {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .bg-white.shadow-2xl {
            box-shadow: none !important;
            border-radius: 0 !important;
            border: none !important;
        }
        
        .invoice-header {
            background: linear-gradient(to right, #2563eb, #9333ea, #1e40af) !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .rounded-2xl, .rounded-xl, .rounded-lg, .rounded-full {
            border-radius: 3px !important;
        }
        
        .shadow-2xl, .shadow-xl, .shadow-lg, .shadow-md, .shadow-sm, .shadow {
            box-shadow: none !important;
        }
        
        table {
            page-break-inside: auto;
            border-collapse: collapse;
        }
        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        thead {
            display: table-header-group;
        }
        
        .p-8 { padding: 12px !important; }
        .p-6 { padding: 10px !important; }
        .px-6 { padding-left: 8px !important; padding-right: 8px !important; }
        .py-4 { padding-top: 6px !important; padding-bottom: 6px !important; }
        
        .text-4xl { font-size: 28px !important; }
        .text-2xl { font-size: 20px !important; }
        .text-xl { font-size: 16px !important; }
        .text-lg { font-size: 14px !important; }
        
        .mb-8 { margin-bottom: 12px !important; }
        .mb-6 { margin-bottom: 10px !important; }
        .mb-4 { margin-bottom: 8px !important; }
        .gap-8 { gap: 10px !important; }
        
        .bg-gradient-to-br, .bg-amber-50, .bg-green-50, .bg-blue-50, .bg-indigo-50, .bg-gray-50 {
            background: #f9fafb !important;
        }
        
        .bg-green-100 { background: #dcfce7 !important; }
        .bg-yellow-100 { background: #fef3c7 !important; }
        .bg-red-100 { background: #fee2e2 !important; }
        .bg-gray-100 { background: #f3f4f6 !important; }
        .bg-blue-100 { background: #dbeafe !important; }
        
        .text-green-800, .text-yellow-800, .text-red-800, .text-gray-800, .text-blue-800,
        .text-amber-800, .text-green-600, .text-blue-600, .text-amber-700 {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }

    .gradient-text {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Dropdown Menu Styles */
    #langMenu, #pdfMenu {
        animation-duration: 0.2s;
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    #langButton:active, #pdfButton:active {
        transform: scale(0.98);
    }

    #langMenu button:active, #pdfMenu a:active {
        transform: scale(0.97);
    }
</style>

<script>
    // Toggle Language Menu Function dengan Fixed Positioning
    function toggleLanguageMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('langMenu');
        const button = document.getElementById('langButton');
        const chevron = document.getElementById('langChevron');
        const pdfMenu = document.getElementById('pdfMenu');
        
        // Close PDF menu if open
        if (pdfMenu && !pdfMenu.classList.contains('hidden')) {
            closePdfMenu();
        }
        
        if (menu.classList.contains('hidden')) {
            // Get button position
            const buttonRect = button.getBoundingClientRect();
            const menuWidth = 224; // 56 * 4 = 224px (w-56)
            const menuHeight = 160; // Approximate height
            
            // Calculate best position
            let top, left;
            const spaceBelow = window.innerHeight - buttonRect.bottom;
            const spaceAbove = buttonRect.top;
            
            // Horizontal positioning (align to right of button)
            left = buttonRect.right - menuWidth;
            
            // Ensure it doesn't go off-screen left
            if (left < 10) {
                left = buttonRect.left;
            }
            
            // Vertical positioning
            if (spaceBelow >= menuHeight + 10) {
                // Show below
                top = buttonRect.bottom + 8;
            } else if (spaceAbove >= menuHeight + 10) {
                // Show above
                top = buttonRect.top - menuHeight - 8;
            } else {
                // Not enough space either way, show below anyway
                top = buttonRect.bottom + 8;
            }
            
            // Apply position
            menu.style.top = top + 'px';
            menu.style.left = left + 'px';
            
            // Show menu
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
            }, 10);
            chevron.style.transform = 'rotate(180deg)';
        } else {
            // Hide menu
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Toggle PDF Menu dengan Fixed Positioning
    function togglePdfMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('pdfMenu');
        const button = document.getElementById('pdfButton');
        const chevron = document.getElementById('pdfChevron');
        const langMenu = document.getElementById('langMenu');
        
        // Close language menu if open
        if (langMenu && !langMenu.classList.contains('hidden')) {
            closeLanguageMenu();
        }
        
        if (menu.classList.contains('hidden')) {
            // Get button position
            const buttonRect = button.getBoundingClientRect();
            const menuWidth = 224; // 56 * 4 = 224px (w-56)
            const menuHeight = 160; // Approximate height
            
            // Calculate best position
            let top, left;
            const spaceBelow = window.innerHeight - buttonRect.bottom;
            const spaceAbove = buttonRect.top;
            
            // Horizontal positioning (align to right of button)
            left = buttonRect.right - menuWidth;
            
            // Ensure it doesn't go off-screen left
            if (left < 10) {
                left = buttonRect.left;
            }
            
            // Vertical positioning
            if (spaceBelow >= menuHeight + 10) {
                // Show below
                top = buttonRect.bottom + 8;
            } else if (spaceAbove >= menuHeight + 10) {
                // Show above
                top = buttonRect.top - menuHeight - 8;
            } else {
                // Not enough space either way, show below anyway
                top = buttonRect.bottom + 8;
            }
            
            // Apply position
            menu.style.top = top + 'px';
            menu.style.left = left + 'px';
            
            // Show menu
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
            }, 10);
            if (chevron) {
                chevron.style.transform = 'rotate(180deg)';
            }
        } else {
            closePdfMenu();
        }
    }

    // Helper function to close language menu
    function closeLanguageMenu() {
        const menu = document.getElementById('langMenu');
        const chevron = document.getElementById('langChevron');
        
        if (menu) {
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
        if (chevron) {
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Helper function to close PDF menu
    function closePdfMenu() {
        const menu = document.getElementById('pdfMenu');
        const chevron = document.getElementById('pdfChevron');
        
        if (menu) {
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
        if (chevron) {
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Close menus when clicking outside
    document.addEventListener('click', function(event) {
        const langMenu = document.getElementById('langMenu');
        const langButton = document.getElementById('langButton');
        const pdfMenu = document.getElementById('pdfMenu');
        const pdfButton = document.getElementById('pdfButton');
        
        // Close language menu if clicking outside
        if (langMenu && langButton && !langButton.contains(event.target) && !langMenu.contains(event.target)) {
            closeLanguageMenu();
        }
        
        // Close PDF menu if clicking outside
        if (pdfMenu && pdfButton && !pdfButton.contains(event.target) && !pdfMenu.contains(event.target)) {
            closePdfMenu();
        }
    });

    // Close menus on scroll
    window.addEventListener('scroll', function() {
        const langMenu = document.getElementById('langMenu');
        const pdfMenu = document.getElementById('pdfMenu');
        
        if (langMenu && !langMenu.classList.contains('hidden')) {
            closeLanguageMenu();
        }
        
        if (pdfMenu && !pdfMenu.classList.contains('hidden')) {
            closePdfMenu();
        }
    }, true);

    // Language Change Function (Backend tetap berfungsi)
    function changeLanguage(lang) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('lang', lang);
        window.location.href = currentUrl.toString();
    }

    // DOM Content Loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Button click animation
        const buttons = document.querySelectorAll('button, .btn, a[class*="bg-"]');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
        
        // Card fade-in animation
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

@endsection