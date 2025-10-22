<x-app-layout>
    <x-slot name="header">
        <h2>Edit Invoice {{ $invoice->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('invoices.update', $invoice) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Customer</label>
                    <select name="customer_id" class="w-full border p-2">
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}" {{ $invoice->customer_id==$c->id?'selected':'' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Status</label>
                    <select name="status" class="w-full border p-2">
                        @foreach(['draft','pending','paid','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $invoice->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Diskon (%)</label>
                    <input type="number" id="discount" name="discount_percent" class="w-full border p-2" value="{{ $invoice->discount_percent }}" min="0" max="100" step="0.01">
                </div>

                <!-- TAX RATE INPUT - BARU -->
                <div class="mb-4">
                    <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-1">
                        Tax Rate (%)
                    </label>
                    <input 
                        type="number" 
                        id="tax_rate" 
                        name="tax_rate" 
                        class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        value="{{ old('tax_rate', $invoice->tax_rate ?? $company->tax_rate) }}" 
                        min="0" 
                        max="100" 
                        step="0.01"
                    >
                    <p class="mt-1 text-sm text-gray-500">
                        💡 Current: {{ number_format($invoice->tax_rate ?? $company->tax_rate, 2) }}%. 
                        Company default: {{ number_format($company->tax_rate, 2) }}%.
                    </p>
                    @error('tax_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="w-full border p-2"
                        value="{{ $invoice->start_date ? $invoice->start_date->format('Y-m-d') : '' }}">
                </div>

                <div class="mb-4">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="w-full border p-2"
                        value="{{ $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '' }}">
                </div>

                <div class="mb-4">
                    <label>Paid Status</label>
                    <select name="paid_status" class="w-full border p-2">
                        <option value="pending" {{ $invoice->paid_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="done" {{ $invoice->paid_status === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <h3>Item</h3>
                <table class="w-full mb-4 border" id="items-table">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $idx=>$item)
                        <tr class="item-row">
                            <td>
                                <select name="items[{{ $idx }}][product_id]" class="product-select w-full border p-1" data-price="{{ $item->unit_price }}">
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}" data-price="{{ $p->price }}" {{ $p->id==$item->product_id?'selected':'' }}>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[{{ $idx }}][quantity]" value="{{ $item->quantity }}" class="qty w-full border p-1"></td>
                            <td class="unit-price">{{ $item->unit_price }}</td>
                            <td class="line-total">{{ $item->total }}</td>
                            <td><button type="button" class="remove-row bg-red-500 text-white px-2 rounded">-</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" id="add-row" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Item</button>

                <div class="mb-4 mt-4">
                    <label>Bukti Pembayaran</label>
                    @if($invoice->payment_proof)
                        <div class="mb-2"><img src="{{ asset('storage/'.$invoice->payment_proof) }}" class="w-32 h-32 object-cover rounded"></div>
                    @endif
                    <input type="file" name="payment_proof" accept="image/*" class="w-full border p-2">
                </div>

                <div class="mb-4">
                    <label>Catatan</label>
                    <textarea name="notes" class="w-full border p-2" rows="3">{{ $invoice->notes }}</textarea>
                </div>

                <!-- Ringkasan Pembayaran - UPDATED WITH TAX -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
                    <h4 class="text-lg font-semibold mb-3">Ringkasan Pembayaran</h4>
                    
                    <div class="space-y-2">
                        <!-- Subtotal -->
                        <div class="flex justify-between">
                            <span class="font-medium">Subtotal (sebelum diskon & pajak):</span>
                            <span id="subtotal-amount" class="font-bold">Rp 0</span>
                        </div>

                        <!-- Diskon Persen -->
                        <div class="flex justify-between" id="discount-percent-row" style="display: none;">
                            <span class="text-gray-600">Diskon:</span>
                            <span id="discount-percent-display" class="text-gray-600">0%</span>
                        </div>

                        <!-- Total Diskon -->
                        <div class="flex justify-between" id="discount-amount-row" style="display: none;">
                            <span class="text-red-600">Potongan Diskon:</span>
                            <span id="discount-amount-display" class="font-medium text-red-600">-Rp 0</span>
                        </div>

                        <!-- Subtotal After Discount -->
                        <div class="flex justify-between" id="subtotal-after-discount-row">
                            <span class="font-medium">Subtotal Setelah Diskon:</span>
                            <span id="subtotal-after-discount" class="font-bold">Rp 0</span>
                        </div>

                        <!-- Tax -->
                        <div class="flex justify-between" id="tax-row">
                            <span class="text-blue-600">Pajak (<span id="tax-percent-display">0</span>%):</span>
                            <span id="tax-amount-display" class="font-medium text-blue-600">+Rp 0</span>
                        </div>

                        <!-- Garis Pembatas -->
                        <hr class="my-3 border-gray-300">
                        
                        <!-- Grand Total -->
                        <div class="flex justify-between">
                            <span class="text-xl font-bold">Grand Total:</span>
                            <span id="grand-total" class="text-xl font-bold text-green-600">Rp 0</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Invoice</button>
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

            // 3. Hitung pajak
            let taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;
            let taxAmount = 0;

            if(taxRate > 0) {
                taxAmount = (taxRate / 100) * subtotalAfterDiscount;
                document.getElementById('tax-row').style.display = 'flex';
            } else {
                document.getElementById('tax-row').style.display = 'none';
            }

            document.getElementById('tax-percent-display').textContent = taxRate.toFixed(2);
            document.getElementById('tax-amount-display').textContent = '+' + formatRupiah(taxAmount);

            // 4. Grand Total
            let grandTotal = subtotalAfterDiscount + taxAmount;
            document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
        }

        // Tambah row
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

        // Hapus row
        document.querySelector('#items-table').addEventListener('click', function(e){
            if(e.target.classList.contains('remove-row')){
                let rows = document.querySelectorAll('#items-table tbody tr');
                if(rows.length > 1){ 
                    e.target.closest('tr').remove();
                    recalc();
                }
            }
        });

        // Event listeners
        document.querySelector('#items-table').addEventListener('input', recalc);
        document.querySelector('#items-table').addEventListener('change', recalc);
        document.getElementById('discount').addEventListener('input', recalc);
        document.getElementById('tax_rate').addEventListener('input', recalc); // TAX RATE LISTENER

        // Inisialisasi
        recalc();
    })();
    </script>
</x-app-layout>