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

    <!-- Section Gambar Konten -->
    <section class="">
      <div class="mx-20 my-6">
        <a href="#">
            <img src="{{ asset('images/dummy1.jpg') }}" class="w-full h-[600px] object-cover rounded-lg shadow" alt="Gambar Berita">
        </a>
      </div>
    </section>

    <!-- Section Tabel Prestasi -->
    <section class="mx-20 my-6">
    <div>
        <h2 class="mb-2 text-3xl font-semibold">Data Prestasi</h2>
        <hr class="my-4">

        <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-left border border-gray-200">
            <thead class="bg-emerald-600 text-white">
            <tr>
                <th class="px-4 py-2 border-r text-center">No</th>
                <th class="px-4 py-2 border-r text-center">Nama Lengkap</th>
                <th class="px-4 py-2 border-r text-center">Nama Prestasi</th>
                <th class="px-4 py-2 border-r text-center">Tingkat Prestasi</th>
                <th class="px-4 py-2 border-r text-center">Instansi Penyelenggara</th>
                <th class="px-4 py-2 text-center">Tahun</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border-t border-r text-center">1</td>
                <td class="px-4 py-2 border-t border-r">Ahmad Fauzi Prasetya Budi Utomo</td>
                <td class="px-4 py-2 border-t border-r">Juara 1 Lomba Pidato</td>
                <td class="px-4 py-2 border-t border-r">Kabupaten</td>
                <td class="px-4 py-2 border-t border-r">Dinas Pendidikan</td>
                <td class="px-4 py-2 border-t text-center">2024</td>
            </tr>
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border-t border-r text-center">2</td>
                <td class="px-4 py-2 border-t border-r">Siti Aminah</td>
                <td class="px-4 py-2 border-t border-r">Juara 2 MTQ</td>
                <td class="px-4 py-2 border-t border-r">Provinsi</td>
                <td class="px-4 py-2 border-t border-r">Kemenag Jateng</td>
                <td class="px-4 py-2 border-t text-center">2023</td>
            </tr>
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border-t border-r text-center">1</td>
                <td class="px-4 py-2 border-t border-r"> Budi Utomo</td>
                <td class="px-4 py-2 border-t border-r">Juara 1 Lomba Pidato</td>
                <td class="px-4 py-2 border-t border-r">Kabupaten</td>
                <td class="px-4 py-2 border-t border-r">Dinas Pendidikan</td>
                <td class="px-4 py-2 border-t text-center">2024</td>
            </tr>
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border-t border-r text-center">2</td>
                <td class="px-4 py-2 border-t border-r">Siti Aminah</td>
                <td class="px-4 py-2 border-t border-r">Juara 2 MTQ</td>
                <td class="px-4 py-2 border-t border-r">Provinsi</td>
                <td class="px-4 py-2 border-t border-r">Kemenag Jateng</td>
                <td class="px-4 py-2 border-t text-center">2023</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </section>

  @include('partials.footer')

</body>
</html>