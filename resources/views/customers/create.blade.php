<x-app-layout>
    <x-slot name="header">
        <h2>Tambah Customer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="w-full border px-3 py-2" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" class="w-full border px-3 py-2" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label>Phone</label>
                        <input type="text" name="phone" class="w-full border px-3 py-2" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-4">
                        <label>Alamat</label>
                        <textarea name="address" class="w-full border px-3 py-2">{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label>Status</label>
                        <select name="status" class="w-full border p-2">
                            <option value="active" {{ old('status', $customer->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $customer->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
