@extends('layout.app') {{-- Sesuaikan dengan layout CMS Anda --}}

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Halaman Sejarah</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><strong>Terjadi kesalahan:</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        {{-- Tambahkan ID pada form agar bisa diakses oleh JavaScript --}}
        <form id="sejarahForm" action="{{ route('cms.admin.sejarah.store_or_update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Halaman Sejarah:</label>
                <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror" value="{{ old('judul', $sejarah->judul ?? '') }}" required>
                @error('judul')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="header_image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Header (Opsional):</label>
                @if ($sejarah && $sejarah->header_image)
                    <div class="mb-2">
                        <img src="{{ $sejarah->header_image }}" alt="Gambar Header Sejarah" class="w-48 h-auto object-cover rounded-md">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>

                        {{-- TAMBAHAN: Checkbox untuk menghapus gambar --}}
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_header_image" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @endif
                <input type="file" name="header_image" id="header_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('header_image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB. (Lebih baik resolusi 1500x700 pixel)</p>
                @error('header_image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="isi_konten" class="block text-gray-700 text-sm font-bold mb-2">Isi Konten Sejarah (Markdown):</label>
                <textarea name="isi_konten" id="isi_konten" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('isi_konten') border-red-500 @enderror" rows="15">{{ old('isi_konten', $sejarah->isi_konten ?? '') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan Markdown: `*italic*`, `**bold**`, `1. Item Angka`, `- Item Bulat`, `![Deskripsi Gambar](URL_GAMBAR)`</p>
                @error('isi_konten')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection