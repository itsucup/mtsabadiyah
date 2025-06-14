<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>MTs Abadiyah - Galeri Foto</title>
    <style>
        details summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
        details summary { cursor: pointer; }
    </style>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('galeri.foto') }}">Galeri</a> {{-- Link ke halaman utama galeri --}}
            <span>></span>
            <span class="text-emerald-700 font-semibold">Foto</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-8">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Galeri Foto</h1>

        {{-- Form Filter dan Pencarian --}}
        <div class="mb-6 flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4">
            <form action="{{ route('galeri.foto') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                <div class="relative w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}"
                            class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="text-gray-400"></i>
                    </div>
                </div>
                <select name="kategori" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="0">Semua Kategori</option>
                    @foreach($kategoriFotosFilter as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                    Filter
                </button>
                @if(request('kategori'))
                    <a href="{{ route('galeri.foto') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($galeriFotos as $foto)
                <div class="cursor-pointer" onclick="openModal('{{ $foto->gambar_url }}', '{{ $foto->judul }}', '{{ $foto->deskripsi ?? '' }}')"> {{-- Menggunakan $foto->deskripsi --}}
                    <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}" class="rounded-lg shadow-md hover:scale-105 transition duration-300 w-full h-48 object-cover" />
                    <div class="p-2 text-center text-sm text-gray-700 font-semibold line-clamp-1">{{ $foto->judul }}</div>
                    @if($foto->kategoriFoto)
                        <div class="text-center text-xs text-gray-500 mt-1">Kategori: {{ $foto->kategoriFoto->nama }}</div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada foto di galeri yang aktif.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-8 flex justify-center">
            {{ $galeriFotos->appends(request()->query())->links() }} {{-- Menampilkan link paginasi dengan filter --}}
        </div>
    </section>

    {{-- Modal Foto --}}
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-2xl w-[90%] max-h-[90vh] overflow-auto p-4 relative">
            <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 text-2xl font-bold hover:text-red-500 z-10">&times;</button>
            <img id="modalImage" src="" alt="Zoom" class="w-full max-h-[60vh] object-contain rounded mb-4" />
            <h3 id="modalTitle" class="text-lg font-semibold text-emerald-700 mb-1"></h3>
            <p id="modalDesc" class="text-sm text-gray-700"></p>
        </div>
    </div>

    <script>
      function openModal(imageSrc, title, description) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent = description; // Pastikan ini mengambil data deskripsi yang benar
        document.getElementById('modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modalImage').src = '';
        document.getElementById('modalTitle').textContent = '';
        document.getElementById('modalDesc').textContent = '';
        document.body.style.overflow = '';
      }
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !document.getElementById('modal').classList.contains('hidden')) {
          closeModal();
        }
      });
      document.getElementById('modal').addEventListener('click', function(event) {
        if (event.target === this) {
          closeModal();
        }
      });
    </script>

    @include('partials.footer')

</body>
</html>