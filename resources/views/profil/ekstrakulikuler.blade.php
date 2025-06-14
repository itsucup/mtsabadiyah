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
    <title>Ekstrakulikuler</title>
    <style>
        details summary::-webkit-details-marker {
            display: none;
        }
        summary {
            list-style: none;
        }
        details summary {
            cursor: pointer;
        }
    </style>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>></span>
            <a href="{{ route('profil.ekstrakulikuler') }}" class="hover:text-emerald-600 font-medium transition-colors duration-200">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Ekstrakulikuler</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 my-10">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Ekstrakulikuler</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @forelse ($ekstrakulikulers as $ekstra)
                <details class="bg-white rounded-xl shadow hover:shadow-md transition group cursor-pointer overflow-hidden">
                    <summary class="p-4">
                        <div class="flex flex-col items-center text-center">
                            @if ($ekstra->foto_icon)
                                <img src="{{ $ekstra->foto_icon }}" alt="{{ $ekstra->nama }}" class="w-16 h-16 mb-3 object-contain rounded" />
                            @else
                                <div class="w-16 h-16 mb-3 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-xs">No Icon</div>
                            @endif
                            <h3 class="font-semibold text-lg text-gray-800">{{ $ekstra->nama }}</h3>
                        </div>
                    </summary>
                    <div class="px-4 pb-4 text-sm text-gray-600">
                        {{ $ekstra->deskripsi_singkat }}
                    </div>
                </details>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada ekstrakulikuler yang aktif.</p>
                </div>
            @endforelse

        </div>
    </section>

    @include('partials.footer')

</body>
</html>