@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Berita</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
        <a href="{{ route('cms.berita.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Berita Baru
        </a>

        {{-- Form Filter dan Pencarian --}}
        <form action="{{ route('cms.berita.index') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
            <div class="relative w-full md:w-auto">
                <input type="text" name="search" placeholder="Cari judul atau konten..." value="{{ request('search') }}"
                       class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            
            <select name="kategori" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                <option value="0">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>

            <select name="status_filter" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status_filter') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status_filter') === '0' ? 'selected' : '' }}>Draft</option>
            </select>

            <select name="uploader" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                <option value="0">Semua Pengupload</option>
                @foreach($uploaders as $uploader)
                    <option value="{{ $uploader->id }}" {{ request('uploader') == $uploader->id ? 'selected' : '' }}>{{ $uploader->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                Filter
            </button>
            @if(request('search') || request('kategori') || request('status_filter') || request('uploader'))
                <a href="{{ route('cms.berita.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
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
                            Foto Header
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Judul Berita
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Pengupload
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($beritas as $berita)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $loop->iteration + ($beritas->currentPage() - 1) * $beritas->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if ($berita->header_url)
                                    <img src="{{ $berita->header_url }}" alt="{{ $berita->judul }}" class="w-16 h-12 object-cover rounded">
                                @else
                                    <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xs">No Img</div>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ Str::limit($berita->judul, 50) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $berita->kategori->nama ?? 'Tidak Berkategori' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    <span aria-hidden class="absolute inset-0 {{ $berita->status ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                    <span class="relative text-{{ $berita->status ? 'green' : 'red' }}-900">{{ $berita->status ? 'Aktif' : 'Draft' }}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $berita->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex flex-col items-center space-y-2">
                                    <a href="{{ route('cms.berita.edit', $berita) }}" class="text-amber-600 hover:text-amber-900 px-3 py-1 rounded-md border border-amber-600 hover:border-amber-900 transition duration-200 w-24 text-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('cms.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" class="w-24">
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
                                Belum ada berita.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $beritas->links() }}
        </div>
    </div>
</div>
@endsection