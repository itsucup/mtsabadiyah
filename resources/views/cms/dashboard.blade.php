@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Dashboard Overview</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> {{-- Perhatikan grid-cols-1 lg:grid-cols-3 untuk konsistensi --}}

        <!-- Card 1: Profil Lembaga (Memanjang Horizontal) -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600 col-span-full"> {{-- Mengambil seluruh lebar grid --}}
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-3 md:mb-0">Profil Lembaga</h2>
                <button id="editProfileBtn" class="text-emerald-600 hover:text-emerald-800 focus:outline-none flex items-center space-x-2">
                    <i class="fas fa-edit"></i> <span>Edit Profil</span>
                </button>
            </div>

            <div id="viewMode" class="flex flex-col md:flex-row items-start md:space-x-6 space-y-4 md:space-y-0">
                <div class="flex flex-col items-center justify-center min-w-[120px]"> {{-- Lebar tetap untuk logo --}}
                    <div class="relative group">
                        <img id="logoDisplay" src="https://mtsabadiyah.sch.id/uploads/logo.png" alt="Logo Lembaga" class="h-28 w-28 object-contain rounded-full border-2 border-gray-200 group-hover:border-emerald-600 transition-colors duration-200">
                    </div>
                    <button id="viewModeChangeLogoBtn" class="mt-3 px-3 py-1 bg-emerald-600 text-white text-xs rounded-md hover:bg-emerald-700 focus:outline-none hidden">
                        GANTI LOGO
                    </button> {{-- Tombol ini akan disembunyikan dan diaktifkan oleh JS saat di mode edit --}}
                </div>

                <div class="flex-1 space-y-2 text-gray-800">
                    <p class="text-lg font-bold flex items-center"><i class="fas fa-school mr-2 text-emerald-600"></i> <span id="institutionNameDisplay">Madrasah Tsanawiyah Abadiyah</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-map-marker-alt mr-2 mt-1 text-emerald-600"></i> <span id="institutionAddressDisplay">Jl. Raya Gabus - Pati No. 123, Gabus, Pati, Jawa Tengah</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-phone-alt mr-2 mt-1 text-emerald-600"></i> <span id="institutionAddressDisplay">+62 812-3456-7890</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-envelope mr-2 mt-1 text-emerald-600"></i> <span id="institutionAddressDisplay">info@mtsabadiyah.sch.id</span></p>
                </div>

                <div class="w-full md:w-1/4 flex justify-center items-center"> {{-- Wadah untuk jam analog --}}
                    {{-- Placeholder untuk jam analog (Anda bisa mengintegrasikan library jam analog di sini) --}}
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 border border-gray-300 relative overflow-hidden">
                        {{-- Ini adalah placeholder, Anda bisa menggantinya dengan implementasi jam analog yang sesungguhnya --}}
                        <div class="absolute w-1 h-12 bg-red-500 origin-bottom" style="transform: rotate(30deg); top: 16px; left: calc(50% - 2px);"></div> {{-- Detik --}}
                        <div class="absolute w-1 h-10 bg-gray-700 origin-bottom" style="transform: rotate(180deg); top: 22px; left: calc(50% - 2px);"></div> {{-- Menit --}}
                        <div class="absolute w-1 h-8 bg-gray-700 origin-bottom" style="transform: rotate(90deg); top: 30px; left: calc(50% - 2px);"></div> {{-- Jam --}}
                        <div class="absolute w-2 h-2 bg-gray-800 rounded-full"></div> {{-- Pusat jam --}}
                    </div>
                </div>
            </div>

            <!-- Pop-up Edit -->
            <div id="editMode" class="hidden space-y-4">
                <div class="flex flex-col items-center">
                    <label for="logoUpload" class="cursor-pointer">
                        <img id="logoPreview" src="{{ asset('images/logo_mtsabadiyah.jpg') }}" alt="Logo Preview" class="h-28 w-28 object-contain rounded-full border-2 border-gray-200 hover:border-emerald-600 transition-colors duration-200 mb-2">
                        <input type="file" id="logoUpload" class="hidden" accept="image/png, image/jpeg, image/jpg">
                    </label>
                    <p class="text-gray-500 text-xs">Klik gambar untuk mengubah logo</p>
                </div>
                <div>
                    <label for="institutionNameInput" class="block text-sm font-medium text-gray-700">Nama Lembaga/Sekolah</label>
                    <input type="text" id="institutionNameInput" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm p-2">
                </div>
                <div>
                    <label for="institutionAddressInput" class="block text-sm font-medium text-gray-700">Alamat Sekolah</label>
                    <textarea id="institutionAddressInput" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm p-2"></textarea>
                </div>
                <div>
                    <label for="tpDefaultInput" class="block text-sm font-medium text-gray-700">TP Default</label>
                    <input type="text" id="tpDefaultInput" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm p-2">
                </div>
                <div>
                    <label for="receiptModelInput" class="block text-sm font-medium text-gray-700">Model Kuitansi</label>
                    <input type="number" id="receiptModelInput" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm p-2">
                </div>
                <div class="flex justify-end space-x-2">
                    <button id="cancelEditBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">Batal</button>
                    <button id="saveProfileBtn" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">Simpan</button>
                </div>
            </div>
        </div>

        <!-- Card Statistik -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Statistik</h2>
            <p class="text-gray-600">Total Berita: <span class="font-bold text-emerald-600">540</span></p>
            <p class="text-gray-600">Total User: <span class="font-bold text-emerald-600">120</span></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Pengumuman Terbaru</h2>
            <ul class="text-gray-600 text-sm space-y-2">
                <li><span class="font-semibold text-emerald-600">18 Mei:</span> Libur Idul Adha 1446 H</li>
                <li><span class="font-semibold text-emerald-600">10 Mei:</span> Rapat Wali Murid Kelas IX</li>
                <li><span class="font-semibold text-emerald-600">01 Mei:</span> Penerimaan Siswa Baru Gel. 2 dibuka</li>
            </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Akses Cepat</h2>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <a href="#" class="flex flex-col items-center justify-center p-3 bg-emerald-100 text-emerald-800 rounded-lg hover:bg-emerald-200 transition">
                    <i class="fas fa-user-plus text-2xl mb-1"></i>
                    <span class="text-xs text-center">Tambah Akun</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-3 bg-emerald-100 text-emerald-800 rounded-lg hover:bg-emerald-200 transition">
                    <i class="fas fa-newspaper text-2xl mb-1"></i>
                    <span class="text-xs text-center">Tambah Berita</span>
                </a>
                <!-- <a href="#" class="flex flex-col items-center justify-center p-3 bg-emerald-100 text-emerald-800 rounded-lg hover:bg-emerald-200 transition">
                    <i class="fas fa-money-bill-wave text-2xl mb-1"></i>
                    <span class="text-xs text-center">Pembayaran</span>
                </a> -->
                <a href="#" class="flex flex-col items-center justify-center p-3 bg-emerald-100 text-emerald-800 rounded-lg hover:bg-emerald-200 transition">
                    <i class="fas fa-cogs text-2xl mb-1"></i>
                    <span class="text-xs text-center">Pengaturan</span>
                </a>
            </div>
        </div>
    </div>
@endsection