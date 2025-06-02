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
    <title>MTs Abadiyah - {{ $berita->judul ?? 'Detail Berita' }}</title>
</head>
<body class="font-inter bg-gray-50">

    @include('partials.header')

    <section class="font-inter bg-sky-100 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="/">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('berita') }}">Berita</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">{{ Str::limit($berita->judul ?? 'Detail', 20) }}</span> {{-- Judul singkat --}}
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-6">
        @if ($berita && $berita->foto_header)
            <img
                src="{{ $berita->foto_header }}"
                class="w-full max-h-[600px] object-cover rounded-lg shadow"
                alt="{{ $berita->judul }}"
            />
        @else
            <div class="w-full max-h-[600px] bg-gray-200 flex items-center justify-center text-gray-500 text-lg rounded-lg shadow">No Image</div>
        @endif
    </section>

    <section class="mx-5 md:mx-20 my-6">
        @if ($berita)
            <h2 class="mb-2 text-3xl font-semibold text-gray-800">{{ $berita->judul }}</h2>
            <div class="mb-4 text-gray-500 text-sm">
                Oleh {{ $berita->user->name ?? 'Anonim' }}, {{ $berita->created_at->translatedFormat('d F Y') }}
                <hr class="mt-4 border-gray-200">
            </div>

            <div class="prose max-w-none prose-emerald lg:prose-lg"> {{-- Gunakan kelas prose untuk styling Markdown --}}
                @php
                    $parser = new Parsedown();
                @endphp
                {!! $parser->text($berita->konten ?? '') !!}
            </div>
        @else
            <div class="text-center text-gray-600 py-10">
                <p class="text-lg">Berita tidak ditemukan.</p>
            </div>
        @endif
    </section>

    @include('partials.footer')

</body>
</html>