<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>MTs Abadiyah</title>
</head>
<body class="font-inter">

  @include('partials.header')

  <!-- Section Slider Banner -->
<section class="relative w-full h-[600px] overflow-hidden">
  <!-- Gambar Slider -->
  <div id="slider" class="relative w-full h-full">
    <img src="{{ asset('images/header1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-100 transition-opacity duration-1000" />
    <img src="{{ asset('images/header2.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000" />
    <img src="{{ asset('images/header3.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000" />
  </div>

  <!-- Overlay Teks Opsional -->
  <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
    <h1 class="text-white text-3xl md:text-5xl font-bold">Selamat Datang di MTs Abadiyah</h1>
  </div>
</section>

<!-- Script Slider -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('#slider img');
    let index = 0;

    setInterval(() => {
      slides[index].classList.remove('opacity-100');
      slides[index].classList.add('opacity-0');

      index = (index + 1) % slides.length;

      slides[index].classList.remove('opacity-0');
      slides[index].classList.add('opacity-100');
    }, 7000); // ganti gambar setiap 5 detik
  });
</script>



  <!-- Section Berita Terbaru -->
  <section class="mx-4 md:mx-20 my-12">
    <h2 class="text-3xl font-bold text-emerald-700 text-center mb-12">Berita Terbaru</h2>

    <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
      <!-- Card Berita 1 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita1.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Kegiatan Pesantren Kilat</a>
          <p class="text-sm text-gray-500 mb-2">Admin - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">Siswa mengikuti kegiatan religi menjelang Ramadhan.</p>
        </div>
      </div>

      <!-- Card Berita 2 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita2.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Juara Olimpiade Sains</a>
          <p class="text-sm text-gray-500 mb-2">Kontributor - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">MTs Abadiyah meraih juara 1 tingkat kabupaten.</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita3.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Turnamen Futsal</a>
          <p class="text-sm text-gray-500 mb-2">Kontributor - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">Pertandingan antar kelas berlangsung seru dan sportif.</p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita2.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Pameran Karya Siswa</a>
          <p class="text-sm text-gray-500 mb-2">Admin - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">Menampilkan hasil kreativitas siswa kelas seni rupa.</p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita1.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Science Fair 2025</a>
          <p class="text-sm text-gray-500 mb-2">Admin - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">Ajang inovasi siswa dalam bidang riset dan eksperimen.</p>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="min-w-[400px] max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset('images/berita1.jpg') }}" class="w-full h-60 object-cover" />
        <div class="p-4">
          <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Pelepasan Kelas IX</a>
          <p class="text-sm text-gray-500 mb-2">Admin - 29 Maret 2023</p>
          <p class="text-sm text-gray-600 mt-2">Seremonial dan doa bersama untuk siswa kelas akhir.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section Program Kelas -->
  <section class="py-16 px-6 md:px-20 bg-emerald-600 font-[Inter]">
    <h2 class="text-3xl font-bold text-white text-center mb-12">Program Kelas Unggulan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Card 1 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ asset('images/program-tahfidz.jpg') }}" alt="Tahfidz" class="w-16 h-16 rounded-full object-cover shadow-md">
          <h3 class="text-xl font-semibold text-emerald-700">Tahfidz</h3>
        </div>
        <p class="text-gray-600">Program penguatan hafalan Al-Qur’an dengan bimbingan intensif setiap hari.</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ asset('images/program-kitab.jpg') }}" alt="Kitab Salaf" class="w-16 h-16 rounded-full object-cover shadow-md">
          <h3 class="text-xl font-semibold text-emerald-700">Kitab Salaf</h3>
        </div>
        <p class="text-gray-600">Pembelajaran kitab-kitab klasik salaf yang ditanamkan nilai keilmuan dan akhlak.</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ asset('images/program-sains.jpg') }}" alt="Sains dan Riset" class="w-16 h-16 rounded-full object-cover shadow-md">
          <h3 class="text-xl font-semibold text-emerald-700">Sains & Riset</h3>
        </div>
        <p class="text-gray-600">Mendorong inovasi dan eksperimen ilmiah sejak dini melalui penelitian sederhana.</p>
      </div>

      <!-- Card 4 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ asset('images/program-prestasi.jpg') }}" alt="Prestasi Seni" class="w-16 h-16 rounded-full object-cover shadow-md">
          <h3 class="text-xl font-semibold text-emerald-700">Seni & Olahraga</h3>
        </div>
        <p class="text-gray-600">Pengembangan bakat siswa dalam bidang seni dan olahraga ke arah prestasi.</p>
      </div>

      <!-- Card 5 -->
      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ asset('images/program-reguler.jpg') }}" alt="Reguler" class="w-16 h-16 rounded-full object-cover shadow-md">
          <h3 class="text-xl font-semibold text-emerald-700">Reguler</h3>
        </div>
        <p class="text-gray-600">Pembelajaran umum sesuai kurikulum nasional dengan pendekatan aktif dan kontekstual.</p>
      </div>
    </div>
  </section>

  
  <!-- Section Kontak -->
  <section id="kontak" class="bg-white py-12 px-6 md:px-20 font-[Inter]">
    <h2 class="text-2xl font-bold text-emerald-700 mb-6 text-center">Kontak Kami</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

      <!-- Google Maps -->
      <div class="w-full h-[300px] md:h-[300px]">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.6462667199965!2d110.85425687414641!3d-7.1597004928547835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e712c9ea1d0cbbb%3A0x8165a17322c8fcba!2sMTs%20Abadiyah%20Gabus%20Pati!5e0!3m2!1sid!2sid!4v1715921153742!5m2!1sid!2sid"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md"></iframe>
      </div>

      <!-- Info Kontak -->
      <div class="space-y-6 text-gray-800">
        <div class="flex items-start space-x-3">
          <i class="fas fa-map-marker-alt text-emerald-600 text-xl mt-1"></i>
          <div>
            <h3 class="text-lg font-semibold text-emerald-700">Alamat</h3>
            <p>Jl. Raya Gabus No.123, Gabus, Kab. Pati, Jawa Tengah 59173</p>
          </div>
        </div>

        <div class="flex items-start space-x-3">
          <i class="fas fa-phone text-emerald-600 text-xl mt-1"></i>
          <div>
            <h3 class="text-lg font-semibold text-emerald-700">Telepon</h3>
            <p>+62 812-3456-7890</p>
          </div>
        </div>

        <div class="flex items-start space-x-3">
          <i class="fas fa-envelope text-emerald-600 text-xl mt-1"></i>
          <div>
            <h3 class="text-lg font-semibold text-emerald-700">Email</h3>
            <p>info@mtsabadiyah.sch.id</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  @include('partials.footer')

</body>
</html>
