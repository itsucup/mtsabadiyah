@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Tambah Staff & Guru Baru</h1>

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
        <form action="{{ route('cms.admin.staff_dan_guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- --- DROPDOWN KATEGORI JABATAN --- --}}
            <div class="mb-4">
                <label for="kategori_jabatan_id" class="block text-gray-700 text-sm font-bold mb-2">Jabatan:</label>
                <select name="kategori_jabatan_id" id="kategori_jabatan_id" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori_jabatan_id') border-red-500 @enderror">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($kategoriJabatans as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_jabatan_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_jabatan_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            {{-- --- AKHIR DROPDOWN KATEGORI JABATAN --- --}}

            <div class="mb-4">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto (Opsional):</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF, SVG. Max: 5MB.</p>
                @error('foto')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="status_aktif" id="status_aktif" value="1" class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out" {{ old('status_aktif', true) ? 'checked' : '' }}>
                <label for="status_aktif" class="ml-2 block text-gray-900 text-sm">Aktif (Tampilkan di Publik)</label>
                @error('status_aktif')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('cms.admin.staff_dan_guru.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Staff/Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection