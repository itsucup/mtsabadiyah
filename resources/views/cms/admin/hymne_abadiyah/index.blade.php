@extends('layout.app') {{-- Sesuaikan dengan layout CMS Anda --}}

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Hymne
            Abadiyah</h1>

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
            <form action="{{ route('cms.admin.hymne_abadiyah.store_or_update') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="video_url" class="block text-gray-700 text-sm font-bold mb-2">URL Video:</label>
                    <input type="url" name="video_url" id="video_url"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video_url') border-red-500 @enderror"
                        value="{{ old('video_url', $hymne->video_url ?? '') }}"
                        placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxxxxxxx">
                    <p class="text-xs text-gray-500 mt-1">Masukkan URL video YouTube.</p>
                    @error('video_url')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror

                    @if ($hymne && $hymne->video_url)
                        <div class="mt-4">
                            <p class="text-gray-700 text-sm font-bold mb-2">Pratinjau Video:</p>
                            {{-- Contoh menyematkan video YouTube --}}
                            @php
                                $embedUrl = $hymne->video_url;
                                if (str_contains($embedUrl, 'youtube.com/watch?v=')) {
                                    $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                                    $embedUrl = explode('&', $embedUrl)[0]; // Hapus parameter tambahan
                                } elseif (str_contains($embedUrl, 'youtu.be/')) {
                                    $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $embedUrl);
                                    $embedUrl = explode('?', $embedUrl)[0]; // Hapus parameter tambahan
                                }
                                // Anda bisa menambahkan logika untuk platform video lain (misal Google Drive, Vimeo)
                            @endphp

                            @if (str_contains($embedUrl, 'youtube.com/embed/'))

                                <div class="max-w-2xl mx-auto">
                                    <iframe class="w-full aspect-[4/3] rounded-lg shadow-md" src="{{ $embedUrl }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>

                            @else
                                <p class="text-red-500 text-sm">URL video tidak dapat dipratinjau...</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mb-6">
                    <label for="lirik" class="block text-gray-700 text-sm font-bold mb-2">Lirik:</label>

                    <div id="toolbar-hymne">
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-align"></select>
                            <button class="ql-list" value="ordered"></button>
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                        </span>
                    </div>

                    <div id="editor-hymne" style="height: 250px;" class="bg-white border border-gray-300 rounded-b-md">
                        {!! old('lirik', $hymne->lirik ?? '') !!}
                    </div>

                    <input type="hidden" name="lirik" id="input-hymne">

                    @error('lirik')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                var Font = Quill.import('formats/font');
                var fonts = ['arial', 'sans-serif', 'serif', 'monospace', 'courier-new', 'georgia', 'times-new-roman', 'verdana'];
                Font.whitelist = fonts;
                Quill.register(Font, true);

                var Size = Quill.import('formats/size');
                Size.whitelist = ['small', 'normal', 'large', 'huge', '10px', '14px', '18px', '24px'];
                Quill.register(Size, true);

                // --- INISIALISASI EDITOR HYMNE ---
                // (Tambahkan blok baru ini di bawah yang lain)
                var quillHymne = new Quill('#editor-hymne', {
                    theme: 'snow',
                    modules: {
                        toolbar: '#toolbar-hymne'
                    },
                    placeholder: 'Tulis lirik hymne di sini...',
                });

                var inputHymne = document.getElementById('input-hymne');

                // Sinkronisasi Lirik
                if (quillHymne.root.innerHTML.trim() !== '<p><br></p>') {
                    inputHymne.value = quillHymne.root.innerHTML;
                }

                quillHymne.on('text-change', function () {
                    inputHymne.value = quillHymne.root.innerHTML;
                });

            });
        </script>
    @endpush
@endsection