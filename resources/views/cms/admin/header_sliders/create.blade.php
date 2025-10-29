@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Tambah Slider Baru</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('cms.admin.header_sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Slider:</label>
                    <input type="file" name="image" id="image" accept="image/*" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kolom judul, deskripsi, order, status dihapus --}}
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('cms.admin.header_sliders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Batal
                    </a>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection