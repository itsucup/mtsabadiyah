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
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="font-inter bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Berita</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-2 space-y-6">
                @forelse ($beritas as $berita)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($berita->header_url) {{-- Menggunakan header_url sesuai migrasi berita --}}
                            <img src="{{ $berita->header_url }}" alt="{{ $berita->judul }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                        @endif
                        <div class="p-4">
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900 transition-colors duration-200">{{ $berita->judul }}</a>
                            <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->translatedFormat('d F Y') }} oleh {{ $berita->user->name ?? 'Anonim' }}</p>
                            <p class="text-gray-700 mb-3">{{ Str::limit(strip_tags($berita->konten), 200) }}</p>
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-600 py-10">
                        <p class="text-lg">Belum ada berita yang aktif.</p>
                    </div>
                @endforelse

                <div class="flex justify-center mt-8">
                    {{-- Paginasi Nomor --}}
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            </div>

            <aside class="space-y-6">
                {{-- Filter Pencarian --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Cari Berita</h3>
                    <form action="{{ route('berita.index') }}" method="GET">
                        <div class="flex items-center border border-gray-300 rounded focus-within:ring-2 focus-within:ring-emerald-500">
                            <input type="text" name="search" placeholder="Cari judul atau konten..." value="{{ request('search') }}"
                                   class="w-full p-2 border-none focus:outline-none focus:ring-0 rounded-l">
                            <button type="submit" class="px-3 py-2 bg-emerald-600 text-white rounded-r hover:bg-emerald-700 transition duration-200">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Filter Kategori --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Kategori</h3>
                    <ul class="text-gray-700 space-y-1">
                        <li><a href="{{ route('berita.index', array_merge(request()->except('kategori', 'page'), ['kategori' => null])) }}" class="block py-1 hover:text-emerald-600 transition-colors duration-200 {{ !request('kategori') ? 'font-bold text-emerald-700' : '' }}">Semua Kategori</a></li>
                        @foreach ($kategoris as $kategori)
                            <hr class="my-1 border-gray-200" />
                            <li>
                                <a href="{{ route('berita.index', array_merge(request()->except('kategori', 'page'), ['kategori' => $kategori->slug])) }}"
                                   class="block py-1 hover:text-emerald-600 transition-colors duration-200 {{ request('kategori') == $kategori->slug ? 'font-bold text-emerald-700' : '' }}">
                                    {{ $kategori->nama }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Filter Tahun dan Bulan --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2">Arsip Berita</h3>
                    <ul class="text-gray-700 space-y-1">
                        @foreach ($archiveYears as $year => $months)
                            <li class="relative">
                                <button class="w-full text-left py-1 hover:text-emerald-600 transition-colors duration-200 {{ request('year') == $year ? 'font-bold text-emerald-700' : '' }}"
                                    onclick="document.getElementById('archive-year-{{ $year }}').classList.toggle('hidden');">
                                    {{ $year }} <i class="fas fa-chevron-down text-xs ml-2"></i>
                                </button>
                                <ul id="archive-year-{{ $year }}" class="pl-4 mt-1 space-y-1 {{ request('year') == $year ? '' : 'hidden' }}">
                                    @foreach ($months as $month)
                                        <li>
                                            <a href="{{ route('berita.index', array_merge(request()->except('month', 'page'), ['year' => $year, 'month' => $month['month_num']])) }}"
                                               class="block py-1 text-sm hover:text-emerald-600 transition-colors duration-200 {{ request('month') == $month['month_num'] && request('year') == $year ? 'font-bold text-emerald-700' : '' }}">
                                                {{ $month['month_name'] }} ({{ $month['count'] }})
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <hr class="my-1 border-gray-200" />
                        @endforeach
                         <li><a href="{{ route('berita.index', array_merge(request()->except('year', 'month', 'page'), ['year' => null, 'month' => null])) }}" class="block py-1 hover:text-emerald-600 transition-colors duration-200 {{ !request('year') ? 'font-bold text-emerald-700' : '' }}">Semua Arsip</a></li>
                    </ul>
                </div>
            </aside>

        </div>
    </section>

    @include('partials.footer')

    <script>
        // Script ini diperlukan jika Anda menggunakan JavaScript di partials.header atau di welcome.blade.php
        // Pastikan tidak ada duplikasi script.
        // Jika script di app.js sudah ada, ini bisa dihapus atau dipindahkan ke app.js
    </script>
</body>
</html>