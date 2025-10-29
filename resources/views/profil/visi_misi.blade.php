<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Visi dan Misi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>></span>
            <a href="{{ route('profil.visi_misi') }}"
                class="hover:text-emerald-600 font-medium transition-colors duration-200">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Visi & Misi</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        @if ($visiMisi)
            @if ($visiMisi->gambar_header)
                <div class="relative w-full aspect-w-15 aspect-h-7 overflow-hidden rounded-lg shadow-md mb-8">
                    <img src="{{ $visiMisi->gambar_header }}" alt="Gambar Header Visi dan Misi"
                        class="absolute inset-0 w-full h-full object-cover">
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-6 text-gray-800 leading-relaxed text-justify mb-8">
                <h2 class="text-2xl font-semibold border-l-4 border-emerald-500 pl-1 mb-4">Visi</h2>
                <div class="prose max-w-none prose-emerald lg:prose-lg">
                    @php
                        $parser = new Parsedown();
                    @endphp
                    {!! $parser->text($visiMisi->visi ?? '') !!}
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 text-gray-800 leading-relaxed text-justify">
                <h2 class="text-2xl font-semibold border-l-4 border-emerald-500 pl-1 mb-4">Misi</h2>
                <div class="prose max-w-none prose-emerald lg:prose-lg">
                    @php
                        $parser = new Parsedown();
                    @endphp
                    {!! $parser->text($visiMisi->misi ?? '') !!}
                </div>
            </div>

        @else
            <div class="text-center text-gray-600 py-10">
                <p class="text-lg">Konten Visi dan Misi belum tersedia. Silakan hubungi administrator.</p>
            </div>
        @endif
    </section>

    @include('partials.footer')

</body>

</html>