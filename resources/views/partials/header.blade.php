<header id="main-header" class="bg-white fixed w-full top-0 left-0 z-40 transition-all duration-300 ease-in-out group/header">
    
    <nav class="px-6 py-6 lg:mx-20 flex items-center justify-between transition-all duration-300 ease-in-out group-[.is-shrunk]/header:py-3" id="main-navbar">
        <div class="flex items-center space-x-2">
            
            <div class="w-10 h-10 md:w-12 md:h-12 transition-all duration-300 ease-in-out group-[.is-shrunk]/header:w-10 group-[.is-shrunk]/header:h-10" id="logo-container">
                <a href="{{ route('beranda') }}">
                    <img
                    src="{{ $lembagaSettings->logo_url ?? asset('images/logo_mtsabadiyah.png') }}"
                    alt="{{ $lembagaSettings->nama_lembaga ?? 'Logo MTs Abadiyah' }}"
                    class="w-full h-full object-contain"
                    />
                </a>
            </div>
            
            <div class="text-xl md:text-2xl font-bold text-green-700 transition-all duration-300 ease-in-out group-[.is-shrunk]/header:text-xl" id="header-text">
                <a href="{{ route('beranda') }}">{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }}</a>
            </div>
        </div>

        <ul class="hidden md:flex space-x-6 items-center font-medium">
            <li><a href="{{ route('beranda') }}" class="hover:text-green-700">Beranda</a></li>
            
            <li class="relative group/profil">
                <button class="hover:text-green-700 focus:outline-none">
                    Profil
                </button>
                <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover/profil:opacity-100 group-hover/profil:visible transition-opacity duration-200 text-sm font-normal z-10">
                    <li><a href="{{ route('profil.sambutan') }}" class="block px-4 py-2 hover:bg-green-100">Kata Sambutan</a></li>
                    <li><a href="{{ route('profil.sejarah') }}" class="block px-4 py-2 hover:bg-green-100">Sejarah</a></li>
                    <li><a href="{{ route('profil.visi_misi') }}" class="block px-4 py-2 hover:bg-green-100">Visi dan Misi</a></li>
                    <li><a href="{{ route('profil.staffdanguru') }}" class="block px-4 py-2 hover:bg-green-100">Staff dan Guru</a></li>
                    <li><a href="{{ route('profil.saranaprasarana') }}" class="block px-4 py-2 hover:bg-green-100">Sarana dan Prasarana</a></li>
                    <li><a href="{{ route('profil.ekstrakulikuler') }}" class="block px-4 py-2 hover:bg-green-100">Ekstrakulikuler</a></li>
                    <li><a href="{{ route('profil.mars') }}" class="block px-4 py-2 hover:bg-green-100">Mars Madrasah Abadiyah</a></li>
                    <li><a href="{{ route('profil.hymne') }}" class="block px-4 py-2 hover:bg-green-100">Hymne Abadiyah</a></li>
                </ul>
            </li>

            <li><a href="{{ route('programkelas') }}" class="hover:text-green-700">Program Kelas</a></li>

            <li class="relative group/galeri">
                <button class="hover:text-green-700 focus:outline-none">
                    Galeri
                </button>
                <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover/galeri:opacity-100 group-hover/galeri:visible transition-opacity duration-200 z-10 text-sm font-normal">
                    <li><a href="{{ route('galeri.foto') }}" class="block px-4 py-2 hover:bg-green-100">Galeri Foto</a></li>
                    <li><a href="{{ route('galeri.video') }}" class="block px-4 py-2 hover:bg-green-100">Galeri Video</a></li>
                </ul>
            </li>
            <li><a href="{{ route('berita.index') }}" class="hover:text-green-700">Berita</a></li>
            <li><a href="{{ route('prestasi') }}" class="hover:text-green-700">Prestasi</a></li>
            <li><a href="https://ppdb.mtsabadiyah.sch.id/" target="_blank" class="hover:text-green-700">PPDB</a></li>
        </ul>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-green-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="md:hidden hidden px-6 pb-4">
        <a href="{{ route('beranda') }}" class="block hover:text-green-700 py-2">Beranda</a>
        
        <div>
            <button class="flex w-full items-center justify-between hover:text-green-700 mobile-dropdown-toggle py-2">
                <span>Profil</span>
                <svg class="h-4 w-4 transition-transform duration-200 mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="ml-4 hidden mobile-dropdown-menu mt-1">
                <a href="{{ route('profil.sambutan') }}" class="block hover:text-green-700 py-1">Kata Sambutan</a>
                <a href="{{ route('profil.sejarah') }}" class="block hover:text-green-700 py-1">Sejarah</a>
                <a href="{{ route('profil.visi_misi') }}" class="block hover:text-green-700 py-1">Visi dan Misi</a>
                <a href="{{ route('profil.staffdanguru') }}" class="block hover:text-green-700 py-1">Staff dan Guru</a>
                <a href="{{ route('profil.saranaprasarana') }}" class="block hover:text-green-700 py-1">Sarana dan Prasarana</a>
                <a href="{{ route('profil.ekstrakulikuler') }}" class="block hover:text-green-700 py-1">Ekstrakulikuler</a>
                <a href="{{ route('profil.mars') }}" class="block hover:text-green-700 py-1">Mars Madrasah Abadiyah</a>
                <a href="{{ route('profil.hymne') }}" class="block hover:text-green-700 py-1">Hymne Abadiyah</a>
            </div>
        </div>

        <a href="{{ route('programkelas') }}" class="block hover:text-green-700 py-2">Program Kelas</a>

        <div>
            <button class="flex w-full items-center justify-between hover:text-green-700 mobile-dropdown-toggle py-2">
                <span>Galeri</span>
                <svg class="h-4 w-4 transition-transform duration-200 mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="ml-4 hidden mobile-dropdown-menu mt-1">
                <a href="{{ route('galeri.foto') }}" class="block hover:text-green-700 py-1">Galeri Foto</a>
                <a href="{{ route('galeri.video') }}" class="block hover:text-green-700 py-1">Galeri Video</a>
            </div>
        </div>

        <a href="{{ route('berita.index') }}" class="block hover:text-green-700 py-2">Berita</a>
        <a href="{{ route('prestasi') }}" class="block hover:text-green-700 py-2">Prestasi</a>
        <a href="https://ppdb.mtsabadiyah.sch.id/" target="_blank" class="block hover:text-green-700 py-2">PPDB</a>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const dropdownMenu = toggle.nextElementSibling;
                const arrow = toggle.querySelector('.mobile-dropdown-arrow');

                if (dropdownMenu && dropdownMenu.classList.contains('mobile-dropdown-menu')) {
                    dropdownMenu.classList.toggle('hidden');
                    if (arrow) {
                        arrow.classList.toggle('rotate-180');
                    }
                }
            });
        });

        const header = document.getElementById('main-header');
        const shrinkThreshold = 100;

        window.addEventListener('scroll', () => {
            if (window.scrollY > shrinkThreshold) {
                header.classList.add('is-shrunk', 'shadow-xl');
            } else {
                header.classList.remove('is-shrunk', 'shadow-xl');
            }
        });
    });
    </script>
</header>