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
        <!-- Hilangkan panah default dari <details> -->
    <style>
        /* Hilangkan panah di Chrome, Safari, Edge */
        details summary::-webkit-details-marker {
            display: none;
        }

        /* Hilangkan list style agar Firefox & lainnya tidak tampilkan panah */
        summary {
            list-style: none;
        }

        /* Ini untuk berjaga-jaga */
        details summary {
            cursor: pointer;
        }
    </style>
</head>
<body class="font-inter">

  @include('partials.header')

    <!-- Section Ekstrakulikuler -->
    <section class="mx-4 md:mx-20 my-10">
      <h2 class="text-2xl font-bold text-emerald-700 mb-6">Ekstrakurikuler</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
        <!-- Contoh Card Ekstrakurikuler -->
        <details class="bg-white rounded-xl shadow hover:shadow-md transition group cursor-pointer overflow-hidden">
          <summary class="p-4">
            <div class="flex flex-col items-center text-center">
              <img src="https://cdn-icons-png.flaticon.com/512/1525/1525525.png" alt="Pramuka" class="w-16 h-16 mb-3" />
              <h3 class="font-semibold text-lg text-gray-800">Pramuka</h3>
            </div>
          </summary>
          <div class="px-4 pb-4 text-sm text-gray-600">
            Membangun kedisiplinan, kepemimpinan, dan kerjasama tim melalui kegiatan kepramukaan.
          </div>
        </details>

        <details class="bg-white rounded-xl shadow hover:shadow-md transition group cursor-pointer overflow-hidden">
          <summary class="p-4">
            <div class="flex flex-col items-center text-center">
              <img src="https://cdn-icons-png.flaticon.com/512/3643/3643127.png" alt="Marching Band" class="w-16 h-16 mb-3" />
              <h3 class="font-semibold text-lg text-gray-800">Marching Band</h3>
            </div>
          </summary>
          <div class="px-4 pb-4 text-sm text-gray-600">
            Melatih musikalitas dan kekompakan baris-berbaris dalam formasi pertunjukan.
          </div>
        </details>

        <details class="bg-white rounded-xl shadow hover:shadow-md transition group cursor-pointer overflow-hidden">
          <summary class="p-4">
            <div class="flex flex-col items-center text-center">
              <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Arabic Forum" class="w-16 h-16 mb-3" />
              <h3 class="font-semibold text-lg text-emerald-800">Arabic Forum</h3>
            </div>
          </summary>
          <div class="px-4 pb-4 text-sm text-gray-600">
            Kegiatan pengembangan kemampuan berbahasa Arab baik lisan maupun tulisan.
          </div>
        </details>
        
      </div>
    </section>

  @include('partials.footer')

</body>
</html>
