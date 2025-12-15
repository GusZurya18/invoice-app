@extends('layouts.superadmin')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header with Back Button -->
                <div class="px-8 pt-8 pb-6">
                    <a href="{{ route('superadmin.kelola-perusahaan') }}"
                        class="inline-flex items-center text-gray-700 hover:text-gray-900 transition-colors duration-200 mb-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="font-medium">Kembali</span>
                    </a>
                    <h1 class="text-3xl font-bold text-blue-600 text-center">Tambah Data Perusahaan</h1>
                </div>

                <!-- Form Content -->
                <form action="{{ route('superadmin.company.store') }}" method="POST" id="taskForm" class="px-8 pb-8">
                    @csrf

                    <div class="bg-gray-50 rounded-lg p-8 mb-6">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-indigo-600" id="logoPlaceholder" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <img src="" alt="Logo" class="w-20 h-20 rounded-full object-cover hidden"
                                    id="logoPreview">
                            </div>
                            <h3 class="text-base font-medium text-gray-700 mb-1">Unggah Logo</h3>
                            <p class="text-xs text-gray-500 mb-4">Company Business</p>
                            <label for="logoInput" class="cursor-pointer">
                                <span
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-6 rounded-lg inline-block transition">
                                    Change Photo
                                </span>
                                <input type="file" id="logoInput" name="logo" accept="image/*" class="hidden">
                            </label>
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="company_name" class="block text-sm font-semibold text-gray-700">
                            Nama Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="company_name" id="company_name" placeholder="Masukkan Nama Perusahaan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('company_name') border-red-500 @enderror"
                            value="{{ old('company_name') }}" required>
                        @error('company_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="ptinvoicepro@gmail.com" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="+62 124 1213 2411" required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-6">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700">
                            Alamat
                        </label>
                        <textarea name="alamat" id="alamat" rows="4" placeholder="Masukkan Alamat"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="npwp" class="block text-sm font-semibold text-gray-700">
                            NPWP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="npwp" id="npwp" placeholder="Masukkan NPWP Perusahaan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('npwp') border-red-500 @enderror"
                            value="{{ old('npwp') }}" required>
                        @error('npwp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                            <select name="negara" id="negara"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                                required>
                                <option value="">-- Pilih Negara --</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Singapura">Singapura</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Filipina">Filipina</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                            </select>
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                Provinsi <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="provinsi" id="provinsi"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                                    required disabled>
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                            @error('priority')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Priority and Status Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kota/Kabupaten <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="kota" id="kota"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                                    required disabled>
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                </select>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="postal_code"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="12345" required>
                            @error('postal_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            Save Task
                        </button>
                        <a href="{{ route('admin.tasks.index') }}"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-xl text-center transition-all duration-200">
                            Cancel
                        </a>
                    </div>
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
            "Bengkulu": ["Bengkulu"],
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

        const negaraSelect = document.getElementById('negara');
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');

        negaraSelect.addEventListener('change', function() {
            provinsiSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            kotaSelect.disabled = true;

            if (this.value === "Indonesia") {
                provinsiSelect.disabled = false;

                Object.keys(dataIndonesia).forEach(prov => {
                    provinsiSelect.add(new Option(prov, prov));
                });

            } else {
                provinsiSelect.disabled = true;
            }
        });

        provinsiSelect.addEventListener('change', function() {
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';

            const kotaList = dataIndonesia[this.value] || [];

            kotaList.forEach(kota => {
                kotaSelect.add(new Option(kota, kota));
            });

            kotaSelect.disabled = kotaList.length === 0;
        });

        // Image Preview
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

    <style>
        /* Custom animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom scrollbar for textarea */
        textarea::-webkit-scrollbar {
            width: 6px;
        }

        textarea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: #c4b5fd;
            border-radius: 10px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: #a78bfa;
        }

        /* Date input styling */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: opacity(0.5);
            transition: filter 0.2s;
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            filter: opacity(1);
        }

        /* Scale effect */
        .scale-102 {
            transform: scale(1.01);
            transition: transform 0.2s ease;
        }
    </style>
@endsection
