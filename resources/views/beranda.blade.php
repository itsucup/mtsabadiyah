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

  <!-- Section Slider -->
  <section class="font-inter bg-sky-100 mx-20 my-2">
    <h2 class="mb-2 text-4xl font-semibold">Website MTs Abadiyah Gabus Pati</h2>
    <div class="mb-4 text-emerald-500">By Andika Ucup, 16 Mei 2025</div>
    <p class="">
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi quae velit pariatur atque sint! Inventore ad id iste debitis ipsa velit totam dolor sint incidunt vel quo expedita modi dicta labore eveniet, sapiente eligendi fugit dignissimos! Doloremque, eius placeat hic molestiae, facilis porro necessitatibus modi ea perferendis alias nulla repellat?
    </p>
  </section>

  <!-- Section Card Box Pengumuman -->
  <section class=" bg-sky-100 mx-20 my-6">
    <h2 class="text-xl font-semibold mb-4">Card Horizontal Scroll</h2>
    
    <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
      <!-- Card 1 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 1</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Card 2 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 2</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Card 3 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 3</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Tambah card lainnya sesuai kebutuhan -->
    </div>
  </section>

  <!-- Section Berita -->
  <section class="mx-20 bg-sky-100 my-6">
    <h2 class="text-xl font-semibold mb-4">Card Horizontal Scroll</h2>
    <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
      <!-- Card 1 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 1</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Card 2 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 2</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Card 3 -->
      <div class="min-w-[250px] bg-white shadow-md rounded-2xl p-4">
        <h3 class="font-bold text-lg mb-2">Card 3</h3>
        <p class="text-gray-600">Isi konten card di sini</p>
      </div>

      <!-- Tambah card lainnya sesuai kebutuhan -->
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
