<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Custom Navbar / Sidebar khusus Admin -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block py-2 {{ request()->routeIs('admin.dashboard') ? 'text-yellow-400' : '' }}">
                        Dashboard
                    </a>
                {{-- </li>
                <li>
                    <a href="{{ route('products.index') }}" 
                       class="block py-2 {{ request()->routeIs('products.*') ? 'text-yellow-400' : '' }}">
                        Kelola Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoices.index') }}" 
                       class="block py-2 {{ request()->routeIs('invoices.*') ? 'text-yellow-400' : '' }}">
                        Kelola Invoice
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" 
                       class="block py-2 {{ request()->routeIs('admin.users.*') ? 'text-yellow-400' : '' }}">
                        Kelola User
                    </a>
                </li>
            </ul> --}}
        </aside>

        <!-- Konten utama -->
        {{-- <main class="flex-1 p-6 bg-gray-100">
            {{ $slot }}
        </main> --}}
    </div>
</x-app-layout>
