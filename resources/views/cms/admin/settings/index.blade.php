@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Pengaturan Profil Lembaga</h1>

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
        <form action="{{ route('cms.admin.settings.update') }}" method="POST" enctype="multipart/form-data"> {{-- PENTING: Tambahkan enctype --}}
            @csrf
            @method('PUT')

            {{-- --- KOLOM LOGO LEMBAGA BARU --- --}}
            <div class="mb-6">
                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logo Lembaga:</label>
                @if ($settings->logo_url)
                    <div class="mb-2">
                        <img src="{{ $settings->logo_url }}" alt="Logo Lembaga Saat Ini" class="w-32 h-auto object-contain rounded">
                        <p class="text-xs text-gray-500 mt-1">Logo saat ini</p>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_logo" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-sm text-red-700">Hapus Logo Saat Ini</span>
                            </label>
                        </div>
                    </div>
                @else
                    <p class="text-xs text-gray-500 mb-1">Belum ada logo yang diunggah.</p>
                @endif
                <input type="file" name="logo" id="logo" accept="image/*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                @error('logo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_lembaga" class="block text-gray-700 text-sm font-bold mb-2">Nama Lembaga:</label>
                <input type="text" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga', $settings->nama_lembaga) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_lembaga') border-red-500 @enderror">
                @error('nama_lembaga')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_singkat" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat Lembaga:</label>
                <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi_singkat') border-red-500 @enderror">{{ old('deskripsi_singkat', $settings->deskripsi_singkat) }}</textarea>
                @error('deskripsi_singkat')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2" placeholder="hahahahaha">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="3" required
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror">{{ old('alamat', $settings->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="google_maps_url" class="block text-gray-700 text-sm font-bold mb-2">Google Maps:</label>
                <textarea name="google_maps_url" id="google_maps_url" rows="3" required
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror">{{ old('google_maps_url', $settings->google_maps_url) }}</textarea>
                @error('google_maps_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $settings->no_telepon) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_telepon') border-red-500 @enderror">
                @error('no_telepon')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_fax" class="block text-gray-700 text-sm font-bold mb-2">Nomor Fax (Opsional):</label>
                <input type="text" name="no_fax" id="no_fax" value="{{ old('no_fax', $settings->no_fax) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_fax') border-red-500 @enderror">
                @error('no_fax')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $settings->email) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Sosial Media (Opsional)</h3>

            <div class="mb-4">
                <label for="facebook_url" class="block text-gray-700 text-sm font-bold mb-2">Facebook URL:</label>
                <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="http://facebook.com/namapage"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('facebook_url') border-red-500 @enderror">
                @error('facebook_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="instagram_url" class="block text-gray-700 text-sm font-bold mb-2">Instagram URL:</label>
                <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="http://instagram.com/akun"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instagram_url') border-red-500 @enderror">
                @error('instagram_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tiktok_url" class="block text-gray-700 text-sm font-bold mb-2">TikTok URL:</label>
                <input type="url" name="tiktok_url" id="tiktok_url" value="{{ old('tiktok_url', $settings->tiktok_url) }}" placeholder="http://tiktok.com/@akun"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tiktok_url') border-red-500 @enderror">
                @error('tiktok_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="youtube_url" class="block text-gray-700 text-sm font-bold mb-2">YouTube URL:</label>
                <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="http://youtube.com/channel/..."
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('youtube_url') border-red-500 @enderror">
                @error('youtube_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Pengaturan
                </button>
                <a href="{{ route('cms.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection