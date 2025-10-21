@extends('layouts.master')

@section('title', 'Category Management')

@section('page-title', 'Category Management')

@section('content')

{{-- Top Bar --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-4 px-4 sm:px-0">
    <!-- Left Title -->
    <h2 class="text-2xl sm:text-4xl font-bold text-indigo-600">Category</h2>

    <!-- Right Search & Notification -->
    <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto">
        <!-- Search -->
        <div class="relative flex-1 sm:flex-initial">
            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input 
                type="text" 
                id="searchInput"
                placeholder="Search category..."
                class="w-full sm:w-80 pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 bg-white rounded-full border-0 
                       focus:ring-2 focus:ring-indigo-300 
                       text-gray-900 placeholder-gray-500 shadow-sm text-sm sm:text-base"
            >
        </div>

        <!-- Notification -->
        
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8 px-4 sm:px-0">
    <!-- Total Categories Card -->
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-4 sm:p-6 border-2 border-indigo-100 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="bg-indigo-100 rounded-full p-1.5 sm:p-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-indigo-600 mb-1">{{ $totalCategories }}</h3>
                <h5 class="text-sm sm:text-base font-semibold text-indigo-600">Total Categories</h5>
            </div>
        </div>
    </div>

    <!-- Most Products Category Card -->
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-4 sm:p-6 border-2 border-indigo-100 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-2">
                    <div class="bg-green-100 rounded-full p-1.5 sm:p-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-indigo-600 mb-1">{{ $categoryWithMostProducts ? $categoryWithMostProducts->products_count : 0 }}</h3>
                <h5 class="text-sm sm:text-base font-semibold text-indigo-600 truncate">
                    {{ $categoryWithMostProducts ? $categoryWithMostProducts->name : 'Top Category' }}
                </h5>
            </div>
        </div>
    </div>

    <!-- Empty Categories Card -->
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-4 sm:p-6 border-2 border-indigo-100 hover:shadow-xl transition-all duration-300 sm:col-span-2 lg:col-span-1">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="bg-red-100 rounded-full p-1.5 sm:p-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-indigo-600 mb-1">{{ $emptyCategories }}</h3>
                <h5 class="text-sm sm:text-base font-semibold text-indigo-600">Empty Categories</h5>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 sm:p-4 rounded-lg mb-4 sm:mb-6 animate-fade-in mx-4 sm:mx-0">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-medium text-sm sm:text-base">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Main Content Card -->
<div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg overflow-hidden border-2 border-gray-100 mx-4 sm:mx-0">
    <!-- Header Section -->
    <div class="bg-white px-4 sm:px-8 py-4 sm:py-6 border-b-2 border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Category List</h1>
            </div>
            
            <!-- Add Category Button -->
            <a href="{{ route('categories.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-full font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 whitespace-nowrap text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Category
            </a>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-4 sm:p-8">
        <!-- Empty State -->
        <div id="emptyState" class="text-center py-12 sm:py-20 {{ count($categories) > 0 ? 'hidden' : '' }}">
            <div class="max-w-lg mx-auto">
                <div class="bg-indigo-100 rounded-full w-24 h-24 sm:w-32 sm:h-32 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">No Categories Yet</h3>
                <p class="text-gray-600 mb-6 sm:mb-8 text-base sm:text-lg px-4">
                    Start by adding your first category to organize your products
                </p>
                <a href="{{ route('categories.create') }}"
                   class="bg-indigo-600 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-full font-semibold hover:bg-indigo-700 transform hover:scale-105 transition-all duration-300 inline-flex items-center gap-2 shadow-lg text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add First Category
                </a>
            </div>
        </div>

        <!-- No Search Results -->
        <div id="noResults" class="text-center py-12 sm:py-20 hidden">
            <div class="max-w-md mx-auto">
                <div class="bg-gray-100 rounded-full w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-2">Category Not Found</h3>
                <p class="text-sm sm:text-base text-gray-500">Try using different keywords</p>
            </div>
        </div>

        <!-- Categories Content -->
        <div id="tableContainer" class="overflow-hidden {{ count($categories) === 0 ? 'hidden' : '' }}">
            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-3 sm:space-y-4" id="mobileCards">
                @forelse($categories as $index => $category)
                    <div class="category-item bg-white rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-gray-100 hover:border-indigo-200 hover:shadow-md transition-all duration-300"
                         data-name="{{ strtolower($category->name) }}"
                         data-description="{{ strtolower($category->description) }}"
                         data-status="{{ strtolower($category->status) }}">
                        <div class="flex items-start justify-between mb-3 gap-3">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-1 break-words">{{ $category->name }}</h3>
                                <span class="inline-flex px-2.5 sm:px-3 py-1 rounded-full text-xs font-bold {{ $category->status == 'active' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ ucfirst($category->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $category->description ?: 'No description' }}</p>
                        
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-sm font-medium text-gray-500">
                                <span class="font-bold text-indigo-600">{{ $category->products_count }}</span> products
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this category?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        <span class="hidden sm:inline">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Address</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total Order</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tableBody">
                        @forelse($categories as $index => $category)
                            <tr class="category-item hover:bg-gray-50 transition-all duration-200"
                                data-name="{{ strtolower($category->name) }}"
                                data-description="{{ strtolower($category->description) }}"
                                data-status="{{ strtolower($category->status) }}">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">-</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">-</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs truncate">{{ $category->description ?: 'No description' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $category->status == 'active' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $category->products_count }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this category?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

/* Search highlight effect */
.search-highlight {
    background-color: #fef3c7;
    padding: 2px 4px;
    border-radius: 4px;
}

/* Line clamp utility for mobile */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryItems = document.querySelectorAll('.category-item');
    const emptyState = document.getElementById('emptyState');
    const noResults = document.getElementById('noResults');
    const tableContainer = document.getElementById('tableContainer');
    
    // Initialize visibility
    updateVisibility();
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;
        
        // Clear previous highlights
        clearHighlights();
        
        categoryItems.forEach(function(item) {
            const name = item.getAttribute('data-name');
            const description = item.getAttribute('data-description') || '';
            const status = item.getAttribute('data-status');
            
            const isMatch = name.includes(searchTerm) ||
                          description.includes(searchTerm) ||
                          status.includes(searchTerm);
            
            if (isMatch) {
                item.style.display = '';
                visibleCount++;
                
                // Highlight matching text
                if (searchTerm) {
                    highlightText(item, searchTerm);
                }
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update visibility based on search results
        if (searchTerm === '') {
            updateVisibility();
        } else {
            emptyState.classList.add('hidden');
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
                tableContainer.classList.add('hidden');
            } else {
                noResults.classList.add('hidden');
                tableContainer.classList.remove('hidden');
            }
        }
    });
    
    function updateVisibility() {
        const hasCategories = categoryItems.length > 0;
        
        if (hasCategories) {
            emptyState.classList.add('hidden');
            tableContainer.classList.remove('hidden');
            noResults.classList.add('hidden');
        } else {
            emptyState.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            noResults.classList.add('hidden');
        }
    }
    
    function highlightText(element, searchTerm) {
        const textNodes = getTextNodes(element);
        
        textNodes.forEach(function(node) {
            const text = node.textContent;
            const regex = new RegExp(`(${escapeRegex(searchTerm)})`, 'gi');
            
            if (regex.test(text)) {
                const highlightedText = text.replace(regex, '<span class="search-highlight">$1</span>');
                const wrapper = document.createElement('span');
                wrapper.innerHTML = highlightedText;
                node.parentNode.replaceChild(wrapper, node);
            }
        });
    }
    
    function clearHighlights() {
        const highlights = document.querySelectorAll('.search-highlight');
        highlights.forEach(function(highlight) {
            const parent = highlight.parentNode;
            parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
            parent.normalize();
        });
    }
    
    function getTextNodes(element) {
        const textNodes = [];
        const walker = document.createTreeWalker(
            element,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function(node) {
                    if (node.parentNode.tagName === 'SCRIPT' ||
                        node.parentNode.tagName === 'STYLE') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );
        
        let node;
        while (node = walker.nextNode()) {
            if (node.textContent.trim()) {
                textNodes.push(node);
            }
        }
        
        return textNodes;
    }
    
    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    // Add smooth transitions
    categoryItems.forEach(function(item) {
        item.style.transition = 'all 0.3s ease';
    });
});
</script>

@endsection