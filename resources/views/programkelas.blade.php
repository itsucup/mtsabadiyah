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
    <title>Program Kelas</title>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="{{ route('beranda') }}" class="hover:text-emerald-600 font-medium">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Program Kelas</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 my-10">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Program Kelas</h1>

        <div class="space-y-4">
            @forelse ($programKelas as $program)
                <details class="bg-white shadow rounded overflow-hidden">
                    <summary class="flex items-center px-6 py-4 cursor-pointer hover:bg-emerald-50 space-x-4">
                        <span class="text-lg font-semibold">{{ $program->nama }}</span>
                    </summary>
                    <div class="px-6 py-4 border-t text-gray-600">
                        @if ($program->foto_icon)
                            {{-- Membungkus gambar dengan div flex dan justify-center --}}
                            <div class="flex justify-center mb-4"> {{-- mb-4 untuk margin bawah --}}
                                <img src="{{ $program->foto_icon }}" alt="{{ $program->nama }}" class="w-60 h-60 object-cover rounded-lg shadow-md">
                            </div>
                        @endif
                        <p>{{ $program->deskripsi }}</p> {{-- Bungkus deskripsi dalam tag <p> --}}
                    </div>
                </details>
            @empty
                <div class="text-center py-8 text-gray-600">
                    <p>Belum ada program kelas yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    @include('partials.footer')

</body>
</html>