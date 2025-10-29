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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Prestasi</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24 bg-gray-50">

    @include('partials.header')

    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1 overflow-x-auto whitespace-nowrap">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Prestasi</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 my-6">
        <div>
            <h2 class="mb-2 text-2xl md:text-3xl font-semibold text-gray-800">Data Prestasi</h2>
            <hr class="my-4 border-gray-200">

            <div class="mb-6 flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4">
                 <form action="{{ route('prestasi') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                    <div class="relative w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari nama/prestasi/instansi..." value="{{ request('search') }}"
                               class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    </div>
                    <select name="tahun" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        <option value="">Semua Tahun</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full md:w-auto bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                        Filter
                    </button>
                    @if(request('search') || request('tahun'))
                        <a href="{{ route('prestasi') }}" class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
                <table class="min-w-full text-left whitespace-nowrap">
                    <thead class="bg-emerald-600 text-white text-xs uppercase font-semibold">
                         <tr>
                            <th class="px-3 py-2 text-center border-r border-emerald-700">No</th>
                            <th class="px-3 py-2 text-left border-r border-emerald-700">Nama Lengkap</th>
                            <th class="px-3 py-2 text-left border-r border-emerald-700">Nama Prestasi</th>
                            <th class="px-3 py-2 text-left border-r border-emerald-700">Tingkat</th>
                            <th class="px-3 py-2 text-left border-r border-emerald-700">Instansi</th>
                            <th class="px-3 py-2 text-center">Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-xs sm:text-sm">
                        @forelse ($prestasis as $prestasi)
                            <tr class="hover:bg-gray-50 border-b border-gray-200 last:border-b-0">
                                <td class="px-3 py-2 border-r border-gray-200 text-center">{{ $loop->iteration + ($prestasis->currentPage() - 1) * $prestasis->perPage() }}</td>
                                <td class="px-3 py-2 border-r border-gray-200">{{ $prestasi->nama_lengkap_anggota }}</td>
                                <td class="px-3 py-2 border-r border-gray-200">{{ $prestasi->nama_prestasi }}</td>
                                <td class="px-3 py-2 border-r border-gray-200">{{ $prestasi->tingkat_prestasi }}</td>
                                <td class="px-3 py-2 border-r border-gray-200">{{ $prestasi->instansi_penyelenggara }}</td>
                                <td class="px-3 py-2 text-center">{{ $prestasi->tahun }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-600">Belum ada data prestasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $prestasis->appends(request()->query())->links() }}
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>