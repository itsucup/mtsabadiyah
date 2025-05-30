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
        <span class="text-emerald-700 font-semibold">Program Kelas</span>
      </div>
    </section>

    <!-- Section Program Kelas -->
    <section class="mx-4 md:mx-20 my-10">
      <h2 class="text-2xl font-bold text-emerald-700 mb-6">Program Kelas</h2>

      <div class="space-y-4">
        <!-- Accordion Item -->
        <details class="bg-white shadow rounded overflow-hidden">
          <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
            <span class="text-lg font-semibold">Tahfidz</span>
          </summary>
          <div class="px-6 py-4 border-t text-gray-600">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Tahfidz" class="w-60 h-60">
            Program kelas khusus untuk menghafal Al-Qur'an secara intensif dengan pendampingan ustadz/ustadzah profesional.
          </div>
        </details>

        <details class="bg-white shadow rounded overflow-hidden">
          <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3326/3326709.png" alt="Kitab Salaf" class="w-8 h-8">
            <span class="text-lg font-semibold">Kitab Salaf</span>
          </summary>
          <div class="px-6 py-4 border-t text-gray-600">
            Mempelajari kitab-kitab klasik ulama salaf sebagai dasar pemahaman Islam yang mendalam dan tradisional.
          </div>
        </details>

        <details class="bg-white shadow rounded overflow-hidden">
          <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3176/3176363.png" alt="Sains dan Riset" class="w-8 h-8">
            <span class="text-lg font-semibold">Sains dan Riset</span>
          </summary>
          <div class="px-6 py-4 border-t text-gray-600">
            Fokus pada pengembangan kemampuan berpikir ilmiah, penelitian dan inovasi sains dengan pendekatan praktis.
          </div>
        </details>

        <details class="bg-white shadow rounded overflow-hidden">
          <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/1792/1792049.png" alt="Seni dan Olahraga" class="w-8 h-8">
            <span class="text-lg font-semibold">Prestasi Seni dan Olahraga</span>
          </summary>
          <div class="px-6 py-4 border-t text-gray-600">
            Membina bakat dan minat siswa dalam bidang seni dan olahraga untuk meraih prestasi di tingkat daerah hingga nasional.
          </div>
        </details>

        <details class="bg-white shadow rounded overflow-hidden">
          <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Reguler" class="w-8 h-8">
            <span class="text-lg font-semibold">Reguler</span>
          </summary>
          <div class="px-6 py-4 border-t text-gray-600">
            Program kelas umum yang mengikuti kurikulum nasional dengan pendekatan pembelajaran aktif dan menyenangkan.
          </div>
        </details>
      </div>
    </section>

  @include('partials.footer')

</body>
</html>