<x-app-layout>
<x-slot name="header">
<h2>Products</h2>
</x-slot>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-blue-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Total Produk</h5>
        <h3 class="text-3xl font-bold">{{ $totalProducts }}</h3>
    </div>
    <div class="bg-green-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Produk Tersedia</h5>
        <h3 class="text-3xl font-bold">{{ $availableProducts }}</h3>
    </div>
    <div class="bg-yellow-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Stok Menipis (&lt;5)</h5>
        <h3 class="text-3xl font-bold">{{ $lowStock }}</h3>
    </div>
    <div class="bg-red-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Stok Habis</h5>
        <h3 class="text-3xl font-bold">{{ $outOfStock }}</h3>
    </div>
</div>


<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Product +</a>

    @if(session('success'))
        <div class="bg-green-100 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white p-4 rounded shadow">
                <div class="h-48 mb-2">
                    @if($product->photo)
                        <img src="{{ asset('storage/'.$product->photo) }}" class="w-full h-full object-cover rounded">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">No Image</div>
                    @endif
                </div>
                <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600">{{ $product->description }}</p>
                <p class="mt-1"><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
                <p class="mt-1"><strong>Price:</strong> Rp. {{ number_format($product->price,2) }}</p>
                <p class="mt-1"><strong>Stock:</strong> {{ $product->stock }}</p>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center">Belum ada product</p>
        @endforelse
    </div>

</div>
</div>
</x-app-layout>
