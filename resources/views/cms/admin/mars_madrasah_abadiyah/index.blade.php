@extends('layout.app') {{-- Sesuaikan dengan layout CMS Anda --}}

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Mars Madrasah Abadiyah</h1>

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
        <form action="{{ route('cms.admin.mars_madrasah_abadiyah.store_or_update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="video_url" class="block text-gray-700 text-sm font-bold mb-2">URL Video (Opsional):</label>
                <input type="url" name="video_url" id="video_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video_url') border-red-500 @enderror" value="{{ old('video_url', $mars->video_url ?? '') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxxxx">
                <p class="text-xs text-gray-500 mt-1">Masukkan URL video YouTube, Google Drive, atau lainnya.</p>
                @error('video_url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                @if ($mars && $mars->video_url)
                    <div class="mt-4">
                        <p class="text-gray-700 text-sm font-bold mb-2">Pratinjau Video:</p>
                        @php
                            $embedUrl = $mars->video_url;
                            if (str_contains($embedUrl, 'watch?v=')) {
                                $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                                $embedUrl = explode('&', $embedUrl)[0]; // Hapus parameter tambahan
                            } elseif (str_contains($embedUrl, 'youtu.be/')) {
                                $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $embedUrl);
                                $embedUrl = explode('?', $embedUrl)[0]; // Hapus parameter tambahan
                            } else {
                                $embedUrl = null; // Set null jika tidak bisa di-embed
                            }
                        @endphp
                        @if ($embedUrl)
                            <iframe class="w-full aspect-video rounded-lg shadow-md" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg" role="alert">
                                <p>URL video tidak valid atau tidak dapat dipratinjau (hanya mendukung format YouTube).</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mb-6">
                <label for="lirik" class="block text-gray-700 text-sm font-bold mb-2">Lirik (Opsional):</label>
                <textarea name="lirik" id="lirik" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lirik') border-red-500 @enderror" rows="10">{{ old('lirik', $mars->lirik ?? '') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Anda bisa menggunakan baris baru untuk memisahkan bait.</p>
                @error('lirik')
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