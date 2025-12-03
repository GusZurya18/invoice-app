@extends('layouts.master')

@section('title', 'Edit Invoice')

@section('page-title', 'Edit Invoice')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('invoices.index') }}" 
                    class="p-2 hover:bg-gray-200 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Invoice {{ $invoice->code }}</h1>
            </div>
            <p class="text-gray-600 ml-14">Update invoice details and save changes</p>
        </div>

        <form action="{{ route('invoices.update', $invoice) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Customer & Status Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Customer Information</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Select Customer <span class="text-red-500">*</span>
                                </label>
                                <select name="customer_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @foreach($customers as $c)
                                        <option value="{{ $c->id }}" {{ $invoice->customer_id == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Invoice Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @foreach(['draft', 'pending', 'paid', 'cancelled'] as $s)
                                            <option value="{{ $s }}" {{ $invoice->status == $s ? 'selected' : '' }}>
                                                @if($s == 'draft') 📝 @elseif($s == 'pending') ⏳ @elseif($s == 'paid') ✅ @else ❌ @endif
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Payment Status
                                    </label>
                                    <select name="paid_status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <option value="pending" {{ $invoice->paid_status === 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending
                                        </option>
                                        <option value="done" {{ $invoice->paid_status === 'done' ? 'selected' : '' }}>
                                            ✅ Done
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Discount And Tax Section  -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Invoice Details</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Start Date
                                </label>
                                <input type="date" name="start_date"
                                    value="{{ $invoice->start_date ? $invoice->start_date->format('Y-m-d') : '' }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Due Date
                                </label>
                                <input type="date" name="due_date"
                                    value="{{ $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '' }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Discount (%)
                                </label>
                                <div class="relative">
                                    <input type="number" id="discount" name="discount_percent" 
                                        value="{{ $invoice->discount_percent }}" min="0" max="100" step="0.01"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">%</span>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tax Rate (%)
                                </label>
                                <input 
                                    type="number" 
                                    id="tax_rate" 
                                    name="tax_rate" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                    value="{{ old('tax_rate', $invoice->tax_rate ?? $company->tax_rate) }}" 
                                    min="0" 
                                    max="100" 
                                    step="0.01"
                                >
                                <p class="mt-2 text-sm text-gray-500">
                                    💡 Current: {{ number_format($invoice->tax_rate ?? $company->tax_rate, 2) }}%. 
                                    Company default: {{ number_format($company->tax_rate, 2) }}%.
                                </p>
                                @error('tax_rate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Items Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Invoice Items</h2>
                            <button type="button" id="add-row"
                                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Item
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full" id="items-table">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-700">Product</th>
                                        <th class="text-center py-3 px-2 text-sm font-semibold text-gray-700 w-24">Qty</th>
                                        <th class="text-right py-3 px-2 text-sm font-semibold text-gray-700 w-32">Unit Price</th>
                                        <th class="text-right py-3 px-2 text-sm font-semibold text-gray-700 w-32">Total</th>
                                        <th class="w-12"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $idx => $item)
                                    <tr class="item-row border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-3 px-2">
                                            <select name="items[{{ $idx }}][product_id]" required
                                                class="product-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                                @foreach($products as $p)
                                                    <option value="{{ $p->id }}" 
                                                        data-price="{{ $p->price }}" 
                                                        {{ $p->id == $item->product_id ? 'selected' : '' }}>
                                                        {{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="py-3 px-2">
                                            <input type="number" name="items[{{ $idx }}][quantity]" 
                                                value="{{ $item->quantity }}" min="1" required
                                                class="qty w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-sm">
                                        </td>
                                        <td class="py-3 px-2 text-right unit-price font-medium text-gray-700 text-sm">Rp 0</td>
                                        <td class="py-3 px-2 text-right line-total font-semibold text-gray-900 text-sm">Rp 0</td>
                                        <td class="py-3 px-2 text-center">
                                            <button type="button" class="remove-row p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment Proof & Notes -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Additional Information</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Proof (Image)
                                </label>
                                
                                @if($invoice->payment_proof)
                                <div class="mb-3 relative inline-block">
                                    <img src="{{ asset('storage/'.$invoice->payment_proof) }}" 
                                        class="w-40 h-40 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                        Current
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">Upload a new image to replace the current one</p>
                                @endif
                                
                                <input type="file" name="payment_proof" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Notes / Comments
                                </label>
                                <textarea name="notes" rows="4" 
                                    placeholder="Add any additional notes or comments about this invoice..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $invoice->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg border border-blue-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Payment Summary
                            </h3>

                            <div class="space-y-3">
                                <!-- Subtotal -->
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 font-medium">Subtotal</span>
                                    <span id="subtotal-amount" class="text-lg font-bold text-gray-900">Rp 0</span>
                                </div>

                                <!-- Discount Percent -->
                                <div class="flex justify-between items-center py-2" id="discount-percent-row" style="display: none;">
                                    <span class="text-gray-600">Discount</span>
                                    <span id="discount-percent-display" class="text-orange-600 font-semibold">0%</span>
                                </div>

                                <!-- Discount Amount -->
                                <div class="flex justify-between items-center py-2" id="discount-amount-row" style="display: none;">
                                    <span class="text-gray-600">Discount Amount</span>
                                    <span id="discount-amount-display" class="text-red-600 font-semibold">-Rp 0</span>
                                </div>

                                <!-- Subtotal After Discount -->
                                <div class="flex justify-between items-center py-2" id="subtotal-after-discount-row">
                                    <span class="text-gray-600 font-medium">After Discount</span>
                                    <span id="subtotal-after-discount" class="font-bold text-gray-900">Rp 0</span>
                                </div>

                                <!-- Tax Row -->
                                <div class="flex justify-between items-center py-2" id="tax-row">
                                    <span class="text-gray-600">Tax (<span id="tax-percent-display">0</span>%)</span>
                                    <span id="tax-amount-display" class="text-green-600 font-semibold">+Rp 0</span>
                                </div>

                                <hr class="border-gray-300 my-3">

                                <!-- Grand Total -->
                                <div class="flex justify-between items-center py-3 bg-white rounded-lg px-4 shadow-sm">
                                    <span class="text-lg font-bold text-gray-900">Grand Total</span>
                                    <span id="grand-total" class="text-2xl font-bold text-green-600">Rp 0</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 mt-6">
                                <!-- Update Button -->
                                <button type="submit" 
                                    class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Update Invoice
                                </button>

                                <!-- Delete Button -->
                                <button type="button" onclick="confirmDelete()"
                                    class="w-full px-6 py-3 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete Invoice
                                </button>

                                <!-- Cancel Button -->
                                <a href="{{ route('invoices.index') }}"
                                    class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Delete Form (Hidden) -->
        <form id="delete-form" action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
(function(){
    let idx = {{ $invoice->items->count() }};

    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    function recalc(){
        let subtotal = 0;
        
        // 1. Hitung subtotal dari semua item
        document.querySelectorAll('#items-table tbody tr').forEach(r=>{
            let qty = parseFloat(r.querySelector('.qty').value) || 0;
            let price = parseFloat(r.querySelector('.product-select').selectedOptions[0]?.dataset.price) || 0;

            r.querySelector('.unit-price').textContent = formatRupiah(price);
            let total = qty * price;
            r.querySelector('.line-total').textContent = formatRupiah(total);

            subtotal += total;
        });

        // Update subtotal
        document.getElementById('subtotal-amount').textContent = formatRupiah(subtotal);

        // 2. Hitung diskon
        let discountPercent = parseFloat(document.getElementById('discount').value) || 0;
        let discountAmount = 0;
        let subtotalAfterDiscount = subtotal;

        if(discountPercent > 0) {
            document.getElementById('discount-percent-row').style.display = 'flex';
            document.getElementById('discount-amount-row').style.display = 'flex';
            
            discountAmount = (discountPercent / 100) * subtotal;
            subtotalAfterDiscount = subtotal - discountAmount;
            
            document.getElementById('discount-percent-display').textContent = discountPercent + '%';
            document.getElementById('discount-amount-display').textContent = '-' + formatRupiah(discountAmount);
        } else {
            document.getElementById('discount-percent-row').style.display = 'none';
            document.getElementById('discount-amount-row').style.display = 'none';
        }

        // Update subtotal after discount
        document.getElementById('subtotal-after-discount').textContent = formatRupiah(subtotalAfterDiscount);

        // 3. Hitung pajak (berdasarkan subtotal setelah diskon)
        let taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;
        let taxAmount = 0;

        if(taxRate > 0) {
            taxAmount = (taxRate / 100) * subtotalAfterDiscount;
            document.getElementById('tax-row').style.display = 'flex';
            document.getElementById('tax-percent-display').textContent = taxRate.toFixed(2);
            document.getElementById('tax-amount-display').textContent = '+' + formatRupiah(taxAmount);
        } else {
            document.getElementById('tax-row').style.display = 'none';
        }

        // 4. Grand Total = Subtotal - Diskon + Pajak
        let grandTotal = subtotalAfterDiscount + taxAmount;
        document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
    }

    // Add row button
    document.getElementById('add-row').addEventListener('click', function(){
        let tbody = document.querySelector('#items-table tbody');
        let tr = document.querySelector('.item-row').cloneNode(true);
        
        tr.querySelectorAll('input').forEach(i=>{
            i.name = i.name.replace(/\d+/, idx);
            if(i.classList.contains('qty')) i.value = 1;
        });
        
        tr.querySelectorAll('select').forEach(s=>{
            s.name = s.name.replace(/\d+/, idx);
            s.selectedIndex = 0;
            if(s.options[0]) {
                s.dataset.price = s.options[0].dataset.price || 0;
            }
        });
        
        tr.querySelector('.unit-price').textContent = formatRupiah(0);
        tr.querySelector('.line-total').textContent = formatRupiah(0);
        tbody.appendChild(tr);
        idx++;
        recalc();
    });

    // Remove row button
    document.querySelector('#items-table').addEventListener('click', function(e){
        if(e.target.closest('.remove-row')){
            let rows = document.querySelectorAll('#items-table tbody tr');
            if(rows.length > 1){
                e.target.closest('tr').remove();
                recalc();
            }
        }
    });

    // Event listeners untuk recalculate
    document.querySelector('#items-table').addEventListener('input', recalc);
    document.querySelector('#items-table').addEventListener('change', recalc);
    document.getElementById('discount').addEventListener('input', recalc);
    document.getElementById('tax_rate').addEventListener('input', recalc);

    // Initial calculation
    recalc();
})();

function confirmDelete() {
    if(confirm('Are you sure you want to delete this invoice? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection