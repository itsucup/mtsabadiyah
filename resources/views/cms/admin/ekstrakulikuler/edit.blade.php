@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Ekstrakulikuler: {{ $ekstrakulikuler->nama }}</h1>

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
        <form action="{{ route('cms.admin.ekstrakulikuler.update', $ekstrakulikuler->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Ekstrakulikuler:</label>
                <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror" value="{{ old('nama', $ekstrakulikuler->nama) }}" required>
                @error('nama')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto_icon" class="block text-gray-700 text-sm font-bold mb-2">Foto/Ikon Ekstrakulikuler:</label>
                @if ($ekstrakulikuler->foto_icon)
                    <div class="mb-2">
                        <img src="{{ $ekstrakulikuler->foto_icon }}" alt="{{ $ekstrakulikuler->nama }}" class="w-24 h-24 object-contain rounded">
                        <p class="text-xs text-gray-500 mt-1">Foto/Ikon saat ini</p>

                        {{-- Checkbox untuk menghapus foto/ikon --}}
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_foto_icon" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Foto/Ikon Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @endif
                <input type="file" name="foto_icon" id="foto_icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto_icon') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar/ikon baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB. Resolusi 1:1</p>
                @error('foto_icon')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_singkat" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat:</label>
                <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi_singkat') border-red-500 @enderror">{{ old('deskripsi_singkat', $ekstrakulikuler->deskripsi_singkat) }}</textarea>
                @error('deskripsi_singkat')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status_aktif" class="block text-gray-700 text-sm font-bold mb-2">Status Aktif:</label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="status_aktif" id="status_aktif" value="1" class="form-checkbox h-5 w-5 text-emerald-600" {{ old('status_aktif', $ekstrakulikuler->status_aktif) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Aktif</span>
                </label>
                @error('status_aktif')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Perbarui
                </button>
                <a href="{{ route('cms.admin.ekstrakulikuler.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection