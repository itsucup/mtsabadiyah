@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Foto Galeri: {{ $galeriFoto->judul }}</h1>

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
        <form action="{{ route('cms.admin.galeri.foto.update', $galeriFoto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar (Opsional, untuk mengubah):</label>
                @if ($galeriFoto->gambar_url)
                    <div class="mb-2">
                        <img src="{{ $galeriFoto->gambar_url }}" alt="{{ $galeriFoto->judul }}" class="w-32 h-32 object-cover rounded">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>

                        {{-- Checkbox untuk menghapus gambar --}}
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_gambar" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @else
                    <p class="text-xs text-gray-500 mb-1">Belum ada gambar.</p>
                @endif
                <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gambar') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                @error('gambar')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Foto:</label>
                <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror" value="{{ old('judul', $galeriFoto->judul) }}" required>
                @error('judul')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_singkat" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat (Opsional):</label>
                <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi_singkat') border-red-500 @enderror">{{ old('deskripsi_singkat', $galeriFoto->deskripsi_singkat) }}</textarea>
                @error('deskripsi_singkat')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status_aktif" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="status_aktif" id="status_aktif" value="1" class="form-checkbox h-5 w-5 text-emerald-600" {{ old('status_aktif', $galeriFoto->status_aktif) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Aktif (Tampilkan di Publik)</span>
                </label>
                @error('status_aktif')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Perbarui Foto
                </button>
                <a href="{{ route('cms.admin.galeri.foto.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection