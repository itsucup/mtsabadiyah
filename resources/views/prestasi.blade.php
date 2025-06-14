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
    <title>MTs Abadiyah - Prestasi</title>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Prestasi</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-6">
        <div>
            <h2 class="mb-2 text-3xl font-semibold text-gray-800">Data Prestasi</h2>
            <hr class="my-4 border-gray-200">

            {{-- Form Filter dan Pencarian --}}
            <div class="mb-6 flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4">
                <form action="{{ route('prestasi') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                    <div class="relative w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari nama/prestasi/instansi..." value="{{ request('search') }}"
                               class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="text-gray-400"></i>
                        </div>
                    </div>
                    
                    <select name="tahun" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        <option value="">Semua Tahun</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                        Filter
                    </button>
                    @if(request('search') || request('tahun'))
                        <a href="{{ route('prestasi') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-emerald-600 text-white">
                        <tr>
                            <th class="px-4 py-2 border-r text-center">No</th>
                            <th class="px-4 py-2 border-r text-center">Nama Lengkap</th>
                            <th class="px-4 py-2 border-r text-center">Nama Prestasi</th>
                            <th class="px-4 py-2 border-r text-center">Tingkat Prestasi</th>
                            <th class="px-4 py-2 border-r text-center">Instansi Penyelenggara</th>
                            <th class="px-4 py-2 text-center">Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($prestasis as $prestasi)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border-t border-r text-center">{{ $loop->iteration + ($prestasis->currentPage() - 1) * $prestasis->perPage() }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->nama_lengkap_anggota }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->nama_prestasi }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->tingkat_prestasi }}</td>
                                <td class="px-4 py-2 border-t border-r">{{ $prestasi->instansi_penyelenggara }}</td>
                                <td class="px-4 py-2 border-t text-center">{{ $prestasi->tahun }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 border-t text-center text-gray-600">Belum ada data prestasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 p-4">
                {{ $prestasis->appends(request()->query())->links() }} {{-- Menampilkan link paginasi --}}
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>