@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Prestasi Baru</h1>

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
        <form action="{{ route('cms.admin.prestasi.store') }}" method="POST"> {{-- enctype="multipart/form-data" dihapus jika tidak ada upload file --}}
            @csrf

            {{-- BAGIAN INPUT FOTO HEADER DIHAPUS --}}
            {{--
            <div class="mb-4">
                <label for="foto_header" class="block text-gray-700 text-sm font-bold mb-2">Foto Header (Opsional):</label>
                <input type="file" name="foto_header" id="foto_header" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto_header') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar header. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                @error('foto_header')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            --}}

            <div class="mb-4">
                <label for="nama_lengkap_anggota" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Anggota (1-5 orang):</label>
                <textarea name="nama_lengkap_anggota" id="nama_lengkap_anggota" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_lengkap_anggota') border-red-500 @enderror" placeholder="Pisahkan dengan koma atau baris baru jika lebih dari satu">{{ old('nama_lengkap_anggota') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Contoh: Nama Siswa 1, Nama Siswa 2 (untuk grup), atau hanya Nama Siswa.</p>
                @error('nama_lengkap_anggota')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_prestasi" class="block text-gray-700 text-sm font-bold mb-2">Nama Prestasi:</label>
                <input type="text" name="nama_prestasi" id="nama_prestasi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_prestasi') border-red-500 @enderror" value="{{ old('nama_prestasi') }}" required>
                @error('nama_prestasi')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tingkat_prestasi" class="block text-gray-700 text-sm font-bold mb-2">Tingkat Prestasi:</label>
                <div class="relative">
                    <select name="tingkat_prestasi" id="tingkat_prestasi" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline @error('tingkat_prestasi') border-red-500 @enderror" required>
                        <option value="">Pilih Tingkat</option>
                        @foreach ($tingkatPrestasiOptions as $option)
                            <option value="{{ $option }}" {{ old('tingkat_prestasi') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                @error('tingkat_prestasi')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="instansi_penyelenggara" class="block text-gray-700 text-sm font-bold mb-2">Instansi Penyelenggara:</label>
                <input type="text" name="instansi_penyelenggara" id="instansi_penyelenggara" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instansi_penyelenggara') border-red-500 @enderror" value="{{ old('instansi_penyelenggara') }}" required>
                @error('instansi_penyelenggara')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tahun" class="block text-gray-700 text-sm font-bold mb-2">Tahun:</label>
                <input type="number" name="tahun" id="tahun" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tahun') border-red-500 @enderror" value="{{ old('tahun', date('Y')) }}" required min="1900" max="{{ date('Y') + 5 }}">
                @error('tahun')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Prestasi
                </button>
                <a href="{{ route('cms.admin.prestasi.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection