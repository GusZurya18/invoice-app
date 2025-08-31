<x-app-layout>
    <x-slot name="header">
        <h2>Categories</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-blue-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Total Kategori</h5>
        <h3 class="text-3xl font-bold">{{ $totalCategories }}</h3>
    </div>

    <div class="bg-green-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Kategori Terbanyak Produk</h5>
        <h3 class="text-2xl font-bold">
            {{ $categoryWithMostProducts ? $categoryWithMostProducts->name : '-' }}
        </h3>
        <span class="text-sm">{{ $categoryWithMostProducts ? $categoryWithMostProducts->products_count : 0 }} produk</span>
    </div>

    <div class="bg-red-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
        <h5 class="text-lg font-semibold">Kategori Kosong</h5>
        <h3 class="text-3xl font-bold">{{ $emptyCategories }}</h3>
    </div>
</div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Category</a>

            @if(session('success'))
                <div class="bg-green-100 p-2 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="font-bold text-lg">{{ $category->name }}</h3>
                        <p class="text-gray-600">{{ $category->description }}</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('categories.edit', $category) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center">Belum ada category</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
