@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Visi dan Misi</h1>

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
        <form action="{{ route('cms.admin.visi_misi.store_or_update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="gambar_header" class="block text-gray-700 text-sm font-bold mb-2">Gambar Header (Opsional):</label>
                @if ($visiMisi && $visiMisi->gambar_header)
                    <div class="mb-2">
                        <img src="{{ $visiMisi->gambar_header }}" alt="Gambar Header Visi dan Misi" class="w-48 h-auto object-cover rounded-md">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        
                        {{-- TAMBAHAN: Checkbox untuk menghapus gambar --}}
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_gambar_header" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @endif
                <input type="file" name="gambar_header" id="gambar_header" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gambar_header') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB. (Lebih baik resolusi 1500x700 pixel)</p>
                @error('gambar_header')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="visi" class="block text-gray-700 text-sm font-bold mb-2">Visi (Markdown):</label>
                <textarea name="visi" id="visi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('visi') border-red-500 @enderror" rows="10">{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan Markdown: `*italic*`, `**bold**`, `1. Item Angka`, `- Item Bulat`, `![Deskripsi Gambar](URL_GAMBAR)`</p>
                @error('visi')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="misi" class="block text-gray-700 text-sm font-bold mb-2">Misi (Markdown):</label>
                <textarea name="misi" id="misi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('misi') border-red-500 @enderror" rows="10">{{ old('misi', $visiMisi->misi ?? '') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan Markdown: `*italic*`, `**bold**`, `1. Item Angka`, `- Item Bulat`, `![Deskripsi Gambar](URL_GAMBAR)`</p>
                @error('misi')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection