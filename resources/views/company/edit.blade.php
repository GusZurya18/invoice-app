@extends('layouts.superadmin')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="px-8 pt-8 pb-6">
                    <a href="{{ route('superadmin.kelola-perusahaan') }}"
                        class="inline-flex items-center text-gray-700 hover:text-gray-900 transition-colors duration-200 mb-6">
                        <span class="font-medium">Kembali</span>
                    </a>
                    <h1 class="text-3xl font-bold text-blue-600 text-center">Edit Data Perusahaan</h1>
                </div>

                <!-- Form -->
                <form action="{{ route('superadmin.company.update', $company->id) }}" method="POST"
                    enctype="multipart/form-data" class="px-8 pb-8">
                    @csrf
                    @method('PUT')

                    <!-- Logo -->
                    <div class="bg-gray-50 rounded-lg p-8 mb-6">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                                @if ($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo"
                                        class="w-20 h-20 rounded-full object-cover" id="logoPreview">
                                @else
                                    <svg class="w-12 h-12 text-indigo-600" id="logoPlaceholder" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16" />
                                    </svg>
                                @endif
                            </div>
                            <label class="cursor-pointer">
                                <span
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-6 rounded-lg">
                                    Change Photo
                                </span>
                                <input type="file" name="logo" id="logoInput" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <!-- Nama Perusahaan -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700">Nama Perusahaan</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $company->company_name) }}"
                            class="w-full px-4 py-3 rounded-xl border" required>
                    </div>

                    <!-- Email & Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $company->email) }}"
                                class="w-full px-4 py-2.5 border rounded-lg" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $company->phone) }}"
                                class="w-full px-4 py-2.5 border rounded-lg" required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700">Alamat</label>
                        <textarea name="address" rows="4" class="w-full px-4 py-3 rounded-xl border">{{ old('address', $company->address) }}</textarea>
                    </div>

                    <!-- NPWP -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700">NPWP</label>
                        <input type="text" name="npwp" value="{{ old('npwp', $company->npwp) }}"
                            class="w-full px-4 py-3 rounded-xl border" required>
                    </div>

                    <!-- Negara & Provinsi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                            <select name="country" id="country" class="w-full px-4 py-3 rounded-xl border" required>
                                <option value="Indonesia" selected>Indonesia</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <select name="province" id="province" class="w-full px-4 py-3 rounded-xl border"
                                required></select>
                        </div>
                    </div>

                    <!-- Kota & Kode Pos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                            <select name="city" id="city" class="w-full px-4 py-3 rounded-xl border"
                                required></select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $company->postal_code) }}"
                                class="w-full px-4 py-2.5 border rounded-lg" required>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-3 rounded-xl">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dataIndonesia = {
            "Aceh": ["Banda Aceh", "Langsa", "Lhokseumawe"],
            "Sumatera Utara": ["Medan", "Binjai", "Tebing Tinggi", "Sibolga"],
            "Sumatera Barat": ["Padang", "Bukittinggi", "Payakumbuh"],
            "Riau": ["Pekanbaru", "Dumai"],
            "Kepulauan Riau": ["Batam", "Tanjung Pinang"],
            "Jambi": ["Jambi", "Sungai Penuh"],
            "Sumatera Selatan": ["Palembang", "Lubuk Linggau"],
            "Bengkulu": ["Bengkkulu"],
            "Lampung": ["Bandar Lampung", "Metro"],
            "Bangka Belitung": ["Pangkal Pinang"],
            "DKI Jakarta": ["Jakarta Selatan", "Jakarta Timur", "Jakarta Barat", "Jakarta Utara", "Jakarta Pusat"],
            "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Depok", "Cirebon"],
            "Banten": ["Serang", "Tangerang", "Cilegon"],
            "Jawa Tengah": ["Semarang", "Solo", "Magelang", "Purwokerto"],
            "DI Yogyakarta": ["Yogyakarta", "Sleman", "Bantul"],
            "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun"],
            "Bali": ["Denpasar", "Badung", "Gianyar"],
            "Nusa Tenggara Barat": ["Mataram", "Bima"],
            "Nusa Tenggara Timur": ["Kupang"],
            "Kalimantan Barat": ["Pontianak", "Singkawang"],
            "Kalimantan Tengah": ["Palangka Raya"],
            "Kalimantan Selatan": ["Banjarmasin", "Banjarbaru"],
            "Kalimantan Timur": ["Samarinda", "Balikpapan"],
            "Kalimantan Utara": ["Tanjung Selor"],
            "Sulawesi Utara": ["Manado", "Bitung", "Tomohon"],
            "Sulawesi Tengah": ["Palu"],
            "Sulawesi Selatan": ["Makassar", "Parepare"],
            "Sulawesi Tenggara": ["Kendari"],
            "Gorontalo": ["Gorontalo"],
            "Sulawesi Barat": ["Mamuju"],
            "Maluku": ["Ambon", "Tual"],
            "Maluku Utara": ["Ternate", "Tidore"],
            "Papua": ["Jayapura"],
            "Papua Barat": ["Manokwari"],
            "Papua Barat Daya": ["Sorong"],
            "Papua Tengah": ["Nabire"],
            "Papua Pegunungan": ["Wamena"],
            "Papua Selatan": ["Merauke"]
        };

        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');

        const currentProvinsi = "{{ old('province', $company->province) }}";
        const currentKota = "{{ old('city', $company->city) }}";

        // Load province
        Object.keys(dataIndonesia).forEach(prov => {
            provinceSelect.add(new Option(prov, prov));
        });

        if (currentProvinsi) {
            provinceSelect.value = currentProvinsi;
            loadKota(currentProvinsi);
        }

        function loadKota(prov) {
            citySelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            (dataIndonesia[prov] || []).forEach(city => {
                citySelect.add(new Option(city, city));
            });
            if (currentKota) citySelect.value = currentKota;
        }

        provinceSelect.addEventListener('change', e => loadKota(e.target.value));

        // Preview logo
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                const img = document.getElementById('logoPreview');
                if (img) img.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
