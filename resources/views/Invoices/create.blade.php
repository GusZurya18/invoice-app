@extends('layouts.master')

@section('title', 'Create Invoice')

@section('page-title', 'Create Invoice')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Invoice</h1>
            <p class="text-gray-600 mt-2">Fill in the details below to create a new invoice</p>
        </div>

        <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
                                    <option value="">Choose a customer...</option>
                                    @foreach($customers as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Invoice Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="draft">📝 Draft</option>
                                    <option value="pending">⏳ Pending</option>
                                    <option value="paid">✅ Paid</option>
                                    <option value="cancelled">❌ Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Discount Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Invoice Details</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Start Date
                                </label>
                                <input type="date" name="start_date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Due Date
                                </label>
                                <input type="date" name="due_date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Discount (%)
                                </label>
                                <div class="relative">
                                    <input type="number" id="discount" name="discount_percent" 
                                        value="0" min="0" max="100" step="0.01"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">%</span>
                                </div>
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
                                    <tr class="item-row border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-3 px-2">
                                            <select name="items[0][product_id]" required
                                                class="product-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                                @foreach($products as $p)
                                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="py-3 px-2">
                                            <input type="number" name="items[0][quantity]" value="1" min="1" required
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
                                <input type="file" name="payment_proof" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Notes / Comments
                                </label>
                                <textarea name="notes" rows="4" 
                                    placeholder="Add any additional notes or comments about this invoice..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
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

                                <hr class="border-gray-300 my-3">

                                <!-- Grand Total -->
                                <div class="flex justify-between items-center py-3 bg-white rounded-lg px-4 shadow-sm">
                                    <span class="text-lg font-bold text-gray-900">Grand Total</span>
                                    <span id="grand-total" class="text-2xl font-bold text-green-600">Rp 0</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                class="w-full mt-6 px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function(){
    let idx = 1;
    
    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    function recalc(){
        let subtotal = 0;
        
        document.querySelectorAll('#items-table tbody tr').forEach(r=>{
            let qty = parseFloat(r.querySelector('.qty').value) || 0;
            let price = parseFloat(r.querySelector('.product-select').selectedOptions[0]?.dataset.price) || 0;
            r.querySelector('.unit-price').textContent = formatRupiah(price);
            let total = qty * price;
            r.querySelector('.line-total').textContent = formatRupiah(total);
            subtotal += total;
        });

        document.getElementById('subtotal-amount').textContent = formatRupiah(subtotal);

        let discountPercent = parseFloat(document.getElementById('discount').value) || 0;
        let discountAmount = 0;
        let grandTotal = subtotal;

        if(discountPercent > 0) {
            document.getElementById('discount-percent-row').style.display = 'flex';
            document.getElementById('discount-amount-row').style.display = 'flex';
            
            discountAmount = (discountPercent / 100) * subtotal;
            grandTotal = subtotal - discountAmount;
            
            document.getElementById('discount-percent-display').textContent = discountPercent + '%';
            document.getElementById('discount-amount-display').textContent = '-' + formatRupiah(discountAmount);
        } else {
            document.getElementById('discount-percent-row').style.display = 'none';
            document.getElementById('discount-amount-row').style.display = 'none';
        }

        document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
    }

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
        });
        
        tr.querySelector('.unit-price').textContent = formatRupiah(0);
        tr.querySelector('.line-total').textContent = formatRupiah(0);
        tbody.appendChild(tr);
        idx++;
        recalc();
    });

    document.querySelector('#items-table').addEventListener('click', function(e){
        if(e.target.closest('.remove-row')){
            let rows = document.querySelectorAll('#items-table tbody tr');
            if(rows.length > 1){
                e.target.closest('tr').remove();
                recalc();
            }
        }
    });

    document.querySelector('#items-table').addEventListener('input', recalc);
    document.querySelector('#items-table').addEventListener('change', recalc);
    document.getElementById('discount').addEventListener('input', recalc);

    recalc();
})();
</script>
@endsection