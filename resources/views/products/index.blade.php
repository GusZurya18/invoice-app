@extends('layouts.master')

@section('title', 'Products')

@section('page-title', 'Products')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.3); }
        50% { opacity: 0.9; transform: scale(1.05); }
        80% { opacity: 1; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
    .slide-up { animation: slideUp 0.6s ease-out forwards; }
    .bounce-in { animation: bounceIn 0.8s ease-out forwards; }
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .glass-effect {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .pulse-ring { animation: pulse-ring 1.25s cubic-bezier(0.215, 0.61, 0.355, 1) infinite; }
    @keyframes pulse-ring {
        0% { transform: scale(0.33); }
        80%, 100% { opacity: 0; }
    }
    .modal { backdrop-filter: blur(8px); background-color: rgba(0, 0, 0, 0.5); }
    .delete-modal { backdrop-filter: blur(10px); background-color: rgba(0, 0, 0, 0.6); }
    .modal-content { animation: modalSlideIn 0.3s ease-out; }
    @keyframes modalSlideIn {
        from { opacity: 0; transform: translateY(-50px) scale(0.9); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .success-modal { animation: successPulse 0.5s ease-out; }
    @keyframes successPulse {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.05); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Fix z-index for sidebar clickability */
    .product-content-wrapper {
        position: relative;
        z-index: 1;
    }
    
    #deleteModal, #successModal {
        z-index: 9999 !important;
    }
    
    #toast {
        z-index: 9998 !important;
    }
</style>

<div class="product-content-wrapper min-h-screen p-3 sm:p-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4 sm:mb-6 flex-wrap gap-3">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <button onclick="goBack()" class="w-10 h-10 sm:w-12 sm:h-12 glass-effect rounded-full flex items-center justify-center text-white hover:bg-white hover:bg-opacity-20 transition-all duration-300 hover:scale-110 group flex-shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <h1 class="text-xl sm:text-3xl font-bold text-white slide-up">Products</h1>
        </div>
        
        <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto order-3 sm:order-2">
            <div class="relative flex-1 sm:flex-initial">
                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="searchInput" class="w-full sm:w-80 pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 bg-white rounded-full border-0 focus:ring-2 focus:ring-white focus:ring-opacity-30 text-gray-900 placeholder-gray-500 text-sm sm:text-base" placeholder="Cari products...">
            </div>
            
            
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover-lift group slide-up">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sm:space-x-4 w-full">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-blue-400 to-blue-500 rounded-lg sm:rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg flex-shrink-0">
                        <span class="text-2xl sm:text-3xl">📦</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-2xl sm:text-4xl font-bold text-indigo-600 counter" data-count="{{ $totalProducts }}">{{ $totalProducts }}</div>
                        <div class="text-gray-600 font-semibold text-sm sm:text-lg">Total Products</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm text-green-600">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Total in database</span>
            </div>
        </div>
        
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover-lift group slide-up" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sm:space-x-4 w-full">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-green-400 to-green-500 rounded-lg sm:rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg flex-shrink-0">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-2xl sm:text-4xl font-bold text-indigo-600 counter" data-count="{{ $availableProducts }}">{{ $availableProducts }}</div>
                        <div class="text-gray-600 font-semibold text-sm sm:text-lg">Available Products</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm text-green-600">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Products in stock</span>
            </div>
        </div>
        
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover-lift group slide-up" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sm:space-x-4 w-full">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg sm:rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg flex-shrink-0">
                        <span class="text-2xl sm:text-3xl">⚠️</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-2xl sm:text-4xl font-bold text-indigo-600 counter" data-count="{{ $lowStock }}">{{ $lowStock }}</div>
                        <div class="text-gray-600 font-semibold text-sm sm:text-lg">Low Stock (<5)</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm text-yellow-600">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Needs restock</span>
            </div>
        </div>
        
        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover-lift group slide-up" style="animation-delay: 0.3s;">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sm:space-x-4 w-full">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-red-400 to-red-500 rounded-lg sm:rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg flex-shrink-0">
                        <span class="text-2xl sm:text-3xl">❌</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-2xl sm:text-4xl font-bold text-indigo-600 counter" data-count="{{ $outOfStock }}">{{ $outOfStock }}</div>
                        <div class="text-gray-600 font-semibold text-sm sm:text-lg">Out of Stock</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm text-red-600">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Unavailable</span>
            </div>
        </div>
    </div>
    
    @if(session('success'))
        <div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-3 sm:px-4 py-2 sm:py-3 rounded mb-3 sm:mb-4 slide-up text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Main Content Area -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-2xl min-h-96 slide-up" style="animation-delay: 0.2s;">
        <div class="p-4 sm:p-6 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4">
                <a href="{{ route('products.create') }}" class="w-full sm:w-auto">
                    <button class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 group text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add New Product</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </a>
                
                <div class="flex space-x-2 sm:space-x-4">
                    <!-- Category Filter -->
                    <div class="relative flex-1 sm:flex-initial">
                        <button onclick="toggleCategoryFilter()" class="w-full sm:w-auto flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 px-3 sm:px-4 py-2 rounded-lg hover:bg-gray-100 transition-all duration-200 border border-gray-200 text-sm sm:text-base" id="categoryFilterButton">
                            <span>Category</span>
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 transition-transform duration-200" id="categoryFilterIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="categoryFilterDropdown" class="absolute right-0 mt-2 w-48 sm:w-56 bg-white rounded-lg shadow-lg border z-10 opacity-0 pointer-events-none transform scale-95 transition-all duration-200 max-h-60 overflow-y-auto">
                            <div class="py-2">
                                <a href="#" onclick="filterByCategory('all', 'All Categories'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150 font-medium">
                                    <span class="mr-2">🏷️</span>All Categories
                                </a>
                                @php
                                    $uniqueCategories = $products->pluck('category')->whereNotNull()->unique('id');
                                @endphp
                                @if($uniqueCategories->count() > 0)
                                    @foreach($uniqueCategories as $category)
                                        <a href="#" onclick="filterByCategory('{{ $category->id }}', '{{ $category->name }}'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                            <span class="mr-2">📁</span>{{ $category->name }}
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-2 text-sm text-gray-500 italic">No categories available</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stock Filter -->
                    <div class="relative flex-1 sm:flex-initial">
                        <button onclick="toggleFilter()" class="w-full sm:w-auto flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 px-3 sm:px-4 py-2 rounded-lg hover:bg-gray-100 transition-all duration-200 border border-gray-200 text-sm sm:text-base" id="filterButton">
                            <span>Stock</span>
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 transition-transform duration-200" id="filterIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="filterDropdown" class="absolute right-0 mt-2 w-40 sm:w-48 bg-white rounded-lg shadow-lg border z-10 opacity-0 pointer-events-none transform scale-95 transition-all duration-200">
                            <div class="py-2">
                                <a href="#" onclick="filterProducts('all'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">All Products</a>
                                <a href="#" onclick="filterProducts('instock'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">In Stock</a>
                                <a href="#" onclick="filterProducts('lowstock'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">Low Stock</a>
                                <a href="#" onclick="filterProducts('outofstock'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">Out of Stock</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products List -->
        <div id="productsContainer" class="p-3 sm:p-6">
            @if($products->count() > 0)
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($products as $product)
                        <div class="product-card bg-white border border-gray-200 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 overflow-hidden"
                             data-stock="{{ $product->stock }}"
                             data-name="{{ strtolower($product->name) }}"
                             data-category="{{ strtolower($product->category->name ?? '') }}"
                             data-category-id="{{ $product->category_id ?? '' }}">
                           
                            <!-- Product Image -->
                            <div class="h-40 sm:h-48 overflow-hidden bg-gray-50">
                                @if($product->photo)
                                    @php
                                        $photoPath = str_replace('\\', '/', $product->photo);
                                        $fullPath = storage_path('app/public/' . $photoPath);
                                        $fileExists = file_exists($fullPath);
                                    @endphp
                                    
                                    @if($fileExists)
                                        <img src="{{ asset('storage/' . $photoPath) }}" 
                                             class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" 
                                             alt="{{ $product->name }}"
                                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center\'><span class=\'text-5xl sm:text-6xl\'>📦</span></div>';">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                            <div class="text-center p-2">
                                                <span class="text-3xl sm:text-4xl">📦</span>
                                                <p class="text-xs text-gray-600 mt-2">Image not found</p>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <span class="text-5xl sm:text-6xl">📦</span>
                                    </div>
                                @endif
                            </div>
                           
                            <!-- Product Info -->
                            <div class="p-4 sm:p-6">
                                <h3 class="font-bold text-lg sm:text-xl text-gray-800 mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                               
                                <div class="space-y-2 mb-4">
                                    <p class="text-xs sm:text-sm"><strong class="text-gray-700">Category:</strong>
                                        <span class="text-indigo-600">{{ $product->category->name ?? '-' }}</span>
                                    </p>
                                    <p class="text-base sm:text-lg font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs sm:text-sm"><strong class="text-gray-700">Stock:</strong>
                                            <span class="font-semibold">{{ $product->stock }}</span>
                                        </p>
                                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium {{
                                            $product->stock > 10 ? 'bg-green-100 text-green-800' :
                                            ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')
                                        }}">
                                            {{ $product->stock > 10 ? 'In Stock' : ($product->stock > 0 ? 'Low Stock' : 'Out of Stock') }}
                                        </span>
                                    </div>
                                </div>
                               
                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-3 sm:px-4 rounded-lg transition-all duration-200 hover:shadow-lg font-medium text-sm sm:text-base">
                                        Edit
                                    </a>
                                    <button onclick="showDeleteModal('{{ $product->id }}', '{{ $product->name }}')" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-3 sm:px-4 rounded-lg transition-all duration-200 hover:shadow-lg font-medium text-sm sm:text-base">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6 sm:mt-8 flex justify-center">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @else
                <div id="emptyState" class="flex flex-col items-center justify-center py-12 sm:py-20 px-4 sm:px-6">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center mb-6 sm:mb-8 bounce-in shadow-2xl">
                        <span class="text-5xl sm:text-6xl">📦</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-indigo-600 mb-3 sm:mb-4 slide-up text-center" style="animation-delay: 0.3s;">No Products Available</h3>
                    <p class="text-gray-500 mb-6 sm:mb-8 text-center max-w-md slide-up text-sm sm:text-base px-4" style="animation-delay: 0.4s;">Get started by creating your first product. You can add details like name, price, and stock quantity.</p>
                    <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-sm sm:text-base">
                        Create Your First Product
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 delete-modal z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="modal-content bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Delete Product</h3>
                <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">
                    Are you sure you want to delete "<span id="productNameToDelete" class="font-semibold text-gray-800"></span>"?
                    <br><br>
                    <span class="text-xs sm:text-sm text-red-600">This action cannot be undone and will permanently remove all product data.</span>
                </p>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <button onclick="hideDeleteModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 font-medium text-sm sm:text-base">
                        Cancel
                    </button>
                    <button onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium text-sm sm:text-base">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Delete Modal -->
<div id="successModal" class="fixed inset-0 delete-modal z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="success-modal bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Successfully Deleted!</h3>
                <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">
                    The product "<span id="deletedProductName" class="font-semibold text-gray-800"></span>" has been successfully removed from your inventory.
                </p>
                <button onclick="hideSuccessModal()" class="px-5 sm:px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium text-sm sm:text-base">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transform translate-x-full transition-all duration-300 z-50 text-sm sm:text-base">
    <div class="flex items-center space-x-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span id="toastMessage">Success!</span>
    </div>
</div>

<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}'
    };
    
    let productToDeleteId = null;
    let productToDeleteName = null;

    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        let current = 0;
        const increment = target / 60;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 30);
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                animateCounter(counter);
            });
        }, 800);

        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 300);
            }, 5000);
        }
    });

    function showDeleteModal(productId, productName) {
        productToDeleteId = productId;
        productToDeleteName = productName;
        document.getElementById('productNameToDelete').textContent = productName;
        document.getElementById('deleteModal').classList.remove('hidden');
        lockScroll();
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        productToDeleteId = null;
        productToDeleteName = null;
        unlockScroll();
    }

    function confirmDelete() {
        if (productToDeleteId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/products/${productToDeleteId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = window.Laravel.csrfToken;
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            
            hideDeleteModal();
            document.getElementById('deletedProductName').textContent = productToDeleteName;
            document.getElementById('successModal').classList.remove('hidden');
            lockScroll();
            
            setTimeout(() => {
                form.submit();
            }, 2000);
        }
    }

    function hideSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
        unlockScroll();
    }

    function toggleCategoryFilter() {
        const dropdown = document.getElementById('categoryFilterDropdown');
        const icon = document.getElementById('categoryFilterIcon');
        
        if (dropdown.classList.contains('opacity-0')) {
            dropdown.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
            dropdown.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
            icon.style.transform = 'rotate(180deg)';
        } else {
            dropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
            dropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    function filterByCategory(categoryId, categoryName = '') {
        const cards = document.querySelectorAll('.product-card');
        const productsGrid = document.getElementById('productsGrid');
        const emptyState = document.getElementById('emptyState');
        let visibleCards = 0;
        
        cards.forEach(card => {
            const productCategoryId = card.dataset.categoryId;
            let show = false;
            
            if (categoryId === 'all') {
                show = true;
            } else {
                show = productCategoryId === categoryId.toString();
            }
            
            if (show) {
                card.style.display = 'block';
                card.style.animation = 'slideUp 0.5s ease-out';
                visibleCards++;
            } else {
                card.style.display = 'none';
            }
        });
        
        const searchEmptyState = document.getElementById('searchEmptyState');
        if (searchEmptyState) searchEmptyState.style.display = 'none';
        
        if (visibleCards === 0 && categoryId !== 'all') {
            if (productsGrid) productsGrid.style.display = 'none';
            if (emptyState) emptyState.style.display = 'none';
            
            let categoryEmptyState = document.getElementById('categoryEmptyState');
            if (!categoryEmptyState) {
                categoryEmptyState = document.createElement('div');
                categoryEmptyState.id = 'categoryEmptyState';
                document.getElementById('productsContainer').appendChild(categoryEmptyState);
            }
            
            const displayCategoryName = categoryName || 'Selected Category';
            categoryEmptyState.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12 sm:py-20 px-4 sm:px-6 slide-up">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mb-6 sm:mb-8 bounce-in shadow-2xl">
                        <span class="text-5xl sm:text-6xl">📂</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-indigo-600 mb-3 sm:mb-4 text-center">No Products in "${displayCategoryName}" Category</h3>
                    <p class="text-gray-500 mb-6 sm:mb-8 text-center max-w-md text-sm sm:text-base">
                        This category doesn't have any products yet.
                        Create a new product or browse other categories.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
                        <button onclick="showAllProducts()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-sm sm:text-base">
                            Show All Products
                        </button>
                        <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-center text-sm sm:text-base">
                            Create Product
                        </a>
                    </div>
                </div>
            `;
            categoryEmptyState.style.display = 'block';
        } else {
            const categoryEmptyState = document.getElementById('categoryEmptyState');
            if (categoryEmptyState) {
                categoryEmptyState.style.display = 'none';
            }
            
            if (visibleCards > 0) {
                if (productsGrid) productsGrid.style.display = 'grid';
                if (emptyState) emptyState.style.display = 'none';
            } else if (categoryId === 'all') {
                @if($products->count() > 0)
                    if (productsGrid) productsGrid.style.display = 'grid';
                    if (emptyState) emptyState.style.display = 'none';
                @else
                    if (productsGrid) productsGrid.style.display = 'none';
                    if (emptyState) emptyState.style.display = 'flex';
                @endif
            }
        }
        
        toggleCategoryFilter();
        const displayName = categoryId === 'all' ? 'all categories' : `"${categoryName || 'Selected Category'}" category`;
        showToast(`Showing products from ${displayName}`, 'info');
    }

    function toggleFilter() {
        const dropdown = document.getElementById('filterDropdown');
        const icon = document.getElementById('filterIcon');
        
        if (dropdown.classList.contains('opacity-0')) {
            dropdown.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
            dropdown.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
            icon.style.transform = 'rotate(180deg)';
        } else {
            dropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
            dropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    function filterProducts(category) {
        const cards = document.querySelectorAll('.product-card');
        const productsGrid = document.getElementById('productsGrid');
        const emptyState = document.getElementById('emptyState');
        let visibleCards = 0;

        cards.forEach(card => {
            const stock = parseInt(card.dataset.stock);
            let show = false;

            switch(category) {
                case 'all':
                    show = true;
                    break;
                case 'instock':
                    show = stock > 10;
                    break;
                case 'lowstock':
                    show = stock > 0 && stock <= 10;
                    break;
                case 'outofstock':
                    show = stock === 0;
                    break;
            }

            if (show) {
                card.style.display = 'block';
                card.style.animation = 'slideUp 0.5s ease-out';
                visibleCards++;
            } else {
                card.style.display = 'none';
            }
        });

        const searchEmptyState = document.getElementById('searchEmptyState');
        const categoryEmptyState = document.getElementById('categoryEmptyState');
        if (searchEmptyState) searchEmptyState.style.display = 'none';
        if (categoryEmptyState) categoryEmptyState.style.display = 'none';

        if (visibleCards === 0 && category !== 'all') {
            if (productsGrid) productsGrid.style.display = 'none';
            if (emptyState) emptyState.style.display = 'none';

            let stockEmptyState = document.getElementById('stockEmptyState');
            if (!stockEmptyState) {
                stockEmptyState = document.createElement('div');
                stockEmptyState.id = 'stockEmptyState';
                document.getElementById('productsContainer').appendChild(stockEmptyState);
            }

            const categoryDisplayNames = {
                'instock': 'In Stock',
                'lowstock': 'Low Stock',
                'outofstock': 'Out of Stock'
            };
            const displayCategoryName = categoryDisplayNames[category] || 'Selected Stock Status';

            stockEmptyState.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12 sm:py-20 px-4 sm:px-6 slide-up">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center mb-6 sm:mb-8 bounce-in shadow-2xl">
                        <span class="text-5xl sm:text-6xl">📊</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-indigo-600 mb-3 sm:mb-4 text-center">No Products with "${displayCategoryName}" Status</h3>
                    <p class="text-gray-500 mb-6 sm:mb-8 text-center max-w-md text-sm sm:text-base">
                        No products match the selected stock status.
                        Try a different filter or add new products.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
                        <button onclick="showAllProducts()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-sm sm:text-base">
                            Show All Products
                        </button>
                        <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-center text-sm sm:text-base">
                            Create Product
                        </a>
                    </div>
                </div>
            `;
            stockEmptyState.style.display = 'block';
        } else {
            const stockEmptyState = document.getElementById('stockEmptyState');
            if (stockEmptyState) {
                stockEmptyState.style.display = 'none';
            }

            if (visibleCards > 0) {
                if (productsGrid) productsGrid.style.display = 'grid';
                if (emptyState) emptyState.style.display = 'none';
            } else if (category === 'all') {
                @if($products->count() > 0)
                    if (productsGrid) productsGrid.style.display = 'grid';
                    if (emptyState) emptyState.style.display = 'none';
                @else
                    if (productsGrid) productsGrid.style.display = 'none';
                    if (emptyState) emptyState.style.display = 'flex';
                @endif
            }
        }

        toggleFilter();
        const categoryDisplayName = category === 'all' ? 'all categories' : `"${category.charAt(0).toUpperCase() + category.slice(1)}" category`;
        showToast(`Showing products from ${categoryDisplayName}`, 'info');
    }

    function showAllProducts() {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach(card => {
            card.style.display = 'block';
            card.style.animation = 'slideUp 0.5s ease-out';
        });

        const emptyStates = ['searchEmptyState', 'categoryEmptyState', 'stockEmptyState'];
        emptyStates.forEach(stateId => {
            const element = document.getElementById(stateId);
            if (element) element.style.display = 'none';
        });

        const productsGrid = document.getElementById('productsGrid');
        const emptyState = document.getElementById('emptyState');
        
        @if($products->count() > 0)
            if (productsGrid) productsGrid.style.display = 'grid';
            if (emptyState) emptyState.style.display = 'none';
        @else
            if (productsGrid) productsGrid.style.display = 'none';
            if (emptyState) emptyState.style.display = 'flex';
        @endif
        
        showToast('Showing all products', 'info');
    }

    document.getElementById('searchInput').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        const productsGrid = document.getElementById('productsGrid');
        const emptyState = document.getElementById('emptyState');
        let visibleCards = 0;
        
        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;
            
            if (name.includes(query) || category.includes(query) || query === '') {
                card.style.display = 'block';
                card.style.animation = 'slideUp 0.5s ease-out';
                visibleCards++;
            } else {
                card.style.display = 'none';
            }
        });
        
        if (visibleCards === 0 && query.trim() !== '') {
            if (productsGrid) productsGrid.style.display = 'none';
            if (emptyState) emptyState.style.display = 'none';
            
            const categoryEmptyState = document.getElementById('categoryEmptyState');
            const stockEmptyState = document.getElementById('stockEmptyState');
            if (categoryEmptyState) categoryEmptyState.style.display = 'none';
            if (stockEmptyState) stockEmptyState.style.display = 'none';
            
            let searchEmptyState = document.getElementById('searchEmptyState');
            if (!searchEmptyState) {
                searchEmptyState = document.createElement('div');
                searchEmptyState.id = 'searchEmptyState';
                document.getElementById('productsContainer').appendChild(searchEmptyState);
            }
            
            searchEmptyState.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12 sm:py-20 px-4 sm:px-6 slide-up">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center mb-6 sm:mb-8 bounce-in shadow-2xl">
                        <span class="text-5xl sm:text-6xl">🔍</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-indigo-600 mb-3 sm:mb-4 text-center">No Products Found</h3>
                    <p class="text-gray-500 mb-6 sm:mb-8 text-center max-w-md text-sm sm:text-base px-4">
                        We couldn't find any products matching "<strong>${query}</strong>".
                        Try adjusting your search terms or create a new product.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 w-full sm:w-auto px-4 sm:px-0">
                        <button onclick="clearSearch()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-sm sm:text-base">
                            Clear Search
                        </button>
                        <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-center text-sm sm:text-base">
                            Create Product
                        </a>
                    </div>
                </div>
            `;
            searchEmptyState.style.display = 'block';
        } else {
            const searchEmptyState = document.getElementById('searchEmptyState');
            if (searchEmptyState) {
                searchEmptyState.style.display = 'none';
            }
            
            if (visibleCards > 0) {
                if (productsGrid) productsGrid.style.display = 'grid';
                if (emptyState) emptyState.style.display = 'none';
            } else if (query.trim() === '') {
                @if($products->count() > 0)
                    if (productsGrid) productsGrid.style.display = 'grid';
                    if (emptyState) emptyState.style.display = 'none';
                @else
                    if (productsGrid) productsGrid.style.display = 'none';
                    if (emptyState) emptyState.style.display = 'flex';
                @endif
            }
        }
    });

    function clearSearch() {
        const searchInput = document.getElementById('searchInput');
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
        showToast('Search cleared', 'info');
    }

    document.addEventListener('click', function(e) {
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');
        const categoryFilterButton = document.getElementById('categoryFilterButton');
        const categoryFilterDropdown = document.getElementById('categoryFilterDropdown');
        
        if (!filterButton.contains(e.target) && !filterDropdown.contains(e.target)) {
            filterDropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
            filterDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
            document.getElementById('filterIcon').style.transform = 'rotate(0deg)';
        }
        if (!categoryFilterButton.contains(e.target) && !categoryFilterDropdown.contains(e.target)) {
            categoryFilterDropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
            categoryFilterDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
            document.getElementById('categoryFilterIcon').style.transform = 'rotate(0deg)';
        }
    });

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        
        toastMessage.textContent = message;
        
        toast.className = 'fixed top-4 right-4 px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transform translate-x-0 transition-all duration-300 z-50 text-sm sm:text-base';
        
        if (type === 'success') {
            toast.className += ' bg-green-500 text-white';
        } else if (type === 'error') {
            toast.className += ' bg-red-500 text-white';
        } else if (type === 'info') {
            toast.className += ' bg-blue-500 text-white';
        }
        
        setTimeout(() => {
            toast.style.transform = 'translateX(120%)';
        }, 3000);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 3500);
    }

    function showNotification() {
        showToast('You have 3 new notifications!', 'info');
    }

    function goBack() {
        window.history.back();
    }

    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            hideDeleteModal();
        }
    });

    document.getElementById('successModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            hideSuccessModal();
        }
    });

    function lockScroll() {
        document.body.style.overflow = 'hidden';
    }

    function unlockScroll() {
        document.body.style.overflow = '';
    }
</script>
@endsection