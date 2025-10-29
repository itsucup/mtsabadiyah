<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} -
        {{ $sambutan->judul ?? 'Sambutan Kepala Sekolah' }}
    </title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
</head>

<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="font-inter bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="{{ route('beranda') }}"
                class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>></span>
            <a href="{{ route('profil.sambutan') }}"
                class="hover:text-emerald-600 font-medium transition-colors duration-200">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Sambutan</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        @if ($sambutan)

            @if ($sambutan->gambar_header)
                <div class="relative w-full aspect-w-15 aspect-h-7 overflow-hidden rounded-lg shadow-md mb-8">
                    <img src="{{ $sambutan->gambar_header }}" alt="Gambar Header Sambutan"
                        class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                </div>
            @endif

            <h1 class="pb-2 text-2xl md:text-3xl font-semibold text-gray-800">
                {{ $sambutan->judul ?? 'Sambutan Kepala Sekolah' }}</h1>
            <div class="pb-4">
                <hr class="border-gray-300">
            </div>

            @if ($sambutan->sambutan_text)
                <div class="text-gray-800 leading-relaxed max-w-none">
                    {!! $sambutan->sambutan_text !!}
                </div>
            @else
                <div class="text-center text-gray-600 py-6">
                    <p>Teks sambutan belum tersedia.</p>
                </div>
            @endif

            <div class="mt-8 text-right">
                <p class="text-lg md:text-xl font-semibold text-gray-800">{{ $sambutan->nama_kepala_sekolah ?? '' }}</p>
                <p class="text-sm md:text-base text-gray-600">{{ $sambutan->jabatan_kepala_sekolah ?? 'Kepala Sekolah' }}
                </p>
            </div>

        @else
            <div class="text-center text-gray-600 py-10">
                <p class="text-lg">Konten Sambutan Kepala Sekolah belum tersedia. Silakan hubungi administrator.</p>
            </div>
        @endif
    </section>

    @include('partials.footer')

</body>

</html>