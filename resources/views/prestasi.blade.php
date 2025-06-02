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
    <title>MTs Abadiyah - Prestasi</title>
</head>
<body class="font-inter bg-gray-50"> {{-- Menambahkan bg-gray-50 untuk konsistensi --}}

    @include('partials.header')

    <section class="bg-sky-100 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="/">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Prestasi</span>
        </div>
    </section>

    <!-- <section class="mx-5 md:mx-20 my-6">
        @if ($prestasis->isNotEmpty() && $prestasis->first()->foto_header_url)
            <img src="{{ $prestasis->first()->foto_header_url }}" class="w-full h-[300px] md:h-[600px] object-cover rounded-lg shadow" alt="Gambar Prestasi">
        @else
            <div class="w-full h-[300px] md:h-[600px] bg-gray-200 flex items-center justify-center text-gray-500 text-lg rounded-lg shadow">No Image</div>
        @endif
    </section> -->

    <section class="mx-5 md:mx-20 my-6">
        <div>
            <h2 class="mb-2 text-3xl font-semibold text-gray-800">Data Prestasi</h2>
            <hr class="my-4 border-gray-200">

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
                        @forelse ($prestasis as $prestasi)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border-t border-r text-center">{{ $loop->iteration + ($prestasis->currentPage() - 1) * $prestasis->perPage() }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->nama_lengkap_anggota }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->nama_prestasi }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->tingkat_prestasi }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->instansi_penyelenggara }}</td>
                                <td class="px-4 py-2 border-t text-center">{{ $prestasi->tahun }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 border-t text-center text-gray-600">Belum ada data prestasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 p-4">
                {{ $prestasis->links() }} {{-- Menampilkan link paginasi --}}
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>