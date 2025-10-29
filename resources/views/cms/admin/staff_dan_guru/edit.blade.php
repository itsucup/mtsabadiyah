@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Edit Staff & Guru: {{ $staffDanGuru->nama }}</h1>

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
        <form action="{{ route('cms.admin.staff_dan_guru.update', $staffDanGuru) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $staffDanGuru->nama) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_jabatan_id" class="block text-gray-700 text-sm font-bold mb-2">Jabatan:</label>
                <select name="kategori_jabatan_id" id="kategori_jabatan_id" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori_jabatan_id') border-red-500 @enderror">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($kategoriJabatans as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_jabatan_id', $staffDanGuru->kategori_jabatan_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_jabatan_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin:</label>
                <div class="relative">
                    <select name="jenis_kelamin" id="jenis_kelamin" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline @error('jenis_kelamin') border-red-500 @enderror" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        @foreach ($jenisKelaminOptions as $option)
                            <option value="{{ $option }}" {{ old('jenis_kelamin', $staffDanGuru->jenis_kelamin) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto (Opsional, untuk mengubah):</label>
                @if ($staffDanGuru->foto)
                    <img src="{{ $staffDanGuru->foto }}" alt="{{ $staffDanGuru->nama }}" class="w-32 h-32 object-cover rounded-full mb-2">
                @endif
                <input type="file" name="foto" id="foto" accept="image/*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Ukuran Max: 2MB. Resolusi 1:1</p>
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

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="status_aktif" id="status_aktif" value="1" class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out" {{ old('status_aktif', $staffDanGuru->status_aktif) ? 'checked' : '' }}>
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection