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

    <!-- Section Breadcumb -->
    <section class="font-inter bg-sky-100 mx-20 my-6 p-4">
      <div class="">
        <a class="text-slate-500" href="/">Home</a>
        >
        <span class="text-emerald-700 font-semibold">Berita</span>
      </div>
    </section>

    <!-- Konten Berita -->
    <section class="mx-6 md:mx-20 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Kolom Berita -->
        <div class="md:col-span-2 space-y-6">

            <!-- Dummy Berita -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('images/berita1.jpg') }}" alt="Berita 1" class="w-full h-80 object-cover">
            <div class="p-4">
                <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Kegiatan Pramuka MTs Abadiyah</a>
                <p class="text-sm text-gray-500 mb-2">17 Mei 2025</p>
                <p class="text-gray-700 mb-3">Pramuka menjadi kegiatan wajib yang melatih kedisiplinan dan kerja sama antar siswa...</p>
                <a href="{{ route('detail') }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
            </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('images/berita2.jpg') }}" alt="Berita 2" class="w-full h-80 object-cover">
            <div class="p-4">
                <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Lomba Cerdas Cermat Antar Kelas</a>
                <p class="text-sm text-gray-500 mb-2">15 Mei 2025</p>
                <p class="text-gray-700 mb-3">Dalam rangka memperingati Hari Pendidikan Nasional, MTs Abadiyah mengadakan lomba cerdas cermat...</p>
                <a href="{{ route('detail') }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
            </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('images/berita3.jpg') }}" alt="Berita 3" class="w-full h-80 object-cover">
            <div class="p-4">
                <a href="{{ route('detail') }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900">Kunjungan Industri ke Pabrik Buku</a>
                <p class="text-sm text-gray-500 mb-2">10 Mei 2025</p>
                <p class="text-gray-700 mb-3">Sebagai bentuk pembelajaran langsung, siswa diajak mengunjungi pabrik percetakan buku di Semarang...</p>
                <a href="{{ route('detail') }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
            </div>
            </div>

            <!-- Tambahkan lebih banyak dummy jika perlu -->

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
            <nav class="inline-flex items-center space-x-1">
                <a href="#" class="px-3 py-1 border border-gray-300 rounded hover:bg-emerald-100 text-gray-700">«</a>
                <a href="#" class="px-3 py-1 border border-gray-300 rounded bg-emerald-500 text-white">1</a>
                <a href="#" class="px-3 py-1 border border-gray-300 rounded hover:bg-emerald-100 text-gray-700">2</a>
                <a href="#" class="px-3 py-1 border border-gray-300 rounded hover:bg-emerald-100 text-gray-700">3</a>
                <a href="#" class="px-3 py-1 border border-gray-300 rounded hover:bg-emerald-100 text-gray-700">»</a>
            </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-6">

            <!-- Pencarian -->
            <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-emerald-700 mb-2">Cari Berita</h3>
            <input type="text" placeholder="Cari..." class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <!-- Kategori -->
            <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-emerald-700 mb-2">Kategori</h3>
            <ul class="text-gray-700">
                <li><a href="#" class="hover:text-emerald-600">Pengumuman</a></li>
                <hr class="my-2 border-gray-200" />
                <li><a href="#" class="hover:text-emerald-600">Kegiatan</a></li>
                <hr class="my-2 border-gray-200" />
                <li><a href="#" class="hover:text-emerald-600">Prestasi</a></li>
                <hr class="my-2 border-gray-200" />
                <li><a href="#" class="hover:text-emerald-600">Ekstrakurikuler</a></li>
            </ul>
            </div>

            <!-- Tahun -->
            <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-emerald-700 mb-2">Tahun</h3>
            <ul class="text-gray-700">
                <li><a href="#" class="hover:text-emerald-600">2025</a></li>
                <hr class="my-2 border-gray-200" />
                <li><a href="#" class="hover:text-emerald-600">2024</a></li>
                <hr class="my-2 border-gray-200" />
                <li><a href="#" class="hover:text-emerald-600">2023</a></li>
            </ul>
            </div>
        </aside>

        </div>
    </section>

    <!-- Aktifkan feather icon -->
    <script>
        feather.replace();
    </script>

  @include('partials.footer')

</body>
</html>
