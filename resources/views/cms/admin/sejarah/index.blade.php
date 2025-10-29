@extends('layout.app') {{-- Sesuaikan dengan layout CMS Anda --}}

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Halaman
            Sejarah</h1>

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
            {{-- Tambahkan ID pada form agar bisa diakses oleh JavaScript --}}
            <form id="sejarahForm" action="{{ route('cms.admin.sejarah.store_or_update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Halaman Sejarah:</label>
                    <input type="text" name="judul" id="judul"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
                        value="{{ old('judul', $sejarah->judul ?? '') }}" required>
                    @error('judul')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="header_image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Header
                        (Opsional):</label>
                    @if ($sejarah && $sejarah->header_image)
                        <div class="mb-2">
                            <img src="{{ $sejarah->header_image }}" alt="Gambar Header Sejarah"
                                class="w-48 h-auto object-cover rounded-md">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>

                            {{-- TAMBAHAN: Checkbox untuk menghapus gambar --}}
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="delete_header_image" value="1"
                                        class="form-checkbox h-5 w-5 text-red-600">
                                    <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                                </label>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="header_image" id="header_image"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('header_image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG,
                        GIF, SVG. Ukuran Max: 2MB. (Lebih baik resolusi 1500x700 pixel)</p>
                    @error('header_image')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="isi_konten" class="block text-gray-700 text-sm font-bold mb-2">Isi Konten Sejarah:</label>

                    <div id="toolbar-sejarah">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-align"></select>
                            <button class="ql-list" value="ordered"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color"></select>
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>
                    </div>

                    <div id="editor-sejarah" style="height: 400px;" class="bg-white border border-gray-300 rounded-b-md">
                        {!! old('isi_konten', $sejarah->isi_konten ?? '') !!}
                    </div>

                    <input type="hidden" name="isi_konten" id="input-sejarah">

                    @error('isi_konten')
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

                // --- INISIALISASI EDITOR SEJARAH ---
                // (Tambahkan blok baru ini di bawah yang lain)
                var quillSejarah = new Quill('#editor-sejarah', {
                    theme: 'snow',
                    modules: {
                        toolbar: {
                            container: '#toolbar-sejarah'
                        }
                    },
                    placeholder: 'Tulis isi sejarah di sini...',
                });

                var inputSejarah = document.getElementById('input-sejarah');

                // Sinkronisasi Sejarah
                if (quillSejarah.root.innerHTML.trim() !== '<p><br></p>') {
                    inputSejarah.value = quillSejarah.root.innerHTML;
                }

                quillSejarah.on('text-change', function () {
                    inputSejarah.value = quillSejarah.root.innerHTML;
                });

            });
        </script>
    @endpush

@endsection