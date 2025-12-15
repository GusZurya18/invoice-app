@extends('layouts.master')

@section('title', 'Edit Kategori')

@section('page-title', 'Edit Kategori')

@section('content')
    <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 flex items-center justify-center py-8 px-2">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-8">

            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>

            {{-- Title --}}
            <h2 class="text-2xl font-bold text-blue-700 text-center mb-8">Edit Kategori</h2>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-600 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="categoryForm"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Kategori Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $category->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Enter Kategori Name">
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Produk
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none transition"
                        placeholder="Enter Kategori Description">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Hidden Status --}}
                <input type="hidden" name="status" value="{{ $category->status ?? 'active' }}">

                {{-- Buttons --}}
                <div class="flex flex-col space-y-3">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white py-3 px-6 rounded-xl font-semibold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Kategori
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
                        class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
