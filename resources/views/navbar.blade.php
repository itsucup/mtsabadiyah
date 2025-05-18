<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MTs Abadiyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-white text-gray-800">
    <header class="shadow-md">
      <nav class="bg-white mx-20 px-6 py-6 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <!-- Box Logo -->
          <div class="w-12 h-12">
            <img
              src="https://mtsabadiyah.sch.id/uploads/logo.png"
              alt="Logo MTs Abadiyah"
              class="w-full h-full object-contain"
            />
          </div>
          <!-- Teks Nama -->
          <div class="text-2xl font-bold text-green-700">
            <a href="#">MTs Abadiyah Gabus Pati</a>
          </div>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex space-x-6 items-center font-medium">
          <li><a href="#" class="hover:text-green-700">Beranda</a></li>
          
          <!-- Profil Dropdown -->
          <li class="relative group">
            <button class="hover:text-green-700 focus:outline-none">
              Profil
            </button>
            <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-10">
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Kata Sambutan</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Sejarah</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Visi dan Misi</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Staff dan Guru</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Sarana dan Prasarana</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Mars Madrasah Abadiyah</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Hymne Abadiyah</a></li>
            </ul>
          </li>

          <!-- Program Kelas Dropdown -->
          <li class="relative group">
            <button class="hover:text-green-700 focus:outline-none">
              Program Kelas
            </button>
            <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-10">
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Tahfidz</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Kitab Salaf</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Sains dan Riset</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Prestasi Seni dan Olahraga</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Reguler</a></li>
            </ul>
          </li>

          <!-- Galeri Dropdown -->
          <li class="relative group">
            <button class="hover:text-green-700 focus:outline-none">
              Galeri
            </button>
            <ul class="absolute left-0 mt-0 w-40 bg-white shadow-md rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-10">
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Galeri Siswa</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Galeri Guru</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-green-100">Galeri Karya</a></li>
            </ul>
          </li>
          <li><a href="#" class="hover:text-green-700">Berita</a></li>
          <li><a href="#" class="hover:text-green-700">Prestasi</a></li>
          <li><a href="https://ppdb.mtsabadiyah.sch.id/" class="hover:text-green-700">PPDB</a></li>
        </ul>

        <!-- Mobile Hamburger -->
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

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 space-y-2">
        <a href="#" class="block hover:text-green-700">Beranda</a>
        <div class="space-y-1">
          <button class="w-full text-left hover:text-green-700">Profil</button>
          <div class="ml-4 space-y-1">
            <a href="#" class="block hover:text-green-700">Kata Sambutan</a>
            <a href="#" class="block hover:text-green-700">Sejarah</a>
            <a href="#" class="block hover:text-green-700">Visi dan Misi</a>
            <a href="#" class="block hover:text-green-700">Staff dan Guru</a>
            <a href="#" class="block hover:text-green-700">Sarana dan Prasarana</a>
            <a href="#" class="block hover:text-green-700">Mars Madrasah Abadiyah</a>
            <a href="#" class="block hover:text-green-700">Hymne Abadiyah</a>
          </div>
        </div>
        <div class="space-y-1">
          <button class="w-full text-left hover:text-green-700">Program Kelas</button>
          <div class="ml-4 space-y-1">
            <a href="#" class="block hover:text-green-700">Tahfidz</a>
            <a href="#" class="block hover:text-green-700">Kitab Salaf</a>
            <a href="#" class="block hover:text-green-700">Sains dan Riset</a>
            <a href="#" class="block hover:text-green-700">Prestasi Seni dan Olahraga</a>
            <a href="#" class="block hover:text-green-700">Reguler</a>
          </div>
        </div>
        <div class="space-y-1">
          <button class="w-full text-left hover:text-green-700">Galeri</button>
          <div class="ml-4 space-y-1">
            <a href="#" class="block hover:text-green-700">Galeri Siswa</a>
            <a href="#" class="block hover:text-green-700">Galeri Guru</a>
            <a href="#" class="block hover:text-green-700">Galeri Karya</a>
          </div>
        </div>
        <a href="#" class="block hover:text-green-700">Berita</a>
        <a href="#" class="block hover:text-green-700">Prestasi</a>
        <a href="#" class="block hover:text-green-700">PPDB</a>
      </div>
    </header>

    <script>
      const btn = document.getElementById('mobile-menu-button');
      const menu = document.getElementById('mobile-menu');

      btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    </script>

    <!-- Footer -->
    <footer class="bg-emerald-700 text-white py-8 px-6 md:px-20">
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        
        <!-- Logo Sekolah -->
        <div class="flex items-center space-x-4">
          <img src="https://mtsabadiyah.sch.id/uploads/logo.png" alt="Logo MTs Abadiyah" class="w-12 h-12 object-contain" />
          <span class="text-xl font-semibold">MTs Abadiyah Gabus Pati</span>
        </div>

        <!-- Sosial Media -->
        <div class="flex space-x-5 text-white text-2xl">
          <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="hover:text-gray-300 transition">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://instagram.com" target="_blank" aria-label="Instagram" class="hover:text-gray-300 transition">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://tiktok.com" target="_blank" aria-label="TikTok" class="hover:text-gray-300 transition">
            <i class="fab fa-tiktok"></i>
          </a>
          <a href="https://youtube.com" target="_blank" aria-label="YouTube" class="hover:text-gray-300 transition">
            <i class="fab fa-youtube"></i>
          </a>
        </div>

      </div>

      <!-- Copyright -->
      <div class="text-center text-sm mt-6 text-gray-200">
        &copy; 2025 MTs Abadiyah Gabus Pati. All rights reserved.
      </div>
    </footer>
  </body>
</html>