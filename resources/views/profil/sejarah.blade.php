<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $sejarah->judul ?? 'Sejarah Madrasah' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter">

    @include('partials.header')

    <!-- Section Breadcumb -->
    <section class="bg-sky-100 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>&gt;</span>
            <a href="{{ route('profil.sejarah') }}" class="hover:text-emerald-600 font-medium transition-colors duration-200">Profil</a>
            <span>&gt;</span>
            <span class="text-emerald-700 font-semibold">Sejarah</span>
        </div>
    </section>
        
    <section class="mx-4 md:mx-20 mb-10">
        @if ($sejarah) {{-- Cek apakah objek $sejarah ada --}}

            @if ($sejarah->header_image)
                <img src="{{ $sejarah->header_image }}" alt="Gambar Header Sejarah" class="w-full h-64 object-cover rounded-lg shadow-md mb-8">
            @endif

            <h1 class="pb-2 text-3xl font-semibold text-gray-800">{{ $sejarah->judul }}</h1>
            <div class="pb-4">
                <hr class="border-gray-300"> {{-- Menggunakan border-gray-300 untuk warna HR --}}
            </div>

            <div class="prose max-w-none prose-emerald lg:prose-lg text-justify">
                @php
                    $parser = new Parsedown();
                @endphp
                {!! $parser->text($sejarah->isi_konten ?? '') !!} {{-- Ubah Markdown ke HTML --}}
            </div>
        @else
            <div class="text-center text-gray-600 py-10">
                <p class="text-lg">Konten Sejarah belum tersedia. Silakan hubungi administrator.</p>
            </div>
        @endif
    </section>

    @include('partials.footer')

</body>
</html>