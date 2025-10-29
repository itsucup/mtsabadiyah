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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - {{ $berita->judul }}</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24 bg-gray-50">

    @include('partials.header')

    <section class="font-inter bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1 overflow-x-auto whitespace-nowrap">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('berita.index') }}">Berita</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">{{ Str::limit($berita->judul, 100) }}</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-4 md:p-6 lg:p-8">
            
            @if ($berita->header_url)
                <div class="relative w-full aspect-w-16 aspect-h-9 overflow-hidden rounded-lg shadow-md mb-6 md:mb-8">
                    <img src="{{ $berita->header_url }}" alt="Gambar Berita" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                </div>
            @else
                <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center text-gray-500 text-xl md:text-2xl rounded-lg mb-6 md:mb-8">No Image Available</div>
            @endif

            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-emerald-800 mb-2 md:mb-3">{{ $berita->judul }}</h1>
            
            <p class="text-xs md:text-sm text-gray-500 mb-4 md:mb-6">
                Dipublikasikan pada {{ $berita->created_at->translatedFormat('d F Y') }} oleh {{ $berita->user->name ?? 'Anonim' }}
                @if($berita->kategori)
                    in <a href="{{ route('berita.index', ['kategori' => $berita->kategori->slug]) }}" class="text-emerald-600 hover:underline">{{ $berita->kategori->nama }}</a>
                @endif
            </p>

            <div class="prose prose-sm sm:prose-base max-w-none text-gray-700 leading-relaxed">
                {!! $berita->konten !!}
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center text-sm md:text-base text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>