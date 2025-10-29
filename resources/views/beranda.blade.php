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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }}</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24"> 
    @include('partials.header')

    <section class="relative w-full h-[450px] md:h-[600px] overflow-hidden">
        <div id="slider" class="relative w-full h-full">
            @forelse ($headerSliders as $index => $slider)
                <img src="{{ $slider->image_url }}" 
                     class="absolute inset-0 w-full h-full object-cover {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-1000" 
                     alt="Slider Image {{ $index + 1 }}" 
                     {{ $index === 0 ? '' : 'loading="lazy"' }} />
            @empty
                <img src="{{ asset('images/default_header.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-100" alt="Default Header" />
            @endforelse
        </div>

        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center p-4">
            <h1 class="text-white text-3xl md:text-5xl font-bold text-center">Selamat Datang di MTs Abadiyah</h1>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('#slider img');
            if (slides.length > 1) {
                let index = 0;
                setInterval(() => {
                    slides[index].classList.remove('opacity-100');
                    slides[index].classList.add('opacity-0');
                    index = (index + 1) % slides.length;
                    slides[index].classList.remove('opacity-0');
                    slides[index].classList.add('opacity-100');
                }, 7000);
            }
        });
    </script>

    <section class="mx-2 my-12 relative">
        <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white text-green-700 p-3 rounded-full shadow-lg hover:bg-opacity-70 transition-all duration-200 hover:outline-none hover:ring-2 hover:ring-green-600 z-10 hidden md:block">
            <i class="fas fa-chevron-left text-2xl"></i>
        </button>
        <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white text-green-700 p-3 rounded-full shadow-lg hover:bg-opacity-70 transition-all duration-200 hover:outline-none hover:ring-2 hover:ring-green-600 z-10 hidden md:block">
            <i class="fas fa-chevron-right text-2xl"></i>
        </button>
        <div class="md:mx-20 my-12 relative">

            <h2 class="text-2xl md:text-3xl font-bold text-emerald-700 text-center mb-12">Berita Terbaru</h2>

            <div id="berita-carousel" class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide scroll-smooth">
                @forelse ($latestBeritas as $berita)
                    <div class="min-w-[300px] max-w-[300px] md:min-w-[400px] md:max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden flex-shrink-0">
                        @if ($berita->header_url)
                            <img src="{{ $berita->header_url }}" class="w-full h-60 object-cover" alt="{{ $berita->judul }}" loading="lazy" />
                        @else
                            <div class="w-full h-60 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                        @endif
                        <div class="p-4">
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-lg md:text-xl font-semibold text-emerald-700 hover:text-emerald-900 transition-colors duration-200">{{ $berita->judul }}</a>
                            <p class="text-sm text-gray-500 mb-2">{{ $berita->user->name ?? 'Admin' }} - {{ $berita->created_at->translatedFormat('d F Y') }}</p>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium mt-3 inline-block">Baca Selengkapnya →</a>
                        </div>
                    </div>
                @empty
                    <div class="min-w-full text-center text-gray-600 py-4">
                        <p>Belum ada berita terbaru.</p>
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center mt-8">
                <a href="{{ route('berita.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">Lihat Semua Berita</a>
            </div>

        </div>
    </section>

    <section class="py-16 px-6 md:px-20 bg-emerald-600 font-[Inter]">
        <h2 class="text-2xl md:text-3xl font-bold text-white text-center mb-12">Program Kelas Unggulan</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
            @forelse ($unggulanProgramKelas as $program)
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
                    <div class="flex items-center space-x-4 mb-4">
                        @if ($program->foto_icon)
                            <img src="{{ $program->foto_icon }}" alt="{{ $program->nama }}" class="w-12 h-12 md:w-16 md:h-16 rounded-full object-cover shadow-md">
                        @else
                            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">No Icon</div>
                        @endif
                        <h3 class="text-base md:text-xl font-semibold text-emerald-700">{{ $program->nama }}</h3>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base">{{ Str::limit($program->deskripsi, 150) }}</p>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-100 py-4">
                    <p>Belum ada program kelas unggulan yang aktif.</p>
                </div>
            @endforelse
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('programkelas') }}" class="bg-white hover:bg-gray-100 text-emerald-600 font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">Lihat Semua Program</a>
        </div>
    </section>

    <section id="kontak" class="bg-white py-12 px-6 md:px-20 font-[Inter]">
        <h2 class="text-2xl md:text-3xl font-bold text-emerald-700 mb-6 text-center">Kontak Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <div class="w-full h-[300px] md:h-[300px]">
                <iframe
                    src="{{ $lembagaSettings->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.4877196304556!2d111.03137207499569!3d-6.8319751931659845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70cc51e034ae9f%3A0xfd1bd804292334e8!2sMTS%20%26%20MA%20Abadiyah!5e0!3m2!1sid!2sid!4v1749872306264!5m2!1sid!2sid'}}"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md"></iframe>
            </div>

            <div class="space-y-6 text-gray-800">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-map-marker-alt text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-base md:text-lg font-semibold text-emerald-700">Alamat</h3>
                        <p class="text-sm md:text-base">{{ $lembagaSettings->alamat ?? 'Jl. Raya Gabus No.123, Gabus, Kab. Pati, Jawa Tengah 59173' }}</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <i class="fas fa-phone text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-base md:text-lg font-semibold text-emerald-700">Telepon</h3>
                        <p class="text-sm md:text-base">{{ $lembagaSettings->no_telepon ?? '+62 812-3456-7890' }}</p>
                    </div>
                </div>

                @if($lembagaSettings->no_fax)
                <div class="flex items-start space-x-3">
                    <i class="fas fa-fax text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-base md:text-lg font-semibold text-emerald-700">Fax</h3>
                        <p class="text-sm md:text-base">{{ $lembagaSettings->no_fax }}</p>
                    </div>
                </div>
                @endif

                <div class="flex items-start space-x-3">
                    <i class="fas fa-envelope text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-base md:text-lg font-semibold text-emerald-700">Email</h3>
                        <p class="text-sm md:text-base">{{ $lembagaSettings->email ?? 'info@mtsabadiyah.sch.id' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('berita-carousel');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            const scrollCarousel = (direction) => {
                const firstCard = carousel.querySelector('div.flex-shrink-0');
                if (!firstCard) return; 

                const scrollAmount = firstCard.offsetWidth + 16;
                if (direction === 'left') {
                    carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                } else {
                    carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            };

            if (carousel && prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => scrollCarousel('left'));
                nextBtn.addEventListener('click', () => scrollCarousel('right'));
            }
        });
    </script>
</body>
</html>