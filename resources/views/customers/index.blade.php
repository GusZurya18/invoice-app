<x-app-layout>
    <x-slot name="header">
        <h2>Customer</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-indigo-500 text-white p-4 rounded-lg shadow">
        <h2 class="text-lg">Total Customer</h2>
        <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
    </div>
    <div class="bg-green-600 text-white p-4 rounded-lg shadow">
        <h2 class="text-lg">Aktif (punya invoice)</h2>
        <p class="text-2xl font-bold">{{ $activeCustomers }}</p>
    </div>
    <div class="bg-gray-500 text-white p-4 rounded-lg shadow">
        <h2 class="text-lg">Tidak Aktif</h2>
        <p class="text-2xl font-bold">{{ $inactiveCustomers }}</p>
    </div>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('customers.create') }}" class="btn btn-primary mb-4">Tambah Customer</a>

                @if(session('success'))
                    <div class="bg-green-100 p-2 rounded mb-4">{{ session('success') }}</div>
                @endif

                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Phone</th>
                            <th class="border px-4 py-2">Alamat</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="border px-4 py-2">{{ $customer->name }}</td>
                            <td class="border px-4 py-2">{{ $customer->email }}</td>
                            <td class="border px-4 py-2">{{ $customer->phone }}</td>
                            <td class="border px-4 py-2">{{ $customer->address }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('customers.edit', $customer) }}" class="text-blue-500">Edit</a> | 
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-center">Belum ada customer</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
