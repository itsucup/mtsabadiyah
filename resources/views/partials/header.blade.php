<header id="main-header" class="shadow-md bg-white fixed w-full top-0 left-0 z-40 transition-all duration-300 ease-in-out">
  <nav class="mx-20 px-6 py-6 flex items-center justify-between transition-all duration-300 ease-in-out" id="main-navbar">
    <div class="flex items-center space-x-2">
      <div class="w-12 h-12 transition-all duration-300 ease-in-out" id="logo-container">
        <a href="{{ route('beranda') }}">
            <img
            src="{{ $lembagaSettings->logo_url ?? asset('images/logo_mtsabadiyah.png') }}"
            alt="{{ $lembagaSettings->nama_lembaga ?? 'Logo MTs Abadiyah' }}" {{-- Alt text dinamis --}}
            class="w-full h-full object-contain"
            />
        </a>
      </div>
      <div class="text-2xl font-bold text-green-700 transition-all duration-300 ease-in-out" id="header-text">
        <a href="{{ route('beranda') }}">{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }}</a>
      </div>
    </div>

    <ul class="hidden md:flex space-x-6 items-center font-medium">
      <li><a href="{{ route('beranda') }}" class="hover:text-green-700">Beranda</a></li>
      
      <li class="relative group">
        <button class="hover:text-green-700 focus:outline-none">
          Profil
        </button>
        <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 text-sm font-normal z-10">
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

      <li class="relative group">
        <button class="hover:text-green-700 focus:outline-none">
          Galeri
        </button>
        <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-10 text-sm font-normal">
          <li><a href="{{ route('galeri.foto') }}" class="block px-4 py-2 hover:bg-green-100">Galeri Foto</a></li>
          <li><a href="{{ route('galeri.video') }}" class="block px-4 py-2 hover:bg-green-100">Galeri Video</a></li>
        </ul>
      </li>
      <li><a href="{{ route('berita.index') }}" class="hover:text-green-700">Berita</a></li>
      <li><a href="{{ route('prestasi') }}" class="hover:text-green-700">Prestasi</a></li>
      <li><a href="https://ppdb.mtsabadiyah.sch.id/" target="_blank" class="hover:text-green-700">PPDB</a></li> {{-- Tambahkan target="_blank" untuk link eksternal --}}
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

  <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 space-y-2">
    <a href="{{ route('beranda') }}" class="block hover:text-green-700">Beranda</a>
    <div class="space-y-1">
      <button class="w-full text-left hover:text-green-700 mobile-dropdown-toggle">Profil</button>
      <div class="ml-4 space-y-1 hidden mobile-dropdown-menu">
        <a href="{{ route('profil.sambutan') }}" class="block hover:text-green-700">Kata Sambutan</a>
        <a href="{{ route('profil.sejarah') }}" class="block hover:text-green-700">Sejarah</a>
        <a href="{{ route('profil.visi_misi') }}" class="block hover:text-green-700">Visi dan Misi</a>
        <a href="{{ route('profil.staffdanguru') }}" class="block hover:text-green-700">Staff dan Guru</a>
        <a href="{{ route('profil.saranaprasarana') }}" class="block hover:text-green-700">Sarana dan Prasarana</a>
        <a href="{{ route('profil.ekstrakulikuler') }}" class="block hover:text-green-700">Ekstrakulikuler</a>
        <a href="{{ route('profil.mars') }}" class="block hover:text-green-700">Mars Madrasah Abadiyah</a>
        <a href="{{ route('profil.hymne') }}" class="block hover:text-green-700">Hymne Abadiyah</a>
      </div>
    </div>
    <div class="space-y-1">
      <button class="w-full text-left hover:text-green-700 mobile-dropdown-toggle">Program Kelas</button>
      <div class="ml-4 space-y-1 hidden mobile-dropdown-menu">
        <a href="{{ route('programkelas') }}" class="block hover:text-green-700">Semua Program</a> {{-- Ganti dengan link ke semua program --}}
        {{-- Jika Anda ingin sub-menu spesifik untuk setiap program, tambahkan rutenya di sini --}}
      </div>
    </div>
    <div class="space-y-1">
      <button class="w-full text-left hover:text-green-700 mobile-dropdown-toggle">Galeri</button>
      <div class="ml-4 space-y-1 hidden mobile-dropdown-menu">
        <a href="{{ route('galeri.foto') }}" class="block hover:text-green-700">Galeri Foto</a>
        <a href="{{ route('galeri.video') }}" class="block hover:text-green-700">Galeri Video</a>
      </div>
    </div>
    <a href="{{ route('berita.index') }}" class="block hover:text-green-700">Berita</a>
    <a href="{{ route('prestasi') }}" class="block hover:text-green-700">Prestasi</a>
    <a href="https://ppdb.mtsabadiyah.sch.id/" target="_blank" class="block hover:text-green-700">PPDB</a>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Mobile Menu Toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');

      if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });
      }

      // Mobile Dropdown Toggles
      const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
      mobileDropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
          const dropdownMenu = toggle.nextElementSibling;
          if (dropdownMenu && dropdownMenu.classList.contains('mobile-dropdown-menu')) {
            dropdownMenu.classList.toggle('hidden');
          }
        });
      });


      // Header Shrink on Scroll
      const header = document.getElementById('main-header');
      const navbar = document.getElementById('main-navbar');
      const logoContainer = document.getElementById('logo-container');
      const headerText = document.getElementById('header-text');

      const shrinkThreshold = 100; // Jarak scroll (px) sebelum header mengecil

      window.addEventListener('scroll', () => {
        if (window.scrollY > shrinkThreshold) {
          header.classList.add('shadow-xl'); // Tambah shadow lebih kuat saat shrink
          navbar.classList.remove('py-6');
          navbar.classList.add('py-3', 'md:py-4'); // Kurangi padding vertikal navbar
          
          logoContainer.classList.remove('w-12', 'h-12');
          logoContainer.classList.add('w-10', 'h-10'); // Perkecil logo
          
          headerText.classList.remove('text-2xl');
          headerText.classList.add('text-xl'); // Perkecil teks nama
        } else {
          header.classList.remove('shadow-xl');
          navbar.classList.remove('py-3', 'md:py-4');
          navbar.classList.add('py-6');
          
          logoContainer.classList.remove('w-10', 'h-10');
          logoContainer.classList.add('w-12', 'h-12');
          
          headerText.classList.remove('text-xl');
          headerText.classList.add('text-2xl');
        }
      });
    });
  </script>
</header>