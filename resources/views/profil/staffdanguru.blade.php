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

  <!-- Breadcrumb -->
    <section class="bg-sky-100 mx-4 md:mx-20 my-6 p-4 rounded">
      <div class="flex items-center text-sm text-slate-500 space-x-1">
        <a href="/" class="hover:text-emerald-600 font-medium">Home</a>
        <span>&gt;</span>
        <span class="text-emerald-700 font-semibold">Staff dan Guru</span>
      </div>
    </section>

    <!-- Section Staff dan Guru -->
    <section class="mx-4 md:mx-20 my-10">
    <h2 class="text-2xl font-bold text-emerald-700 mb-6">Staff dan Guru</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card Staff -->
            <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://img.lovepik.com/element/40217/7533.png_1200.png" alt="Foto Guru" class="w-40 h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Ahmad Syafii</h3>
                    <p class="text-gray-600">Laki-laki</p>
                    <p class="text-gray-600">Guru Bahasa Arab</p>
                </div>
            </div>

            <!-- Card Staff -->
            <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://img.lovepik.com/element/40217/7533.png_1200.png" alt="Foto Guru" class="w-40 h-40 object-cover">
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">Siti Aminah</h3>
                <p class="text-gray-600">Perempuan</p>
                <p class="text-gray-600">Wakil Kepala Sekolah</p>
            </div>
            </div>

            <!-- Tambahan Card -->
            <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://img.lovepik.com/element/40217/7533.png_1200.png" alt="Foto Guru" class="w-40 h-40 object-cover">
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">Fadli Rahman</h3>
                <p class="text-gray-600">Laki-laki</p>
                <p class="text-gray-600">Guru Matematika</p>
            </div>
            </div>

            <!-- Tambahan Card -->
            <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://img.lovepik.com/element/40217/7533.png_1200.png" alt="Foto Guru" class="w-40 h-40 object-cover">
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">Nur Aini</h3>
                <p class="text-gray-600">Perempuan</p>
                <p class="text-gray-600">Staff Administrasi</p>
            </div>
            </div>
        </div>
    </section>

  @include('partials.footer')

</body>
</html>
