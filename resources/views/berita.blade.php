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
    <title>MTs Abadiyah - Berita</title>
</head>
<body class="font-inter bg-gray-50">

    @include('partials.header')

    <section class="font-inter bg-sky-100 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="/">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Berita</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-2 space-y-6">
                @forelse ($beritas as $berita)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($berita->foto_header)
                            <img src="{{ $berita->foto_header }}" alt="{{ $berita->judul }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                        @endif
                        <div class="p-4">
                            <a href="{{ route('detail', $berita->id) }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900 transition-colors duration-200">{{ $berita->judul }}</a>
                            <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->translatedFormat('d F Y') }} oleh {{ $berita->user->name ?? 'Anonim' }}</p>
                            <p class="text-gray-700 mb-3">{{ Str::limit($berita->konten, 200) }}</p> {{-- Potong konten untuk ringkasan --}}
                            <a href="{{ route('detail', $berita->id) }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-600 py-10">
                        <p class="text-lg">Belum ada berita yang aktif.</p>
                    </div>
                @endforelse

                <div class="flex justify-center mt-8">
                    {{ $beritas->links() }} {{-- Laravel Pagination links --}}
                </div>
            </div>

            <aside class="space-y-6">
                {{-- Konten Sidebar statis atau bisa juga dimuat dinamis --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Cari Berita</h3>
                    <input type="text" placeholder="Cari..." class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Kategori</h3>
                    <ul class="text-gray-700 space-y-1">
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">Pengumuman</a></li>
                        <hr class="my-2 border-gray-200" />
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">Kegiatan</a></li>
                        <hr class="my-2 border-gray-200" />
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">Prestasi</a></li>
                        <hr class="my-2 border-gray-200" />
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">Ekstrakurikuler</a></li>
                    </ul>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Tahun</h3>
                    <ul class="text-gray-700 space-y-1">
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">2025</a></li>
                        <hr class="my-2 border-gray-200" />
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">2024</a></li>
                        <hr class="my-2 border-gray-200" />
                        <li><a href="#" class="hover:text-emerald-600 transition-colors duration-200">2023</a></li>
                    </ul>
                </div>
            </aside>

        </div>
    </section>

    @include('partials.footer')

</body>
</html>