<x-app-layout>
    <x-slot name="header">
        <h2>Buat Invoice Baru</h2>
    </x-slot>

<x-slot name="header"><h2>Buat Invoice</h2></x-slot>

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
<input type="number" name="discount_percent" class="w-full border p-2" value="0" min="0" max="100">
</div>

<h3>Item</h3>
<table class="w-full mb-4 border" id="items-table">
<thead class="bg-gray-100">
<tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Total</th><th></th></tr>
</thead>
<tbody>
<tr class="item-row">
<td>
<select name="items[0][product_id]" class="product-select w-full border p-1">
@foreach($products as $p)
<option value="{{ $p->id }}">{{ $p->name }}</option>
@endforeach
</select>
</td>
<td><input type="number" name="items[0][quantity]" value="1" class="qty w-full border p-1"></td>
<td class="unit-price">0</td>
<td class="line-total">0</td>
<td><button type="button" class="remove-row">-</button></td>
</tr>
</tbody>
</table>
<button type="button" id="add-row" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah Item</button>

<div class="mb-4 mt-4">
<label>Bukti Pembayaran</label>
<input type="file" name="payment_proof" accept="image/*" class="w-full border p-2">
</div>

<div class="mb-4">
<strong>Total: <span id="grand-total">0</span></strong>
</div>

<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan Invoice</button>
</form>

</div>
</div>

<script>
(function(){
let idx=1;
function recalc(){
let grand=0;
document.querySelectorAll('#items-table tbody tr').forEach(r=>{
let qty=parseFloat(r.querySelector('.qty').value)||0;
let price=parseFloat(r.querySelector('.product-select').selectedOptions[0].dataset.price)||0;
r.querySelector('.unit-price').textContent=price.toFixed(2);
let total=qty*price;
r.querySelector('.line-total').textContent=total.toFixed(2);
grand+=total;
});
document.getElementById('grand-total').textContent=grand.toFixed(2);
}

document.getElementById('add-row').addEventListener('click', function(){
let tbody=document.querySelector('#items-table tbody');
let tr=document.querySelector('.item-row').cloneNode(true);
tr.querySelectorAll('input,select').forEach(i=>{
i.name=i.name.replace(/\d+/, idx);
if(i.classList.contains('qty')) i.value=1;
});
tbody.appendChild(tr);
idx++;
recalc();
});

document.querySelector('#items-table').addEventListener('input',function(e){recalc();});
document.querySelector('#items-table').addEventListener('change',function(e){recalc();});

recalc();
})();
</script>

</x-app-layout>
