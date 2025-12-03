@extends('layouts.admin')
@section('content')
    <!-- <div class="min-h-screen rounded-xl bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 py-4 md:py-8"> -->
        <div class="max-w-4xl mx-auto px-6">
            {{-- Header --}}
            <div class="bg-white rounded-lg shadow-sm p-8 mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2">Business Settings</h1>
                <p class="text-sm text-gray-500">Configure your business information and preferences</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-8">
                <form method="POST" action="{{ route('admin.company-settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Logo Upload Section --}}
                <div class="bg-gray-50 rounded-lg p-8 mb-6">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                            @if($company->logo)
                                <img src="{{ $company->logo_url }}" alt="Logo" class="w-20 h-20 rounded-full object-cover" id="logoPreview">
                            @else
                                <svg class="w-12 h-12 text-indigo-600" id="logoPlaceholder" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <img src="" alt="Logo" class="w-20 h-20 rounded-full object-cover hidden" id="logoPreview">
                            @endif
                        </div>
                        <h3 class="text-base font-medium text-gray-700 mb-1">Upload Your Logo</h3>
                        <p class="text-xs text-gray-500 mb-4">Company Business</p>
                        <label for="logoInput" class="cursor-pointer">
                            <span class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-6 rounded-lg inline-block transition">
                                Change Photo
                            </span>
                            <input type="file" id="logoInput" name="logo" accept="image/*" class="hidden">
                        </label>
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Company Information --}}
                <div class="bg-gray-50 rounded-lg p-8 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Company Information</h2>
                    
                    <div class="space-y-5">
                        {{-- Company Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                            <p class="text-xs text-gray-500 mb-2">Business name on Invoices</p>
                            <input type="text" name="company_name" value="{{ old('company_name', $company->company_name) }}" 
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                   placeholder="Pt Invoice Pro" required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email & Phone --}}
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Email</label>
                                <p class="text-xs text-gray-500 mb-2">Company email</p>
                                <input type="email" name="email" value="{{ old('email', $company->email) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="ptinvoicepro@gmail.com" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <p class="text-xs text-gray-500 mb-2">Business phone number</p>
                                <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="+62 124 1213 2411" required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- SIUP/TDP & Address --}}
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Business Registration Code</label>
                                <p class="text-xs text-gray-500 mb-2">Company Registration Code (SIUP/TDP)</p>
                                <input type="text" name="siup_tdp" value="{{ old('siup_tdp', $company->siup_tdp) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="123456789">
                                @error('siup_tdp')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                                <p class="text-xs text-gray-500 mb-2">Full Company Address</p>
                                <input type="text" name="address" value="{{ old('address', $company->address) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="New York City 123 St." required>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Website & City --}}
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                                <p class="text-xs text-gray-500 mb-2">Your website URL</p>
                                <input type="url" name="website" value="{{ old('website', $company->website) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="https://invoicepro.com">
                                @error('website')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <p class="text-xs text-gray-500 mb-2">Company City</p>
                                <input type="text" name="city" value="{{ old('city', $company->city) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="Jakarta" required>
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Province & Tax Rate --}}
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                                <p class="text-xs text-gray-500 mb-2">Company Province</p>
                                <input type="text" name="province" value="{{ old('province', $company->province) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="DKI Jakarta" required>
                                @error('province')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tax Rate</label>
                                <p class="text-xs text-gray-500 mb-2">Default tax percentage</p>
                                <input type="number" name="tax_rate" step="0.01" min="0" max="100" 
                                       value="{{ old('tax_rate', $company->tax_rate) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="11" required>
                                @error('tax_rate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Postal Code & Country --}}
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                                <p class="text-xs text-gray-500 mb-2">Company Postal Code</p>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $company->postal_code) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="12345" required>
                                @error('postal_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                <p class="text-xs text-gray-500 mb-2">Company Country</p>
                                <input type="text" name="country" value="{{ old('country', $company->country) }}" 
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                       placeholder="Indonesia" required>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Fax --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fax</label>
                            <p class="text-xs text-gray-500 mb-2">Company Fax Number (Optional)</p>
                            <input type="text" name="fax" value="{{ old('fax', $company->fax) }}" 
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                   placeholder="+62 21 1234567">
                            @error('fax')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Tax Information --}}
                <div class="bg-gray-50 rounded-lg p-8 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Tax Information</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NPWP ( Tax ID )</label>
                        <p class="text-xs text-gray-500 mb-2">Indonesia tax identification number</p>
                        <input type="text" name="npwp" value="{{ old('npwp', $company->npwp) }}" 
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                               placeholder="00.000.000.0-000.000" required>
                        @error('npwp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Payment Methods - Bank Information --}}
                <div class="bg-gray-50 rounded-lg p-8 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Payment Methods</h2>
                    <p class="text-sm text-gray-500 mb-6">Bank account information for invoices</p>
                    
                    <div class="border border-gray-200 rounded-lg p-5">
                        <div class="flex items-center mb-4">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Bank Transfer</span>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs text-gray-600 mb-2">Bank Name</label>
                                <input type="text" name="bank_name" value="{{ old('bank_name', $company->bank_name) }}" 
                                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                       placeholder="Bank Mandiri" required>
                                @error('bank_name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600 mb-2">Account Number</label>
                                <input type="text" name="account_number" value="{{ old('account_number', $company->account_number) }}" 
                                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                       placeholder="1234567890" required>
                                @error('account_number')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600 mb-2">Account Holder Name</label>
                                <input type="text" name="account_holder_name" value="{{ old('account_holder_name', $company->account_holder_name) }}" 
                                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                       placeholder="Pt Invoice Pro" required>
                                @error('account_holder_name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg transition shadow-sm">
                        Save Changes
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('logoPreview');
                    const placeholder = document.getElementById('logoPlaceholder');
                    
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection