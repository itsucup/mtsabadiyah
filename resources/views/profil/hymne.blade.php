<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hymne Abadiyah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>></span>
            <a href="{{ route('profil.hymne') }}" class="hover:text-emerald-600 font-medium transition-colors duration-200">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Hymne</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        @if ($hymne)

            @if ($hymne->video_url)
                <div class="mb-8">
                    @php
                        $embedUrl = $hymne->video_url;
                        // Logika untuk mengubah URL YouTube ke format embed
                        if (str_contains($embedUrl, 'watch?v=')) {
                            $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                            $embedUrl = explode('&', $embedUrl)[0]; // Hapus parameter tambahan
                        } elseif (str_contains($embedUrl, 'youtu.be/')) { // Contoh URL pendek YouTube
                            $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $embedUrl);
                            $embedUrl = explode('?', $embedUrl)[0]; // Hapus parameter tambahan
                        } else {
                            $embedUrl = null; // Set null jika tidak bisa di-embed
                        }
                    @endphp
                    @if ($embedUrl)
                        <div class="relative overflow-hidden rounded-lg shadow-md" style="padding-top: 56.25%"> {{-- 16:9 aspect ratio --}}
                            <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg" role="alert">
                            <p>URL video tidak valid atau tidak dapat disematkan.</p>
                        </div>
                    @endif
                </div>
            @endif

            <h1 class="pb-2 text-3xl font-semibold text-gray-800">Lirik Hymne Abadiyah</h1> {{-- Menambahkan warna teks --}}
            <div class="pb-4">
                <hr class="border-gray-300"> {{-- Menggunakan border-gray-300 untuk warna HR --}}
            </div>

            @if ($hymne->lirik)
                <div class="text-gray-800 leading-relaxed text-justify">
                    {!! nl2br(e($hymne->lirik)) !!}
                </div>
            @else
                <div class="text-center text-gray-600 py-6">
                    <p>Lirik Hymne belum tersedia.</p>
                </div>
            @endif

        @else
            <div class="text-center text-gray-600 py-10">
                <p class="text-lg">Konten Hymne Abadiyah belum tersedia. Silakan hubungi administrator.</p>
            </div>
        @endif
    </section>

    @include('partials.footer')

</body>
</html>