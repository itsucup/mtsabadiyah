@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Edit Sarana & Prasarana: {{ $saranaPrasarana->nama }}</h1>

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
        <form action="{{ route('cms.admin.sarana_prasarana.update', $saranaPrasarana) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Sarana/Prasarana:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $saranaPrasarana->nama) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto (Opsional, untuk mengubah):</label>
                @if ($saranaPrasarana->foto_url)
                    <img src="{{ $saranaPrasarana->foto_url }}" alt="{{ $saranaPrasarana->nama }}" class="w-32 h-24 object-cover rounded mb-2">
                @endif
                <input type="file" name="foto" id="foto" accept="image/*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Ukuran Max: 2MB.</p>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="delete_foto" value="1" class="form-checkbox h-5 w-5 text-red-600">
                        <span class="ml-2 text-sm text-red-700">Hapus Foto</span>
                    </label>
                </div>
                @error('foto')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $saranaPrasarana->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="status" id="status" value="1" class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out" {{ old('status', $saranaPrasarana->status) ? 'checked' : '' }}>
                <label for="status" class="ml-2 block text-gray-900 text-sm">Aktif (Tampilkan di Publik)</label>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('cms.admin.sarana_prasarana.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection