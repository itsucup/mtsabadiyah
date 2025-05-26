<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-emerald-800 text-white flex flex-col transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out">
    <div class="flex items-center justify-center h-16 bg-emerald-900">
        <img src="{{ asset('images/logo_mtsabadiyah.jpg') }}" alt="Logo MTS Abadiyah" class="h-12 w-auto">
    </div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="/dashboard" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 flex items-center">
            <i class="fas fa-home mr-3 text-yellow-400"></i> Dashboard
        </a>

        {{-- Dropdown CMS --}}
        <div class="relative">
            <button id="cmsDropdownToggle" class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 focus:outline-none">
                <span class="flex items-center">
                    <i class="fas fa-file-alt mr-3 text-yellow-400"></i> CMS
                </span>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 transform" id="cmsDropdownArrow"></i>
            </button>
            <div id="cmsDropdownMenu" class="pl-6 mt-2 space-y-1 hidden"> {{-- Hidden by default --}}
                <a href="{{ route('cms.berita.index') }}" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    <i class="fas fa-newspaper mr-3"></i> Berita
                </a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 text-sm">
                    <i class="fas fa-images mr-3"></i> Galeri
                </a>
                {{-- Tambahkan menu CMS lain di sini --}}
            </div>
        </div>
        {{-- End Dropdown CMS --}}

        <a href="#" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 flex items-center">
            <i class="fas fa-users mr-3 text-yellow-400"></i> Users
        </a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-emerald-700 transition duration-200 flex items-center">
            <i class="fas fa-cog mr-3 text-yellow-400"></i> Settings
        </a>
        {{-- Tambahkan item menu lainnya di sini --}}
    </nav>
</aside>