<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-emerald-800 text-white flex flex-col transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out">
    <div class="flex items-center justify-center h-16 bg-emerald-900">
        <img 
        src="{{ $lembagaSettings->logo_url ?? asset('images/logo_mtsabadiyah.png') }}" 
        alt="{{ $lembagaSettings->nama_lembaga ?? 'Logo MTs Abadiyah' }}" 
        class="h-12 w-auto"
        >
    </div>
    
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar"> 
        {{-- Dashboard (bisa diakses admin & kontributor, karena bagian dari CMS secara umum) --}}
        @can('view-cms-pages')
        <a href="{{ route('cms.dashboard') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 flex items-center">
            <i class="fas fa-home mr-3 text-yellow-400"></i> Dashboard
        </a>
        @endcan

        {{-- CMS Dropdown (Berita: Admin/Kontributor; Galeri: Hanya Admin) --}}
        @can('view-cms-pages')
        <div class="relative">
            <button id="cmsDropdownToggle" class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 focus:outline-none">
                <span class="flex items-center">
                    <i class="fas fa-file-alt mr-3 text-yellow-400"></i> CMS
                </span>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 transform" id="cmsDropdownArrow"></i>
            </button>
            <div id="cmsDropdownMenu" class="pl-6 mt-2 space-y-1 hidden">
                {{-- Berita bisa diakses admin & kontributor --}}
                <a href="{{ route('cms.berita.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    <i class="fas fa-newspaper mr-3"></i> Berita
                </a>
                
                {{-- Galeri Foto & Video (Hanya Admin) --}}
                @can('view-admin-pages')
                <a href="{{ route('cms.admin.galeri.foto.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    <i class="fas fa-images mr-3"></i> Galeri Foto
                </a>
                <a href="{{ route('cms.admin.galeri.video.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    <i class="fas fa-video mr-3"></i> Galeri Video
                </a>
                @endcan
            </div>
        </div>
        @endcan

        {{-- Menu Users (Hanya Admin) --}}
        @can('view-admin-pages')
        <a href="{{ route('cms.admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 flex items-center">
            <i class="fas fa-users mr-3 text-yellow-400"></i> Users
        </a>
        @endcan

        {{-- Kategori Dropdown --}}
        @can('view-admin-pages')
        <div class="relative">
            <button id="kategoriDropdownToggle" class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 focus:outline-none">
                <span class="flex items-center">
                    <i class="fas fa-plus mr-3 text-yellow-400"></i> Tambah Kategori
                </span>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 transform" id="kategoriDropdownArrow"></i>
            </button>
            <div id="kategoriDropdownMenu" class="pl-6 mt-2 space-y-1 hidden">
                {{-- Kategori Staff dan Guru --}}
                <a href="{{ route('cms.admin.kategori_jabatan.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    Kategori Staff dan Guru
                </a>
                <a href="{{ route('cms.admin.kategori_berita.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    Kategori Berita
                </a>
                {{-- Kategori Foto --}}
                <a href="{{ route('cms.admin.galeri.kategori.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    Kategori Foto
                </a>
            </div>
        </div>
        @endcan

        {{-- Menu Profil Lembaga (Admin atau Kontributor - diasumsikan bisa dikelola keduanya) --}}
        @can('view-admin-pages')
        <div class="relative">
            <button id="profilDropdownToggle" class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 focus:outline-none">
                <span class="flex items-center">
                    <i class="fa fa-university mr-3 text-yellow-400"></i> Profil Lembaga
                </span>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 transform" id="profilDropdownArrow"></i>
            </button>
            <div id="profilDropdownMenu" class="pl-6 mt-2 space-y-1 hidden">
                <a href="{{ route('cms.admin.sambutan_kepala_sekolah.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Kata Sambutan</a>
                <a href="{{ route('cms.admin.sejarah.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Sejarah</a>
                <a href="{{ route('cms.admin.visi_misi.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Visi dan Misi</a>
                <a href="{{ route('cms.admin.staff_dan_guru.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Staff dan Guru</a>
                <a href="{{ route('cms.admin.sarana_prasarana.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Sarana dan Prasarana</a>
                <a href="{{ route('cms.admin.ekstrakulikuler.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Ekstrakulikuler</a>
                <a href="{{ route('cms.admin.mars_madrasah_abadiyah.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Mars Madrasah Abadiyah</a>
                <a href="{{ route('cms.admin.hymne_abadiyah.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Hymne Abadiyah</a>
                <a href="{{ route('cms.admin.program_kelas.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Program Kelas</a>
                <a href="{{ route('cms.admin.prestasi.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">Prestasi</a>
            </div>
        </div>
        @endcan

        {{-- Menu Settings (Hanya Admin) --}}
        @can('view-admin-pages')
        <div class="relative">
            <button id="settingsDropdownToggle" class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 focus:outline-none">
                <span class="flex items-center">
                    <i class="fas fa-cog mr-3 text-yellow-400"></i> Settings
                </span>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 transform" id="settingsDropdownArrow"></i>
            </button>
            <div id="settingsDropdownMenu" class="pl-6 mt-2 space-y-1 hidden">
                <a href="{{ route('cms.admin.settings.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    Profil Lembaga
                </a>
                <a href="{{ route('cms.admin.header_sliders.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    Gambar Slider
                </a>
            </div>
        </div>
        @endcan

        {{-- Tambahkan item menu lainnya di sini --}}
    </nav>
</aside>