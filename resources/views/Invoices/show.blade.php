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
                        <h1 class="text-2xl font-bold text-gray-900">Invoice {{ $invoice->code }}</h1>
                        <p class="text-sm text-gray-500">Detail dan informasi lengkap invoice</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('invoices.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    
                    <a href="{{ route('invoices.edit', $invoice) }}" 
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    
                    <button onclick="window.print()" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print
                    </button>
                    
                    <a href="{{ route('invoices.pdf', $invoice) }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        PDF
                    </a>
                </div>
            </div>
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
                        <h1 class="text-4xl font-bold tracking-tight">INVOICE</h1>
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-100 text-sm font-medium">No. Invoice:</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $invoice->code }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="text-right space-y-1">
                        <div class="text-blue-100 text-sm">Tanggal Invoice</div>
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
                                Informasi Pelanggan
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
                                <span class="text-sm font-medium text-gray-600">Status Invoice</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider
                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' :
                                       ($invoice->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                       ($invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ $invoice->status }}
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600">Status Pembayaran</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider
                                    {{ $invoice->paid_status === 'done' ? 'bg-green-100 text-green-800' :
                                       ($invoice->paid_status === 'overdue' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $invoice->paid_status }}
                                </span>
                            </div>
                        </div>

                        <!-- Date Information -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                            @if($invoice->start_date)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Tanggal Mulai:</span>
                                <span class="text-sm font-medium">{{ $invoice->start_date->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            
                            @if($invoice->due_date)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Jatuh Tempo:</span>
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
                        Item Invoice
                    </h3>
                    
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produk</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Qty</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga Satuan</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @php $subtotal = 0; @endphp
                                    @foreach($invoice->items as $index => $item)
                                    @php $subtotal += $item->total; @endphp
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
                                Catatan
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
                                Bukti Pembayaran
                            </h4>
                            <div class="mt-3">
                                <img src="{{ asset('storage/'.$invoice->payment_proof) }}" 
                                     alt="Bukti Pembayaran"
                                     class="max-w-full h-auto rounded-lg border shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
                                     onclick="window.open(this.src, '_blank')">
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Payment Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                            <h4 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Ringkasan
                            </h4>

                            <div class="space-y-4">
                                <!-- Subtotal -->
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span class="font-semibold text-gray-900 font-mono">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                <!-- Discount -->
                                @if($invoice->discount_percent > 0)
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">Diskon:</span>
                                        <span class="text-blue-600 font-medium">{{ $invoice->discount_percent }}%</span>
                                    </div>
                                    
                                    @php $discountAmount = ($invoice->discount_percent / 100) * $subtotal; @endphp
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">Potongan:</span>
                                        <span class="text-red-500 font-medium font-mono">-Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <hr class="border-gray-300">
                                
                                <!-- Grand Total -->
                                <div class="flex justify-between items-center py-3 bg-white rounded-lg px-4 shadow-sm border border-gray-100">
                                    <span class="text-lg font-bold text-gray-900">Grand Total:</span>
                                    <span class="text-2xl font-bold text-green-600 font-mono">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
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
                    Invoice dibuat otomatis pada {{ $invoice->created_at->format('d/m/Y H:i') }} WIB
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        /* Hide elements that shouldn't print */
        .no-print {
            display: none !important;
        }
        
        /* Hide sidebar and navigation from master layout */
        aside, 
        nav,
        header,
        [class*="sidebar"],
        [class*="navigation"],
        [id*="sidebar"],
        [id*="navigation"] {
            display: none !important;
        }
        
        /* Make main content full width */
        main {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Force color printing */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Page setup */
        @page {
            size: A4;
            margin: 0.5in;
        }
        
        /* Reset body and html */
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background: white !important;
        }
        
        /* Container adjustments */
        .min-h-screen {
            min-height: auto !important;
            background: white !important;
        }
        
        .print-container {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        /* Main card */
        .bg-white.shadow-2xl {
            box-shadow: none !important;
            border-radius: 0 !important;
            border: none !important;
        }
        
        /* Keep invoice header gradient */
        .invoice-header {
            background: linear-gradient(to right, #2563eb, #9333ea, #1e40af) !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Simplify other elements */
        .rounded-2xl, .rounded-xl, .rounded-lg, .rounded-full {
            border-radius: 3px !important;
        }
        
        .shadow-2xl, .shadow-xl, .shadow-lg, .shadow-md, .shadow-sm, .shadow {
            box-shadow: none !important;
        }
        
        /* Table styling */
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
        
        /* Adjust padding for print */
        .p-8 {
            padding: 12px !important;
        }
        
        .p-6 {
            padding: 10px !important;
        }
        
        .px-6 {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
        
        .py-4 {
            padding-top: 6px !important;
            padding-bottom: 6px !important;
        }
        
        /* Text sizing */
        .text-4xl {
            font-size: 28px !important;
        }
        
        .text-2xl {
            font-size: 20px !important;
        }
        
        .text-xl {
            font-size: 16px !important;
        }
        
        .text-lg {
            font-size: 14px !important;
        }
        
        /* Spacing */
        .mb-8 {
            margin-bottom: 12px !important;
        }
        
        .mb-6 {
            margin-bottom: 10px !important;
        }
        
        .mb-4 {
            margin-bottom: 8px !important;
        }
        
        .gap-8 {
            gap: 10px !important;
        }
        
        /* Keep backgrounds readable */
        .bg-gradient-to-br,
        .bg-amber-50,
        .bg-green-50,
        .bg-blue-50,
        .bg-indigo-50,
        .bg-gray-50 {
            background: #f9fafb !important;
        }
        
        /* Status badges */
        .bg-green-100 {
            background: #dcfce7 !important;
        }
        
        .bg-yellow-100 {
            background: #fef3c7 !important;
        }
        
        .bg-red-100 {
            background: #fee2e2 !important;
        }
        
        .bg-gray-100 {
            background: #f3f4f6 !important;
        }
        
        .bg-blue-100 {
            background: #dbeafe !important;
        }
        
        /* Keep text colors */
        .text-green-800,
        .text-yellow-800,
        .text-red-800,
        .text-gray-800,
        .text-blue-800,
        .text-amber-800,
        .text-green-600,
        .text-blue-600,
        .text-amber-700 {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }

    /* Smooth animations */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Custom hover effects */
    .hover-scale:hover {
        transform: scale(1.02);
    }

    /* Gradient text */
    .gradient-text {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<!-- JavaScript for enhanced interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Add click animation to buttons
        const buttons = document.querySelectorAll('button, .btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
        
        // Add fade-in animation on load
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