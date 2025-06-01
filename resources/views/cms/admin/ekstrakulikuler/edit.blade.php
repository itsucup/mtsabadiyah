@extends('layout.app') {{-- Sesuaikan dengan layout CMS Anda --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Ekstrakulikuler: {{ $ekstrakulikuler->nama_ekstrakulikuler }}</h1>

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
            @method('PUT') {{-- Penting untuk method PUT --}}

            <div class="mb-4">
                <label for="nama_ekstrakulikuler" class="block text-gray-700 text-sm font-bold mb-2">Nama Ekstrakulikuler:</label>
                <input type="text" name="nama_ekstrakulikuler" id="nama_ekstrakulikuler" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_ekstrakulikuler') border-red-500 @enderror" value="{{ old('nama_ekstrakulikuler', $ekstrakulikuler->nama_ekstrakulikuler) }}" required>
                @error('nama_ekstrakulikuler')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto_ekstrakulikuler" class="block text-gray-700 text-sm font-bold mb-2">Foto Ekstrakulikuler (Opsional):</label>
                @if ($ekstrakulikuler->foto_ekstrakulikuler)
                    <div class="mb-2">
                        <img src="{{ $ekstrakulikuler->foto_ekstrakulikuler }}" alt="Foto {{ $ekstrakulikuler->nama_ekstrakulikuler }}" class="w-24 h-24 object-cover rounded">
                        <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                    </div>
                @endif
                <input type="file" name="foto_ekstrakulikuler" id="foto_ekstrakulikuler" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto_ekstrakulikuler') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih foto baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                @error('foto_ekstrakulikuler')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_singkat" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat (Opsional):</label>
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