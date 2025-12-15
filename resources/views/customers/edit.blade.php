@extends('layouts.admin')

@section('title', 'Penglolaan Pelanggan')

@section('page-title', 'Penglolaan Pelanggan')

@push('styles')
    <style>
        .form-input {
            transition: all 0.3s ease;
            background: #ffffff;
            border: 2px solid #f3f4f6;
            color: #374151;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: #ffffff;
            border-color: #8b5cf6;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
        }

        .status-active {
            @apply bg-gradient-to-r from-green-400 to-green-500;
        }

        .status-inactive {
            @apply bg-gradient-to-r from-orange-400 to-orange-500;
        }

        .form-container {
            background: #ffffff;
            backdrop-filter: none;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .page-background {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .form-label {
            color: #374151;
            font-weight: 600;
        }

        .page-title {
            color: white;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }

        .error-text {
            color: #ef4444;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .required-asterisk {
            color: #ef4444;
        }

        .info-text {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-cancel {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            color: #64748b;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .btn-cancel:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .status-preview {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            padding: 0.75rem;
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(239, 68, 68, 0.4);
        }
    </style>
@endpush

@section('content')
    <div class="page-background py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="success-message mb-6 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="error-message mb-6 rounded-xl p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-medium mb-2">Mohon perbaiki kesalahan-kesalahan berikut:</h3>
                            <ul class="text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Form Container --}}
            <div class="bg-white form-container shadow-2xl rounded-3xl p-10 max-w-7xl mx-auto">
                <div class="mb-8">
                    <a href="{{ route('admin.customers.index') }}"
                        class="inline-flex items-center text-gray-600 hover:text-gray-200 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>

                <div class="text-center mb-8">
                    <h1 class="page-title text-3xl font-bold mb-2 text-blue-700">Edit Pelanggan</h1>
                    <p class="text-gray-500 text-sm">Perbarui informasi pelanggan</p>
                </div>

                <form action="{{ route('admin.customers.update', $customer) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6" id="customerForm">
                    @csrf
                    @method('PUT')

                    {{-- Pelanggan Name Field --}}
                    <div class="form-group">
                        <label for="name" class="form-label block text-sm mb-3">
                            Nama Pelanggan <span class="required-asterisk">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            class="form-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 outline-none transition-all duration-300"
                            placeholder="Masukkan Nama Pelanggan" value="{{ old('name', $customer->name) }}">
                        @error('name')
                            <p class="error-text text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pelanggan Email Field --}}
                    <div class="form-group">
                        <label for="email" class="form-label block text-sm mb-3">
                            Alamat Email <span class="required-asterisk">*</span>
                        </label>
                        <input type="email" id="email" name="email" required
                            class="form-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 outline-none transition-all duration-300"
                            placeholder="Masukkan Alamat Email" value="{{ old('email', $customer->email) }}">
                        @error('email')
                            <p class="error-text text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pelanggan Address Field --}}
                    <div class="form-group md:col-span-2"">
                        <label for="address" class="form-label block text-sm mb-3">
                            Alamat
                        </label>
                        <textarea id="address" name="address" rows="4"
                            class="form-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 outline-none resize-none transition-all duration-300"
                            placeholder="Masukkan Alamat Pelanggan">{{ old('address', $customer->address) }}</textarea>
                        @error('address')
                            <p class="error-text text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pelanggan Phone Field --}}
                    <div class="form-group">
                        <label for="phone" class="form-label block text-sm mb-3">
                            Nomor Handphone
                        </label>
                        <input type="text" id="phone" name="phone"
                            class="form-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 outline-none transition-all duration-300"
                            placeholder="Masukkan Nomor Handphone" value="{{ old('phone', $customer->phone) }}">
                        @error('phone')
                            <p class="error-text text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Field --}}
                    <div class="form-group">
                        <label for="status" class="form-label block text-sm mb-3">
                            Status <span class="required-asterisk">*</span>
                        </label>
                        <div class="relative">
                            <select id="status" name="status" required
                                class="form-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 outline-none appearance-none bg-white transition-all duration-300">
                                <option value="active"
                                    {{ old('status', $customer->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive"
                                    {{ old('status', $customer->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('status')
                            <p class="error-text text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Form Actions --}}
                    <div class="md:col-span-2 flex flex-col space-y-3">
                        <button type="submit"
                            class="btn-primary w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300">
                            Update Pelanggan
                        </button>
                        <a href="{{ route('admin.customers.index') }}"
                            class="inline-flex items-center text-gray-600 hover:text-black transition-colors duration-300">
                            <button type="button"
                                class="bg-gray-200 btn-cancel flex-1 py-3 px-40 rounded-xl font-semibold hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-300">
                                Cancel
                            </button>
                        </a>
                    </div>
                </form>

                {{-- Hidden Delete Form --}}
                <form id="deleteForm" action="{{ route('admin.customers.destroy', $customer) }}" method="POST"
                    class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Reset form function
        function resetForm() {
            if (confirm('Are you sure you want to reset all changes?')) {
                location.reload();
            }
        }

        // Delete confirmation
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this customer? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }

        // Auto focus on name field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('name').focus();
        });

        // Add loading state to submit button
        document.getElementById('customerForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML =
                '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Updating...';
            submitBtn.disabled = true;
        });

        // Form validation
        document.getElementById('customerForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!name || !email) {
                e.preventDefault();
                alert('Please fill in all required fields');
                return false;
            }
        });

        // Highlight changes
        const originalValues = {
            name: '{{ addslashes($customer->name) }}',
            email: '{{ addslashes($customer->email) }}',
            phone: '{{ addslashes($customer->phone ?? '') }}',
            address: '{{ addslashes($customer->address ?? '') }}',
            status: '{{ $customer->status }}'
        };

        function highlightChanges() {
            Object.keys(originalValues).forEach(field => {
                const element = document.getElementById(field);
                if (element && element.value !== originalValues[field]) {
                    element.classList.add('border-yellow-400');
                } else if (element) {
                    element.classList.remove('border-yellow-400');
                }
            });
        }

        // Add change detection
        ['name', 'email', 'phone', 'address', 'status'].forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.addEventListener('input', highlightChanges);
                element.addEventListener('change', highlightChanges);
            }
        });
    </script>
@endpush
