{{-- resources/views/categories/edit.blade.php --}}
@extends('layouts.master')

@section('title', 'Edit Category')

@section('page-title', 'Edit Category')

@section('content')
<div class="bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-purple-700 text-center mb-8">Edit Category</h2>

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
        <form action="{{ route('categories.update', $category) }}" method="POST" id="categoryForm" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Category Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" required
                       value="{{ old('name', $category->name) }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                       placeholder="Enter Category Name">
                @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Description
                </label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none resize-none transition"
                          placeholder="Enter Category Description">{{ old('description', $category->description) }}</textarea>
                @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hidden Status --}}
            <input type="hidden" name="status" value="{{ $category->status ?? 'active' }}">

            {{-- Buttons --}}
            <div class="flex flex-col space-y-3">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Update Category
                </button>

                <a href="{{ route('categories.index') }}"
                   class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection