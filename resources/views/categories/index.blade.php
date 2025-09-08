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
            <span class="text-sm">
                {{ $categoryWithMostProducts ? $categoryWithMostProducts->products_count : 0 }} produk
            </span>
        </div>

        <div class="bg-red-500 text-white rounded-2xl shadow p-6 flex flex-col items-center">
            <h5 class="text-lg font-semibold">Kategori Kosong</h5>
            <h3 class="text-3xl font-bold">{{ $emptyCategories }}</h3>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('categories.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                Tambah Category
            </a>

            @if(session('success'))
                <div class="bg-green-100 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">No</th>
                            <th class="border px-4 py-2 text-left">Nama</th>
                            <th class="border px-4 py-2 text-left">Deskripsi</th>
                            <th class="border px-4 py-2 text-left">Total Produk</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $category->name }}</td>
                                <td class="border px-4 py-2 text-gray-600">{{ $category->description }}</td>
                                <td class="px-4 py-2 border">{{ $category->products_count }}</td>
                                <td class="px-4 py-2 border">
                                    <span class="px-2 py-1 rounded text-white {{ $category->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2 flex space-x-3">
                                    <a href="{{ route('categories.edit', $category) }}" 
                                       class="text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada category
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
