{{-- resources/views/products/edit.blade.php --}}
@extends('layouts.master')

@section('title', 'Edit Product')

@section('page-title', 'Edit Product')

@section('content')

<div class="bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-purple-700 text-center mb-8">Edit Product</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-600 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Product Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" required
                       value="{{ old('name', $product->name) }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                       placeholder="Enter Product Name">
                @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Description
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none resize-none transition"
                          placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select id="category_id" name="category_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price and Stock in Grid --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Price --}}
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Unit Price <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="price" name="price" step="0.01" required
                           value="{{ old('price', $product->price) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                           placeholder="0.00">
                    @error('price')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stock --}}
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="stock" name="stock" required
                           value="{{ old('stock', $product->stock) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                           placeholder="0" min="0">
                    @error('stock')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Photo Upload --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Photo
                </label>
                <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-purple-500 transition">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-gray-600 mb-1">Drag & Drop photo here or click to select file</p>
                    <input type="file" name="photo" id="fileElem" accept="image/*" class="hidden">
                    @if($product->photo)
                        <img id="preview" src="{{ asset('storage/'.$product->photo) }}" class="mx-auto mt-4 max-h-48 rounded-lg">
                    @else
                        <img id="preview" class="mx-auto mt-4 max-h-48 rounded-lg hidden">
                    @endif
                </div>
                <p class="text-xs text-gray-500 mt-2">Optional: Upload new photo to replace existing one</p>
                @error('photo')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col space-y-3">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Update Product
                </button>
                <a href="{{ route('products.index') }}"
                   class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const preview = document.getElementById('preview');

// Klik untuk memilih file
dropArea.addEventListener('click', () => fileInput.click());

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Highlight drop area saat drag over
['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropArea.classList.add('bg-purple-50', 'border-purple-500');
}

function unhighlight(e) {
    dropArea.classList.remove('bg-purple-50', 'border-purple-500');
}

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        showPreview(files[0]);
    }
}

// Handle file input change
fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        showPreview(fileInput.files[0]);
    }
});

function showPreview(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
    }
    reader.readAsDataURL(file);
}
</script>

@endsection