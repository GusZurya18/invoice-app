<x-app-layout>
    <x-slot name="header">
        <h2>Edit Category</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded-lg">

                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="w-full border px-3 py-2" value="{{ old('name', $category->name) }}" required>
                    </div>
                    <div class="mb-4">
                        <label>Deskripsi</label>
                        <textarea name="description" class="w-full border px-3 py-2">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-semibold">Status</label>
                        <select name="status" id="status" class="w-full border rounded p-2">
                            <option value="active" {{ old('status', $category->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $category->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
