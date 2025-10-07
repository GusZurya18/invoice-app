<x-app-layout>
    <x-slot name="header">
        <h2>Buat Invoice Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label>Customer</label>
                    <select name="customer_id" class="w-full border p-2">
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Status</label>
                    <select name="status" class="w-full border p-2">
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label>Diskon (%)</label>
                    <input type="number" id="discount" name="discount_percent" class="w-full border p-2" value="0" min="0" max="100">
                </div>

                <div class="mb-4">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="w-full border p-2">
                </div>

                <div class="mb-4">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="w-full border p-2">
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
                        <tr class="item-row">
                            <td>
                                <select name="items[0][product_id]" class="product-select w-full border p-1">
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" value="1" class="qty w-full border p-1"></td>
                            <td class="unit-price">0.00</td>
                            <td class="line-total">0.00</td>
                            <td><button type="button" class="remove-row bg-red-500 text-white px-2 rounded">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="add-row" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Item</button>

                <div class="mb-4 mt-4">
                    <label>Bukti Pembayaran</label>
                    <input type="file" name="payment_proof" accept="image/*" class="w-full border p-2">
                </div>

                <div class="mb-4">
                    <label>Catatan</label>
                    <textarea name="notes" class="w-full border p-2" rows="3" placeholder="Tambahkan catatan untuk invoice..."></textarea>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
                    <h4 class="text-lg font-semibold mb-3">Ringkasan Pembayaran</h4>
                    
                    <div class="space-y-2">
                        <!-- Total Bayaran (Subtotal) -->
                        <div class="flex justify-between">
                            <span class="font-medium">Total Bayaran (sebelum diskon):</span>
                            <span id="subtotal-amount" class="font-bold">Rp 0</span>
                        </div>

                        <!-- Diskon Persen (hanya tampil jika ada diskon) -->
                        <div class="flex justify-between" id="discount-percent-row" style="display: none;">
                            <span class="text-gray-600">Diskon:</span>
                            <span id="discount-percent-display" class="text-gray-600">0%</span>
                        </div>

                        <!-- Total Diskon (hanya tampil jika ada diskon) -->
                        <div class="flex justify-between" id="discount-amount-row" style="display: none;">
                            <span class="text-red-600">Total Potongan Harga Diskon:</span>
                            <span id="discount-amount-display" class="font-medium text-red-600">-Rp 0</span>
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

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan Invoice</button>
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
            
            // Hitung subtotal dari semua item
            document.querySelectorAll('#items-table tbody tr').forEach(r=>{
                let qty = parseFloat(r.querySelector('.qty').value) || 0;
                let price = parseFloat(r.querySelector('.product-select').selectedOptions[0]?.dataset.price) || 0;

                r.querySelector('.unit-price').textContent = formatRupiah(price);
                let total = qty * price;
                r.querySelector('.line-total').textContent = formatRupiah(total);

                subtotal += total;
            });

            // Update subtotal (total bayaran sebelum diskon)
            document.getElementById('subtotal-amount').textContent = formatRupiah(subtotal);

            // Hitung dan tampilkan diskon
            let discountPercent = parseFloat(document.getElementById('discount').value) || 0;
            let discountAmount = 0;
            let grandTotal = subtotal;

            if(discountPercent > 0) {
                // Tampilkan baris diskon
                document.getElementById('discount-percent-row').style.display = 'flex';
                document.getElementById('discount-amount-row').style.display = 'flex';
                
                // Hitung diskon
                discountAmount = (discountPercent / 100) * subtotal;
                grandTotal = subtotal - discountAmount;
                
                // Update tampilan diskon
                document.getElementById('discount-percent-display').textContent = discountPercent + '%';
                document.getElementById('discount-amount-display').textContent = '-' + formatRupiah(discountAmount);
            } else {
                // Sembunyikan baris diskon jika tidak ada diskon
                document.getElementById('discount-percent-row').style.display = 'none';
                document.getElementById('discount-amount-row').style.display = 'none';
            }

            // Update grand total
            document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
        }

        // Tambah row
        document.getElementById('add-row').addEventListener('click', function(){
            let tbody = document.querySelector('#items-table tbody');
            let tr = document.querySelector('.item-row').cloneNode(true);

            // reset field
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

        // Event listener qty, produk, diskon
        document.querySelector('#items-table').addEventListener('input', recalc);
        document.querySelector('#items-table').addEventListener('change', recalc);
        document.getElementById('discount').addEventListener('input', recalc);

        // Inisialisasi
        recalc();
    })();
    </script>
</x-app-layout>