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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Galeri Video</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="/">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('galeri.video') }}">Galeri</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Video</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-8">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Galeri Video</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($galeriVideos as $video)
                <div class="aspect-video w-full h-48 overflow-hidden rounded-lg shadow-lg">
                    @php
                        $embedUrl = $video->youtube_link;

                        // Logika untuk mengubah URL YouTube ke format embed
                        // Contoh URL tonton: youtu.be/4
                        // Contoh URL share: youtu.be/5
                        // Contoh URL embed: youtube.com/embed/

                        if (str_contains($embedUrl, 'watch?v=')) {
                            // Extract video ID from watch?v= format
                            preg_match('/[\\?&]v=([^&#]*)/', $embedUrl, $matches);
                            if (isset($matches[1])) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                            } else {
                                $embedUrl = null; // Gagal mendapatkan ID video
                            }
                        } elseif (str_contains($embedUrl, 'youtu.be/')) {
                            // Extract video ID from youtu.be/ format
                            preg_match('/youtu.be\\/([^\\?&]*)/', $embedUrl, $matches);
                            if (isset($matches[1])) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                            } else {
                                $embedUrl = null; // Gagal mendapatkan ID video
                            }
                        } elseif (!str_contains($embedUrl, 'youtube.com/embed/')) {
                            // Jika bukan format 'watch?v=', 'youtu.be/', dan bukan juga format 'embed/', set ke null
                            $embedUrl = null;
                        }
                        // Jika sudah dalam format 'embed/', biarkan saja $embedUrl
                    @endphp

                    @if ($embedUrl)
                        <iframe class="w-full h-full"
                            src="{{ $embedUrl }}"
                            title="{{ $video->judul }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    @else
                        {{-- Tampilkan placeholder atau pesan error jika URL tidak valid --}}
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-center p-4">
                            <p>Link video tidak valid atau tidak dapat disematkan.<br>Judul: {{ $video->judul }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada video di galeri yang aktif.</p>
                </div>
            @endforelse
        </div>
    </section>

    @include('partials.footer')

</body>
</html>