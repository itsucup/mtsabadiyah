@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Prestasi</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error')) {{-- Tambahkan pesan error juga jika ada --}}
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
        <a href="{{ route('cms.admin.prestasi.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data Baru
        </a>

        {{-- Form Filter dan Pencarian --}}
        <form action="{{ route('cms.admin.prestasi.index') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
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
                <a href="{{ route('cms.admin.prestasi.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Lengkap Anggota
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Prestasi
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tingkat
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Instansi
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tahun
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestasis as $prestasi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $loop->iteration + ($prestasis->currentPage() - 1) * $prestasis->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ Str::limit($prestasi->nama_lengkap_anggota, 50) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ Str::limit($prestasi->nama_prestasi, 50) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $prestasi->tingkat_prestasi }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ Str::limit($prestasi->instansi_penyelenggara, 50) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $prestasi->tahun }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex flex-col items-center space-y-2">
                                    <a href="{{ route('cms.admin.prestasi.edit', $prestasi) }}" class="text-amber-600 hover:text-amber-900 px-3 py-1 rounded-md border border-amber-600 hover:border-amber-900 transition duration-200 w-24 text-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('cms.admin.prestasi.destroy', $prestasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');" class="w-24">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md border border-red-600 hover:border-red-900 transition duration-200 w-full text-center">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Belum ada data prestasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $prestasis->appends(request()->query())->links() }} {{-- Menampilkan link paginasi dengan filter --}}
        </div>
    </div>
</div>
@endsection