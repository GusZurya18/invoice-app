<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white min-h-screen">
            <div class="p-4 font-bold text-xl">
                Admin Panel
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
                {{-- Belum buat page untuk kelola user --}}
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700">Kelola User</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

        @yield('scripts')
</body>
</html>
