<x-app-layout>
    <x-slot name="header" class="no-print">
        <h2>Invoice {{ $invoice->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            
            <!-- Action Buttons -->
            <div class="mb-6 flex justify-between items-center bg-white p-4 rounded shadow no-print">
                <a href="{{ route('invoices.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    ← Kembali ke Daftar Invoice
                </a>
                
                <div class="space-x-2">
                    <a href="{{ route('invoices.edit', $invoice) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Edit Invoice
                    </a>
                    <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Print
                    </button>
                    <a href="{{ route('invoices.pdf', $invoice) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Download PDF
                    </a>
                </div>
            </div>

            <!-- Invoice Content -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold">INVOICE</h1>
                            <p class="text-blue-100 mt-1">{{ $invoice->code }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm opacity-90">Tanggal Invoice</div>
                            <div class="text-lg font-semibold">{{ $invoice->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Customer & Invoice Info -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        
                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">Kepada:</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="font-semibold text-gray-900">{{ $invoice->customer->name }}</div>
                                @if($invoice->customer->email)
                                    <div class="text-gray-600 text-sm mt-1">{{ $invoice->customer->email }}</div>
                                @endif
                                @if($invoice->customer->phone)
                                    <div class="text-gray-600 text-sm">{{ $invoice->customer->phone }}</div>
                                @endif
                                @if($invoice->customer->address)
                                    <div class="text-gray-600 text-sm mt-2">{{ $invoice->customer->address }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Invoice Details -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">Detail Invoice:</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                           ($invoice->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </div>
                                
                                @if($invoice->start_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Mulai:</span>
                                    <span class="font-medium">{{ $invoice->start_date->format('d/m/Y') }}</span>
                                </div>
                                @endif
                                
                                @if($invoice->due_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jatuh Tempo:</span>
                                    <span class="font-medium {{ $invoice->due_date->isPast() && $invoice->paid_status !== 'done' ? 'text-red-600' : '' }}">
                                        {{ $invoice->due_date->format('d/m/Y') }}
                                    </span>
                                </div>
                                @endif
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status Pembayaran:</span>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $invoice->paid_status === 'done' ? 'bg-green-100 text-green-800' : 
                                           ($invoice->paid_status === 'overdue' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($invoice->paid_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">Item Invoice:</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border-b border-gray-300 p-3 text-left">No</th>
                                        <th class="border-b border-gray-300 p-3 text-left">Produk</th>
                                        <th class="border-b border-gray-300 p-3 text-center">Qty</th>
                                        <th class="border-b border-gray-300 p-3 text-right">Harga Satuan</th>
                                        <th class="border-b border-gray-300 p-3 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $index => $item)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="p-3">{{ $index + 1 }}</td>
                                        <td class="p-3 font-medium">{{ $item->product_name }}</td>
                                        <td class="p-3 text-center">{{ $item->quantity }}</td>
                                        <td class="p-3 text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                        <td class="p-3 text-right font-medium">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Notes & Payment Proof -->
                        <div>
                            @if($invoice->notes)
                            <div class="mb-4">
                                <h4 class="font-semibold mb-2 text-gray-800">Catatan:</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700">{{ $invoice->notes }}</p>
                                </div>
                            </div>
                            @endif

                            @if($invoice->payment_proof)
                            <div>
                                <h4 class="font-semibold mb-2 text-gray-800">Bukti Pembayaran:</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <img src="{{ asset('storage/'.$invoice->payment_proof) }}" 
                                         alt="Bukti Pembayaran" 
                                         class="max-w-full h-auto rounded border cursor-pointer hover:shadow-lg transition-shadow"
                                         onclick="window.open(this.src, '_blank')">
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Payment Summary WITH TAX -->
                        <div>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 text-gray-800">Ringkasan Pembayaran</h4>
                                
                                <div class="space-y-3">
                                    <!-- Subtotal -->
                                    <div class="flex justify-between">
                                        <span class="font-medium">Subtotal:</span>
                                        <span class="font-bold">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                                    </div>

                                    <!-- Discount -->
                                    @if($invoice->discount_percent > 0)
                                        <div class="flex justify-between text-gray-600">
                                            <span>Diskon ({{ $invoice->discount_percent }}%):</span>
                                            <span>-Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between font-medium">
                                            <span>Subtotal Setelah Diskon:</span>
                                            <span>Rp {{ number_format($invoice->subtotal_after_discount, 0, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <!-- Tax -->
                                    @if($invoice->tax_rate > 0)
                                        <div class="flex justify-between text-blue-600">
                                            <span>Pajak ({{ number_format($invoice->tax_rate, 2) }}%):</span>
                                            <span class="font-medium">+Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <hr class="my-4 border-gray-300">

                                    <!-- Grand Total -->
                                    <div class="flex justify-between text-xl font-bold">
                                        <span>Grand Total:</span>
                                        <span class="text-green-600">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 p-4 text-center text-gray-600 text-sm">
                    <p>Invoice ini dibuat secara otomatis pada {{ $invoice->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .shadow-lg { box-shadow: none !important; }
            header, nav, .bg-white.shadow { display: none !important; }
            body { margin: 0 !important; padding: 0 !important; }
            .py-12 { padding: 20px !important; }
        }
    </style>
</x-app-layout>