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
    <title>MTs Abadiyah - Staff dan Guru</title>
</head>
<body class="font-inter bg-gray-50">

    @include('partials.header')

    <section class="bg-sky-100 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>&gt;</span>
            <span class="text-emerald-700 font-semibold">Staff dan Guru</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Staff dan Guru</h1>

        <div class="mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto">
                <label for="positionFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter Berdasarkan Jabatan:</label>
                <div class="relative">
                    {{-- Form untuk filter jabatan --}}
                    <form id="filterForm" action="{{ route('profil.staffdanguru') }}" method="GET">
                        <select name="position" id="positionFilter" onchange="document.getElementById('filterForm').submit()" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-emerald-500 shadow-sm">
                            <option value="all">Semua Jabatan</option>
                            @foreach ($uniquePositions as $position)
                                <option value="{{ $position }}" {{ $selectedPosition == $position ? 'selected' : '' }}>{{ $position }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Staff Cards Container --}}
        <div id="staffCardsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($staffs as $staff)
                <div class="flex bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-200 ease-in-out">
                    <img src="{{ $staff->foto ?: 'https://via.placeholder.com/160x160?text=No+Foto' }}" alt="Foto {{ $staff->nama }}" class="w-40 h-40 object-cover flex-shrink-0">
                    <div class="p-4 flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $staff->nama }}</h3>
                        <p class="text-sm text-gray-700 leading-tight">
                            <span class="font-semibold text-emerald-700">Jabatan:</span> {{ $staff->jabatan }}<br>
                            <span class="font-semibold text-emerald-700">Jenis Kelamin:</span> {{ $staff->jenis_kelamin }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-600 text-lg py-10">Tidak ada data staff atau guru yang ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination Controls (Laravel's built-in pagination links) --}}
        <div class="mt-10">
            {{ $staffs->links() }}
        </div>
    </section>

    @include('partials.footer')

    {{-- Hapus semua kode JavaScript yang sebelumnya ada di sini untuk filter dan paginasi --}}
    <script>
        // Pastikan tidak ada kode JS filter/paginasi lama yang tersisa di sini
        // Karena sekarang semua dihandle oleh PHP/Laravel
    </script>
</body>
</html>