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
    <title>MTs Abadiyah - {{ $berita->judul }}</title>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="font-inter bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('berita.index') }}">Berita</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">{{ Str::limit($berita->judul, 30) }}</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 mb-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            @if ($berita->header_url)
                <div class="relative w-full aspect-w-15 aspect-h-7 overflow-hidden rounded-lg shadow-md mb-8">
                    <img src="{{ $berita->header_url }}" alt="Gambar Berita" class="absolute inset-0 w-full h-full object-cover">
                </div>
            @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-2xl rounded-lg mb-6">No Image Available</div>
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-emerald-800 mb-3">{{ $berita->judul }}</h1>
            <p class="text-sm text-gray-500 mb-6">
                Dipublikasikan pada {{ $berita->created_at->translatedFormat('d/m/Y') }} oleh {{ $berita->user->name ?? 'Anonim' }}
                @if($berita->kategori)
                    in <a href="{{ route('berita.index', ['kategori' => $berita->kategori->slug]) }}" class="text-emerald-600 hover:underline">{{ $berita->kategori->nama }}</a>
                @endif
            </p>

            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {{-- Gunakan {!! !!} untuk merender HTML dari konten --}}
                {!! $berita->konten !!}
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>