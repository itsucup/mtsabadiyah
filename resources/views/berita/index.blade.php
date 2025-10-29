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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Berita</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24 bg-gray-50"> {{-- Added light gray background --}}

    @include('partials.header')

    {{-- Breadcrumb --}}
    <section class="font-inter bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1 overflow-x-auto whitespace-nowrap">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Berita</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        {{-- Grid container for main content and sidebar --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Main Content Column (News List) --}}
            <div class="md:col-span-2 space-y-6">
                @forelse ($beritas as $berita)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden transition hover:shadow-lg">
                        @if ($berita->header_url)
                            {{-- REVISI: Reduced image height on mobile --}}
                            <img src="{{ $berita->header_url }}" alt="{{ $berita->judul }}" class="w-full h-64 md:h-80 object-cover" loading="lazy">
                        @else
                            <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                        @endif
                        <div class="p-4 md:p-6"> {{-- Increased padding slightly on desktop --}}
                            {{-- REVISI: Adjusted title size for mobile --}}
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-lg md:text-xl font-semibold text-emerald-700 hover:text-emerald-900 transition-colors duration-200 block mb-1">{{ $berita->judul }}</a>
                            {{-- REVISI: Adjusted meta text size slightly --}}
                            <p class="text-xs md:text-sm text-gray-500 mb-2">{{ $berita->created_at->translatedFormat('d F Y') }} oleh {{ $berita->user->name ?? 'Anonim' }}</p>
                            {{-- REVISI: Adjusted excerpt text size --}}
                            <p class="text-sm md:text-base text-gray-700 mb-3">{{ Str::limit(strip_tags($berita->konten), 150) }}</p> {{-- Slightly shorter limit for mobile --}}
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 text-center text-gray-600 py-10 bg-white shadow rounded-lg"> {{-- Adjusted to span correctly if empty --}}
                        <p class="text-lg">Belum ada berita yang aktif.</p>
                    </div>
                @endforelse

                {{-- Pagination --}}
                <div class="flex justify-center pt-4"> {{-- Added padding top --}}
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            </div>

            {{-- Sidebar Column (Filters) --}}
            <aside class="space-y-6">
                {{-- Search Filter --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    {{-- REVISI: Adjusted title size --}}
                    <h3 class="text-base md:text-lg font-semibold text-emerald-700 mb-3">Cari Berita</h3>
                    <form action="{{ route('berita.index') }}" method="GET">
                        <div class="flex items-center border border-gray-300 rounded focus-within:ring-2 focus-within:ring-emerald-500">
                            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                                   class="w-full p-2 border-none focus:outline-none focus:ring-0 rounded-l text-sm"> {{-- Explicit text-sm --}}
                            <button type="submit" class="px-3 py-2 bg-emerald-600 text-white rounded-r hover:bg-emerald-700 transition duration-200">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Category Filter --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-base md:text-lg font-semibold text-emerald-700 mb-2">Kategori</h3>
                    {{-- REVISI: Adjusted list text size --}}
                    <ul class="text-sm text-gray-700 space-y-1">
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

                {{-- Archive Filter --}}
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-base md:text-lg font-semibold text-emerald-700 mb-2">Arsip Berita</h3>
                    {{-- REVISI: Adjusted list text size --}}
                    <ul class="text-sm text-gray-700 space-y-1">
                        @foreach ($archiveYears as $year => $months)
                            <li class="relative">
                                {{-- REVISI: Adjusted button text size --}}
                                <button class="w-full text-left py-1 hover:text-emerald-600 transition-colors duration-200 flex justify-between items-center {{ request('year') == $year ? 'font-bold text-emerald-700' : '' }}"
                                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('i').classList.toggle('rotate-180');">
                                    <span>{{ $year }}</span>
                                    <i class="fas fa-chevron-down text-xs ml-2 transition-transform duration-200 {{ request('year') == $year ? 'rotate-180' : '' }}"></i>
                                </button>
                                <ul class="pl-4 mt-1 space-y-1 {{ request('year') == $year ? '' : 'hidden' }}">
                                    @foreach ($months as $month)
                                        <li>
                                            <a href="{{ route('berita.index', array_merge(request()->except('month', 'page'), ['year' => $year, 'month' => $month['month_num']])) }}"
                                               class="block py-1 text-xs hover:text-emerald-600 transition-colors duration-200 {{ request('month') == $month['month_num'] && request('year') == $year ? 'font-bold text-emerald-700' : '' }}">
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

    {{-- REVISI: Simplified Archive Toggle JS (moved from inline onclick) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const archiveToggles = document.querySelectorAll('.bg-white.p-4.rounded-lg.shadow-md button');
            archiveToggles.forEach(button => {
                // Ensure click doesn't bubble up if nested
                button.addEventListener('click', (event) => {
                    event.stopPropagation(); 
                    const targetId = button.nextElementSibling.id; // Assumes UL is always next sibling
                    const targetUl = document.getElementById(targetId);
                    const icon = button.querySelector('i');
                    if(targetUl) {
                        targetUl.classList.toggle('hidden');
                    }
                    if(icon) {
                        icon.classList.toggle('rotate-180');
                    }
                });
            });
        });
    </script>
</body>
</html>