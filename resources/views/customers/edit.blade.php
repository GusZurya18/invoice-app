<x-app-layout>
    <x-slot name="header">
        <h2>Edit Customer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="w-full border px-3 py-2" value="{{ old('name', $customer->name) }}" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" class="w-full border px-3 py-2" value="{{ old('email', $customer->email) }}" required>
                    </div>

                    <div class="mb-4">
                        <label>Phone</label>
                        <input type="text" name="phone" class="w-full border px-3 py-2" value="{{ old('phone', $customer->phone) }}">
                    </div>

                    <div class="mb-4">
                        <label>Alamat</label>
                        <textarea name="address" class="w-full border px-3 py-2">{{ old('address', $customer->address) }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
