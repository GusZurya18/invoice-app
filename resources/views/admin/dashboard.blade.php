<x-admin-layout>
    <h1 class="text-2xl font-bold">Selamat datang, {{ Auth::user()->name }}</h1>
    <p class="mt-4">Ini adalah dashboard admin.</p>
</x-admin-layout>


@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Selamat Datang, Admin!</h1>

    {{-- <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Total User</h2>
            <p>{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Total Produk</h2>
            <p>{{ \App\Models\Product::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Total Invoice</h2>
            <p>{{ \App\Models\Invoice::count() }}</p>
        </div>
    </div> --}}
@endsection
