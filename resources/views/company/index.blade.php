@extends('layouts.superadmin')

@section('title', 'Kelola Perusahaan')

@section('page-title', 'Kelola Perusahaan')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4">
                <h1 class="text-2xl sm:text-3xl font-bold text-white">Kelola Perusahaan</h1>
                <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto">
                    <!-- Search Box -->
                    <div class="relative flex-1 sm:flex-initial">
                        <input type="text" id="searchInput" placeholder="Search..."
                            class="w-full sm:w-80 px-4 py-2 sm:py-3 rounded-full bg-white border-0 focus:outline-none focus:ring-2 focus:ring-white/30 text-gray-700 placeholder-gray-400 text-sm sm:text-base">
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Notification Bell -->

                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Total Kelola Perusahaan -->
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1 sm:mb-2">{{ $totalCompany }}</div>
                    <div class="text-sm sm:text-base text-gray-600 font-medium">Total Kelola Perusahaan</div>
                </div>

                <!-- Active Kelola Perusahaan -->
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-green-600 mb-1 sm:mb-2">{{ $activeCompany }}</div>
                    <div class="text-sm sm:text-base text-gray-600 font-medium">Active Kelola Perusahaan</div>
                </div>

                <!-- Average Kelola Perusahaan Value -->
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1 sm:mb-2">
                        ${{ number_format($averageCustomerValue ?? 2450, 0) }}</div>
                    <div class="text-sm sm:text-base text-gray-600 font-medium">Avg. Kelola Perusahaan Value</div>
                </div>
            </div>

            <!-- Kelola Perusahaan Table Container -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">

                <!-- Table Header with Add Button -->
                <div class="p-4 sm:p-6 border-b border-gray-100">
                    <button onclick="window.location.href='{{ route('superadmin.company.create') }}'"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg sm:rounded-xl font-medium transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Kelola Perusahaan
                    </button>
                </div>

                @if (session('success'))
                    <div class="mx-4 sm:mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg sm:rounded-xl text-sm sm:text-base"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Container untuk table dan empty states -->
                <div id="companyTableContainer">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto" id="companyTable">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Kelola Perusahaan Name
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Email</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Phone</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Address</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Status</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100" id="companyTableBody">
                                @forelse($company as $index => $c)
                                    <tr class="hover:bg-gray-50 transition duration-150 company-row"
                                        data-name="{{ strtolower($c->company_name) }}"
                                        data-email="{{ strtolower($c->email) }}" data-phone="{{ $c->phone }}"
                                        data-address="{{ strtolower($c->address) }}"
                                        style="{{ $index >= 10 ? 'display: none;' : '' }}"
                                        data-page="{{ floor($index / 10) + 1 }}">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $c->company_name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ $c->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $c->phone }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate">{{ $c->address }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($c->aktif == 1)
                                                <span
                                                    class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">
                                                    Active
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gray-400 text-white">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('superadmin.company.edit', $c) }}"
                                                    class="w-8 h-8 bg-orange-500 hover:bg-orange-600 rounded-lg flex items-center justify-center transition-colors"
                                                    title="Edit Kelola Perusahaan">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                </a>
                                                <form action="{{ route('superadmin.company.destroy', $c) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Yakin ingin hapus company {{ $c->company_name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-8 h-8 text-white bg-red-500 hover:bg-red-600 rounded-lg flex items-center justify-center transition-colors"
                                                        title="Hapus Kelola Perusahaan">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty state ketika tidak ada company sama sekali -->
                                    <tr id="noCompanyRow">
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="text-6xl mb-4">👥</div>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelola
                                                    Perusahaan</h3>
                                                <p class="text-gray-500 mb-6">Mulai tambahkan company pertama Anda</p>
                                                <a href="{{ route('superadmin.company.create') }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition duration-200">
                                                    ➕ Tambah Kelola Perusahaan Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden" id="companyCards">
                        <div id="mobileCustomerList" class="divide-y divide-gray-100">
                            @forelse($company as $index => $c)
                                <div class="p-4 company-card hover:bg-gray-50 transition duration-150"
                                    data-name="{{ strtolower($c->company_name) }}"
                                    data-email="{{ strtolower($c->email) }}" data-phone="{{ $c->phone }}"
                                    data-address="{{ strtolower($c->address) }}"
                                    style="{{ $index >= 10 ? 'display: none;' : '' }}"
                                    data-page="{{ floor($index / 10) + 1 }}">

                                    <!-- Kelola Perusahaan Header -->
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 text-base mb-1">{{ $c->company_name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">{{ $c->email }}</p>
                                        </div>
                                        @if ($c->aktif == 1)
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-400 text-white">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Kelola Perusahaan Details -->
                                    <div class="space-y-2 mb-3">
                                        <div class="flex items-start text-sm">
                                            <span class="text-gray-500 w-20 flex-shrink-0">Phone:</span>
                                            <span class="text-gray-900 font-medium">{{ $c->phone }}</span>
                                        </div>
                                        <div class="flex items-start text-sm">
                                            <span class="text-gray-500 w-20 flex-shrink-0">Address:</span>
                                            <span class="text-gray-900">{{ $c->address }}</span>
                                        </div>
                                        <div class="flex items-start text-sm">
                                            <span class="text-gray-500 w-20 flex-shrink-0">Orders:</span>
                                            <span class="text-gray-900 font-medium">{{ $c->orders_count ?? 0 }}</span>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-2 pt-3 border-t border-gray-100">
                                        <a href="{{ route('superadmin.company.edit', $c) }}"
                                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm font-medium">
                                            <span>✏️</span>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('superadmin.company.destroy', $c) }}" method="POST"
                                            class="flex-1"
                                            onsubmit="return confirm('Yakin ingin hapus company {{ $c->company_name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm font-medium">
                                                <span>🗑️</span>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <!-- Mobile Empty State -->
                                <div id="noCompanyMobile" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">👥</div>
                                        <h3 class="text-base font-medium text-gray-900 mb-2">Belum Ada Kelola Perusahaan
                                        </h3>
                                        <p class="text-sm text-gray-500 mb-4">Mulai tambahkan company pertama Anda</p>
                                        <a href="{{ route('superadmin.company.create') }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg flex items-center gap-2 transition duration-200 text-sm">
                                            ➕ Tambah Kelola Perusahaan Pertama
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Search Not Found State -->
                    <div id="searchNotFound" class="hidden text-center py-12 sm:py-16 px-4">
                        <div class="flex flex-col items-center justify-center">
                            <div class="text-5xl sm:text-6xl mb-3 sm:mb-4">🔍</div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">Tidak Ditemukan</h3>
                            <p class="text-sm sm:text-base text-gray-500 mb-4">Kelola Perusahaan yang Anda cari tidak
                                ditemukan</p>
                            <button onclick="clearSearch()"
                                class="text-blue-500 hover:text-blue-700 font-medium text-sm sm:text-base">
                                🔄 Tampilkan Semua Kelola Perusahaan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($company->count() > 10)
                    <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 border-t border-gray-100" id="paginationContainer">
                        <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                            <button id="prevBtn"
                                class="px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                onclick="changePage('prev')" disabled>
                                Previous
                            </button>

                            <div id="pageNumbers" class="flex space-x-1">
                                <!-- Page numbers will be generated by JavaScript -->
                            </div>

                            <button id="nextBtn"
                                class="px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                onclick="changePage('next')">
                                Next
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const companyRows = document.querySelectorAll('.company-row');
            const companyCards = document.querySelectorAll('.company-card');
            const companyTable = document.getElementById('companyTable');
            const mobileCustomerList = document.getElementById('mobileCustomerList');
            const searchNotFound = document.getElementById('searchNotFound');
            const noCompanyRow = document.getElementById('noCompanyRow');
            const paginationContainer = document.getElementById('paginationContainer');

            let currentPage = 1;
            const itemsPerPage = 10;
            let filteredRows = Array.from(companyRows);
            let filteredCards = Array.from(companyCards);

            // Initialize pagination
            function initPagination() {
                if (companyRows.length <= itemsPerPage) {
                    if (paginationContainer) paginationContainer.style.display = 'none';
                    return;
                }

                updatePagination();
                showPage(1);
            }

            // Update pagination buttons and numbers
            function updatePagination() {
                const totalPages = Math.ceil(Math.max(filteredRows.length, filteredCards.length) / itemsPerPage);
                const pageNumbers = document.getElementById('pageNumbers');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                if (!pageNumbers || !prevBtn || !nextBtn) return;

                // Clear existing page numbers
                pageNumbers.innerHTML = '';

                // Generate page numbers
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.className =
                        `w-7 h-7 sm:w-8 sm:h-8 text-xs sm:text-sm rounded-lg ${i === currentPage ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-100'}`;
                    pageBtn.textContent = i;
                    pageBtn.onclick = () => showPage(i);
                    pageNumbers.appendChild(pageBtn);
                }

                // Update prev/next buttons
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                // Show/hide pagination
                if (totalPages <= 1) {
                    paginationContainer.style.display = 'none';
                } else {
                    paginationContainer.style.display = 'block';
                }
            }

            // Show specific page
            function showPage(page) {
                currentPage = page;
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                // Hide all rows and cards first
                filteredRows.forEach(row => {
                    row.style.display = 'none';
                });
                filteredCards.forEach(card => {
                    card.style.display = 'none';
                });

                // Show rows and cards for current page
                filteredRows.slice(startIndex, endIndex).forEach(row => {
                    row.style.display = '';
                });
                filteredCards.slice(startIndex, endIndex).forEach(card => {
                    card.style.display = '';
                });

                updatePagination();
            }

            // Change page function
            window.changePage = function(direction) {
                const totalPages = Math.ceil(Math.max(filteredRows.length, filteredCards.length) /
                itemsPerPage);

                if (direction === 'prev' && currentPage > 1) {
                    showPage(currentPage - 1);
                } else if (direction === 'next' && currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            };

            // Search function
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                // Reset filtered rows and cards
                if (searchTerm === '') {
                    filteredRows = Array.from(companyRows);
                    filteredCards = Array.from(companyCards);
                } else {
                    filteredRows = Array.from(companyRows).filter(row => {
                        const name = row.dataset.name || '';
                        const email = row.dataset.email || '';
                        const phone = row.dataset.phone || '';
                        const address = row.dataset.address || '';

                        return name.includes(searchTerm) ||
                            email.includes(searchTerm) ||
                            phone.includes(searchTerm) ||
                            address.includes(searchTerm);
                    });

                    filteredCards = Array.from(companyCards).filter(card => {
                        const name = card.dataset.name || '';
                        const email = card.dataset.email || '';
                        const phone = card.dataset.phone || '';
                        const address = card.dataset.address || '';

                        return name.includes(searchTerm) ||
                            email.includes(searchTerm) ||
                            phone.includes(searchTerm) ||
                            address.includes(searchTerm);
                    });
                }

                // Show results
                if (filteredRows.length === 0 && companyRows.length > 0) {
                    if (companyTable) companyTable.style.display = 'none';
                    if (mobileCustomerList) mobileCustomerList.style.display = 'none';
                    searchNotFound.style.display = 'block';
                    if (paginationContainer) paginationContainer.style.display = 'none';
                } else {
                    if (companyTable) companyTable.style.display = '';
                    if (mobileCustomerList) mobileCustomerList.style.display = '';
                    searchNotFound.style.display = 'none';
                    currentPage = 1;
                    showPage(1);
                }
            }

            // Clear search function
            window.clearSearch = function() {
                searchInput.value = '';
                filteredRows = Array.from(companyRows);
                filteredCards = Array.from(companyCards);
                if (companyTable) companyTable.style.display = '';
                if (mobileCustomerList) mobileCustomerList.style.display = '';
                searchNotFound.style.display = 'none';
                currentPage = 1;
                showPage(1);
                searchInput.focus();
            };

            // Event listeners
            searchInput.addEventListener('input', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performSearch();
                }
            });

            // Initialize
            initPagination();
        });
    </script>

@endsection
