@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Edit Berita: {{ $beritum->judul }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Ada masalah!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('cms.berita.update', $beritum) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting: ini akan membuat request menjadi PUT --}}

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-semibold mb-2">Judul Berita</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $beritum->judul) }}" required
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-gray-700 text-sm font-semibold mb-2">Konten Berita</label>
                <textarea id="konten" name="konten" rows="10" required
                          class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('konten') border-red-500 @enderror">{{ old('konten', $beritum->konten) }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="header_image" class="block text-gray-700 text-sm font-semibold mb-2">Gambar Header (Kosongkan jika tidak ingin diubah)</label>
                <input type="file" id="header_image" name="header_image" accept="image/*"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('header_image') border-red-500 @enderror">
                @error('header_image')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
                @if($beritum->header_url)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Gambar saat ini:</p>
                        <img src="{{ $beritum->header_url }}" alt="Header Berita Saat Ini" class="w-32 h-auto rounded-md object-cover mt-1">
                    </div>
                @endif
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" id="status" name="status" value="1" {{ old('status', $beritum->status) ? 'checked' : '' }}
                       class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out">
                <label for="status" class="ml-2 block text-gray-900 text-sm">Aktif / Publikasikan</label>
                @error('status')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                    Perbarui Berita
                </button>
                <a href="{{ route('cms.berita.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection