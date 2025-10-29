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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Staff & Guru</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="#">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Staff & Guru</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-8">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Staff & Guru Kami</h1>

        <div class="mb-6 flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4">
            <form action="{{ route('profil.staffdanguru') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                <div class="relative w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari nama..." value="{{ request('search') }}"
                            class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="text-gray-400"></i>
                    </div>
                </div>
                <select name="kategori_jabatan" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="">Semua Jabatan</option>
                    @foreach($availableKategoriJabatans as $kategori)
                        <option value="{{ $kategori->slug }}" {{ request('kategori_jabatan') == $kategori->slug ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                    Filter
                </button>
                @if(request('kategori_jabatan'))
                    <a href="{{ route('profil.staffdanguru') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div id="staffCardsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($staffs as $staff)
                <div class="flex bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-200 ease-in-out">
                    <img src="{{ !empty($staff->foto) ? $staff->foto : asset('images/default_person.jpg') }}" alt="Foto {{ $staff->nama }}" class="w-40 h-40 object-cover flex-shrink-0">
                    <div class="p-4 flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $staff->nama }}</h3>
                        <p class="text-sm text-gray-700 leading-tight">
                            <span class="font-semibold text-emerald-700">Jabatan:</span> {{ $staff->kategoriJabatan->nama ?? 'Jabatan Tidak Diketahui' }}<br>
                            <span class="font-semibold text-emerald-700">Jenis Kelamin:</span> {{ $staff->jenis_kelamin }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-600 text-lg py-10">Tidak ada data staff atau guru yang ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-8 flex justify-center">
            {{ $staffs->links() }}
        </div>
    </section>

    @include('partials.footer')

</body>
</html>