<x-app-layout>
    <x-slot name="header">
        <h2>Invoice</h2>
    </x-slot>

 {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-lg">Total Invoice</h2>
            <p class="text-2xl font-bold">{{ $totalInvoices }}</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-lg">Dibayar</h2>
            <p class="text-2xl font-bold">{{ $paidInvoices }}</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-lg">Belum Dibayar</h2>
            <p class="text-2xl font-bold">{{ $unpaidInvoices }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow">
            <h2 class="text-lg">Pending</h2>
            <p class="text-2xl font-bold">{{ $pendingInvoices }}</p>
        </div>
    </div>

<x-slot name="header"><h2>Daftar Invoice</h2></x-slot>

<div class="py-12">
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

<a href="{{ route('invoices.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Buat Invoice Baru</a>

<table class="w-full border-collapse border">
<thead class="bg-gray-100">
<tr>
<th class="border p-2">Kode</th>
<th class="border p-2">Customer</th>
<th class="border p-2">Status</th>
<th class="border p-2">Total</th>
<th class="border p-2">Diskon (%)</th>
<th class="border p-2">Start Date</th>
<th class="border p-2">Due Date</th>
<th class="border p-2">Paid Status</th>
<th class="border p-2">Aksi</th>
</tr>
</thead>
<tbody>
@forelse($invoices as $inv)
<tr>
<td class="border p-2">{{ $inv->code }}</td>
<td class="border p-2">{{ $inv->customer->name ?? '-' }}</td>
<td class="border p-2">{{ ucfirst($inv->status) }}</td>
<td class="border p-2">Rp {{ number_format($inv->total_amount,2) }}</td>
<td class="border p-2">{{ $inv->discount_percent }}</td>

 <td class="border p-2">{{ $inv->start_date ? $inv->start_date->toDateString() : '-' }}</td>
    <td class="border p-2">{{ $inv->due_date ? $inv->due_date->toDateString() : '-' }}</td>
    <td class="border p-2">
        @if($inv->paid_status === 'done')
            <span class="text-green-600 font-bold">Done</span>
        @elseif($inv->due_date && now()->gt($inv->due_date))
            <span class="text-red-600 font-bold">Overdue</span>
        @else
            <span class="text-yellow-600 font-bold">Pending</span>
        @endif
    </td>

<td class="border p-2 space-x-2">
<a href="{{ route('invoices.show', $inv) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Lihat</a>
<a href="{{ route('invoices.edit', $inv) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
<form action="{{ route('invoices.destroy',$inv) }}" method="POST" class="inline">
@csrf @method('DELETE')
<button class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin hapus?')">Hapus</button>
</form>
<a href="{{ route('invoices.pdf',$inv) }}" class="bg-blue-500 text-white px-2 py-1 rounded">PDF</a>
</td>
</tr>
@empty
<tr><td colspan="6" class="text-center p-4">Belum ada invoice</td></tr>
@endforelse
</tbody>
</table>

<div class="mt-4">
{{ $invoices->links() }}
</div>

</div>
</div>
</x-app-layout>

