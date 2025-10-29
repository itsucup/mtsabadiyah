@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Visi dan
            Misi</h1>

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
                    <label for="gambar_header" class="block text-gray-700 text-sm font-bold mb-2">Gambar Header
                        (Opsional):</label>
                    @if ($visiMisi && $visiMisi->gambar_header)
                        <div class="mb-2">
                            <img src="{{ $visiMisi->gambar_header }}" alt="Gambar Header Visi dan Misi"
                                class="w-48 h-auto object-cover rounded-md">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>

                            {{-- TAMBAHAN: Checkbox untuk menghapus gambar --}}
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="delete_gambar_header" value="1"
                                        class="form-checkbox h-5 w-5 text-red-600">
                                    <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                                </label>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="gambar_header" id="gambar_header"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gambar_header') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Format: JPEG, PNG, JPG,
                        GIF, SVG. Ukuran Max: 2MB. (Lebih baik resolusi 1500x700 pixel)</p>
                    @error('gambar_header')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="visi" class="block text-gray-700 text-sm font-bold mb-2">Isi Visi</label>

                    <div id="toolbar-visi">
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
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                        </span>
                    </div>

                    <div id="editor-visi" style="height: 300px;">
                        {!! old('visi', $visiMisi->visi ?? '') !!}
                    </div>

                    <input type="hidden" name="visi" id="input-visi">

                    @error('visi')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="misi" class="block text-gray-700 text-sm font-bold mb-2">Isi Misi</label>

                    <div id="toolbar-misi">
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
                            <button class="ql-list" value="bullet"></button>
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                        </span>
                    </div>

                    <div id="editor-misi" style="height: 300px;">
                        {!! old('misi', $visiMisi->misi ?? '') !!}
                    </div>

                    <input type="hidden" name="misi" id="input-misi">

                    @error('misi')
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

                // --- DAFTARKAN FONT & SIZE ---
                // (Harus ada di setiap halaman yang menginisialisasi Quill)
                var Font = Quill.import('formats/font');
                var fonts = ['arial', 'sans-serif', 'serif', 'monospace', 'courier-new', 'georgia', 'times-new-roman', 'verdana'];
                Font.whitelist = fonts;
                Quill.register(Font, true);

                var Size = Quill.import('formats/size');
                Size.whitelist = ['small', 'normal', 'large', 'huge', '10px', '14px', '18px', '24px'];
                Quill.register(Size, true);

                // --- INISIALISASI EDITOR VISI ---
                var quillVisi = new Quill('#editor-visi', {
                    theme: 'snow',
                    modules: {
                        toolbar: '#toolbar-visi'
                    },
                    placeholder: 'Tulis visi di sini...',
                });

                var inputVisi = document.getElementById('input-visi');
                if (quillVisi.root.innerHTML.trim() !== '<p><br></p>') {
                    inputVisi.value = quillVisi.root.innerHTML;
                }
                quillVisi.on('text-change', function () {
                    inputVisi.value = quillVisi.root.innerHTML;
                });

                // --- INISIALISASI EDITOR MISI ---
                var quillMisi = new Quill('#editor-misi', {
                    theme: 'snow',
                    modules: {
                        toolbar: '#toolbar-misi'
                    },
                    placeholder: 'Tulis misi di sini...',
                });

                var inputMisi = document.getElementById('input-misi');
                if (quillMisi.root.innerHTML.trim() !== '<p><br></p>') {
                    inputMisi.value = quillMisi.root.innerHTML;
                }
                quillMisi.on('text-change', function () {
                    inputMisi.value = quillMisi.root.innerHTML;
                });

            });
        </script>
    @endpush
@endsection