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
<body class="font-inter"> {{-- Menambahkan bg-gray-50 untuk konsistensi --}}

    @include('partials.header')

    <section class="relative w-full h-[600px] overflow-hidden">
        <div id="slider" class="relative w-full h-full">
            <img src="{{ asset('images/header1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-100 transition-opacity duration-1000" />
            <img src="{{ asset('images/header2.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000" />
            <img src="{{ asset('images/header3.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000" />
        </div>

        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
            <h1 class="text-white text-3xl md:text-5xl font-bold text-center">Selamat Datang di MTs Abadiyah</h1>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('#slider img');
            let index = 0;

            setInterval(() => {
                slides[index].classList.remove('opacity-100');
                slides[index].classList.add('opacity-0');

                index = (index + 1) % slides.length;

                slides[index].classList.remove('opacity-0');
                slides[index].classList.add('opacity-100');
            }, 7000); // ganti gambar setiap 7 detik
        });
    </script>


    <section class="mx-4 md:mx-20 my-12">
        <h2 class="text-3xl font-bold text-emerald-700 text-center mb-12">Berita Terbaru</h2>

        <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
            @forelse ($latestBeritas as $berita)
                <div class="min-w-[300px] max-w-[300px] md:min-w-[400px] md:max-w-[400px] bg-white shadow-md rounded-lg overflow-hidden flex-shrink-0">
                    @if ($berita->foto_header)
                        <img src="{{ $berita->foto_header }}" class="w-full h-60 object-cover" alt="{{ $berita->judul }}" />
                    @else
                        <div class="w-full h-60 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                    @endif
                    <div class="p-4">
                        <a href="{{ route('detail', $berita->id) }}" class="text-xl font-semibold text-emerald-700 hover:text-emerald-900 transition-colors duration-200">{{ $berita->judul }}</a>
                        <p class="text-sm text-gray-500 mb-2">{{ $berita->user->name ?? 'Admin' }} - {{ $berita->created_at->translatedFormat('d F Y') }}</p>
                        <p class="text-sm text-gray-600 mt-2">{{ Str::limit($berita->konten, 100) }}</p>
                        <a href="{{ route('detail', $berita->id) }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium mt-3 inline-block">Baca Selengkapnya →</a>
                    </div>
                </div>
            @empty
                <div class="min-w-full text-center text-gray-600 py-4">
                    <p>Belum ada berita terbaru.</p>
                </div>
            @endforelse
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('berita') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">Lihat Semua Berita</a>
        </div>
    </section>

    <section class="py-16 px-6 md:px-20 bg-emerald-600 font-[Inter]">
        <h2 class="text-3xl font-bold text-white text-center mb-12">Program Kelas Unggulan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($unggulanProgramKelas as $program)
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
                    <div class="flex items-center space-x-4 mb-4">
                        @if ($program->foto_icon)
                            <img src="{{ $program->foto_icon }}" alt="{{ $program->nama }}" class="w-16 h-16 rounded-full object-cover shadow-md">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">No Icon</div>
                        @endif
                        <h3 class="text-xl font-semibold text-emerald-700">{{ $program->nama }}</h3>
                    </div>
                    <p class="text-gray-600">{{ Str::limit($program->deskripsi, 150) }}</p>
                    <a href="{{ route('programkelas') }}" class="text-emerald-600 hover:text-emerald-900 text-sm font-medium mt-3 inline-block">Baca Selengkapnya →</a>
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
        <h2 class="text-2xl font-bold text-emerald-700 mb-6 text-center">Kontak Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <div class="w-full h-[300px] md:h-[300px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.084774883492!2d110.8712711!3d-6.9174577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70e9a7e8e9e8e9%3A0x8e9e8e9e8e9e8e9e!2sMTs%20Abadiyah%20Gabus!5e0!3m2!1sen!2sid!4v1678901234567!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-md"></iframe>
            </div>

            <div class="space-y-6 text-gray-800">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-map-marker-alt text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-700">Alamat</h3>
                        <p>Jl. Raya Gabus No.123, Gabus, Kab. Pati, Jawa Tengah 59173</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <i class="fas fa-phone text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-700">Telepon</h3>
                        <p>+62 812-3456-7890</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <i class="fas fa-envelope text-emerald-600 text-xl mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-700">Email</h3>
                        <p>info@mtsabadiyah.sch.id</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>