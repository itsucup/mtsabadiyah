@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Galeri Video</h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('cms.admin.galeri.video.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Video Baru
            </a>
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
                                Judul
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Link YouTube
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
                        @forelse ($galeriVideos as $video)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    {{ $loop->iteration + ($galeriVideos->currentPage() - 1) * $galeriVideos->perPage() }}
                                </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $video->judul }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ $video->youtube_link }}" target="_blank" class="text-blue-500 hover:text-blue-700">{{ $video->youtube_link }}</a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span aria-hidden class="absolute inset-0 {{ $video->status_aktif ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                        <span class="relative text-{{ $video->status_aktif ? 'green' : 'red' }}-900">{{ $video->status_aktif ? 'Aktif' : 'Draft' }}</span>
                                    </span>
                                </td>
                                 <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    {{ $video->user->name ?? 'N/A' }} 
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <div class="flex flex-col items-center space-y-2">
                                        <a href="{{ route('cms.admin.galeri.video.edit', $video->id) }}" class="text-amber-600 hover:text-amber-900 px-3 py-1 rounded-md border border-amber-600 hover:border-amber-900 transition duration-200 w-24 text-center">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('cms.admin.galeri.video.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');" class="w-24">
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
                                <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    Belum ada video di galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $galeriVideos->links() }}
            </div>
        </div>
    </div>
@endsection