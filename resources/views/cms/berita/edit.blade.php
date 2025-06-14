@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Berita: {{ $berita->judul }}</h1>

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
        <form action="{{ route('cms.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Berita:</label>
                <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror" value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="header_image" class="block text-gray-700 text-sm font-bold mb-2">Foto Header (Opsional, untuk mengubah):</label>
                @if ($berita->header_url) {{-- Menggunakan header_url --}}
                    <div class="mb-2">
                        <img src="{{ $berita->header_url }}" alt="{{ $berita->judul }}" class="w-48 h-32 object-cover rounded"> {{-- Menggunakan header_url --}}
                        <p class="text-xs text-gray-500 mt-1">Foto Header saat ini</p>

                        {{-- Checkbox untuk menghapus foto header --}}
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_foto_header" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Foto Header Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @else
                    <p class="text-xs text-gray-500 mb-1">Belum ada foto header.</p>
                @endif
                <input type="file" name="header_image" id="header_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('header_image') border-red-500 @enderror"> {{-- Menggunakan header_image untuk input file --}}
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF. Max: 2MB.</p>
                @error('header_image') {{-- Menggunakan header_image --}}
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- --- KOLOM KATEGORI BARU --- --}}
            <div class="mb-4">
                <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                <select name="kategori_id" id="kategori_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $berita->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            {{-- --- AKHIR KOLOM KATEGORI BARU --- --}}

            <div class="mb-6">
                <label for="konten" class="block text-gray-700 text-sm font-bold mb-2">Isi Berita (Markdown):</label>
                <textarea name="konten" id="konten" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('konten') border-red-500 @enderror" rows="15">{{ old('konten', $berita->konten) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan Markdown untuk format teks: `**bold**`, `- list item`, `1. ordered list`, `![Alt Text](URL_Gambar)`.</p>
                @error('konten')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label> {{-- Menggunakan 'status' --}}
                <label class="inline-flex items-center">
                    <input type="checkbox" name="status" id="status" value="1" class="form-checkbox h-5 w-5 text-emerald-600" {{ old('status', $berita->status) ? 'checked' : '' }}> {{-- Menggunakan 'status' --}}
                    <span class="ml-2 text-gray-700">Aktif (Tampilkan di Publik)</span>
                </label>
                @error('status') {{-- Menggunakan 'status' --}}
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Perbarui Berita
                </button>
                <a href="{{ route('cms.berita.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection