@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Edit Foto Galeri:
            {{ $galeriFoto->judul }}</h1>

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
            <form action="{{ route('cms.admin.galeri.foto.update', $galeriFoto) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar Foto:</label>
                    @if ($galeriFoto->gambar_url)
                        <img src="{{ $galeriFoto->gambar_url }}" alt="Gambar Foto Saat Ini"
                            class="w-32 h-24 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gambar') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Max: 2MB. (Lebih bagus
                        aspek foto 3:2)</p>
                    @error('gambar')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Foto:</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $galeriFoto->judul) }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror">
                    @error('judul')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional):</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $galeriFoto->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- --- KOLOM KATEGORI (DROPDOWN) --- --}}
                <div class="mb-4">
                    <label for="kategori_foto_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                    <select name="kategori_foto_id" id="kategori_foto_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori_foto_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriFotos as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_foto_id', $galeriFoto->kategori_foto_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_foto_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                {{-- --- AKHIR KOLOM KATEGORI --- --}}

                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="status" id="status" value="1" {{ old('status', $galeriFoto->status) ? 'checked' : '' }}
                        class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out">
                    <label for="status" class="ml-2 block text-gray-900 text-sm">Aktif / Publikasikan</label>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Perbarui Foto
                    </button>
                    <a href="{{ route('cms.admin.galeri.foto.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection