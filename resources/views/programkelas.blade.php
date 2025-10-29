<!DOCTYPE html>
<html lang="en">
<head>
    {{-- ... (head content remains the same) ... --}}
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Program Kelas</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    {{-- Breadcrumb --}}
    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        {{-- ... (breadcrumb content remains the same) ... --}}
        <div class="flex items-center text-sm text-slate-500 space-x-1 overflow-x-auto whitespace-nowrap">
            <a href="{{ route('beranda') }}" class="hover:text-emerald-600 font-medium">Home</a>
            <span>&gt;</span>
            <span class="text-emerald-700 font-semibold">Program Kelas</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 my-10">
        <h1 class="pb-6 text-2xl md:text-3xl font-semibold text-center text-gray-800">Program Kelas</h1>

        <div class="space-y-6">
            @forelse ($programKelas as $program)
                <details class="bg-white shadow-md rounded-lg overflow-hidden group">
                    <summary class="flex items-center justify-between px-4 py-4 md:px-6 md:py-4 cursor-pointer hover:bg-emerald-50 transition duration-150 ease-in-out">
                        {{-- ... (summary content remains the same) ... --}}
                        <span class="text-base md:text-lg font-semibold text-emerald-800">{{ $program->nama }}</span>
                        <svg class="w-5 h-5 text-emerald-600 transform transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </summary>

                    {{-- 
                    =================================================
                    REVISI UTAMA DI SINI (Struktur Konten Details)
                    =================================================
                    - Parent div now explicitly uses flex and flex-wrap for responsiveness.
                    - Children (image and text) have clear width definitions for mobile and desktop.
                    =================================================
                    --}}
                    <div class="px-4 py-4 md:px-6 md:py-6 border-t border-gray-200">
                        {{-- Added flex-wrap and items-start for better alignment --}}
                        <div class="flex flex-wrap md:flex-nowrap md:space-x-6 items-start"> 
                            
                            @if ($program->foto_icon)
                                {{-- Image Container: Full width on mobile, 1/3 on desktop --}}
                                <div class="w-full md:w-1/3 flex-shrink-0 mb-4 md:mb-0"> 
                                    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg shadow-md">
                                         <img src="{{ $program->foto_icon }}" alt="{{ $program->nama }}" class="w-full h-full object-cover" loading="lazy">
                                    </div>
                                </div>
                            @endif

                            {{-- Text Container: Full width on mobile, remaining width on desktop --}}
                            {{-- Added min-w-0 to prevent potential flex overflow issues with prose --}}
                            <div class="prose prose-sm sm:prose-base max-w-none text-gray-700 leading-relaxed w-full {{ $program->foto_icon ? 'md:w-2/3' : '' }} min-w-0"> 
                                {!! $program->deskripsi !!}
                            </div>
                        </div>
                    </div>
                    {{-- =============================================== --}}
                    {{-- AKHIR REVISI --}}
                    {{-- =============================================== --}}

                </details>
            @empty
                {{-- ... (empty state remains the same) ... --}}
                 <div class="text-center py-8 text-gray-600 bg-white shadow rounded-lg">
                    <p>Belum ada program kelas yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    @include('partials.footer')
 
    {{-- Optional JS if you want only one <details> open at a time --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const detailsElements = document.querySelectorAll('section details');
            detailsElements.forEach(details => {
                details.addEventListener('toggle', event => {
                    if (details.open) {
                        detailsElements.forEach(otherDetails => {
                            if (otherDetails !== details && otherDetails.open) {
                                otherDetails.removeAttribute('open');
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>