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
    <title>{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }} - Galeri Foto</title>
    <link rel="icon" href="{{ asset('images/logo_mtsabadiyah.png') }}" type="image/png">
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1 overflow-x-auto whitespace-nowrap">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('galeri.foto') }}">Galeri</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Foto</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 my-8">
        <h1 class="pb-6 text-2xl md:text-3xl font-semibold text-center text-gray-800">Galeri Foto</h1>

        <div class="mb-6 flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4">
            <form action="{{ route('galeri.foto') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center w-full md:w-auto">
                <div class="relative w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}"
                           class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                </div>
                <select name="kategori" class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="0">Semua Kategori</option>
                    @foreach($kategoriFotosFilter as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full md:w-auto bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                    Filter
                </button>
                @if(request('search') || request('kategori')) {{-- Show reset if search OR category is active --}}
                    <a href="{{ route('galeri.foto') }}" class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($galeriFotos as $foto)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition duration-300 overflow-hidden cursor-pointer" onclick="openModal('{{ $foto->gambar_url }}', '{{ $foto->judul }}', '{{ $foto->deskripsi ?? '' }}')">

                    <div class="aspect-w-1 aspect-h-1">
                         <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
                    </div>
                    <div class="p-2 text-center">
                        <div class="text-sm font-semibold text-gray-800 truncate">{{ $foto->judul }}</div> {{-- Use truncate --}}
                        @if($foto->kategoriFoto)
                            <div class="text-xs text-gray-500 mt-1">Kategori: {{ $foto->kategoriFoto->nama }}</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada foto di galeri yang aktif.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-8 flex justify-center">
            {{ $galeriFotos->appends(request()->query())->links() }}
        </div>
    </section>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center p-4 z-50 hidden animate-fade-in">
        <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-hidden flex flex-col relative animate-scale-up">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full p-1 leading-none hover:bg-opacity-75 z-20" aria-label="Close modal">&times;</button>
            <div class="flex-shrink-0 max-h-[70vh] flex items-center justify-center bg-gray-100">
                <img id="modalImage" src="" alt="Zoom" class="max-w-full max-h-[70vh] object-contain rounded-t-lg" />
            </div>
            <div class="p-4 flex-grow overflow-y-auto">
                <h3 id="modalTitle" class="text-lg font-semibold text-emerald-700 mb-1"></h3>
                <p id="modalDesc" class="text-sm text-gray-700"></p>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scale-up { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
        .animate-scale-up { animation: scale-up 0.3s ease-out forwards; }
        #modal button { font-size: 1.5rem; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; }
    </style>

    <script>
      function openModal(imageSrc, title, description) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent = description;
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('animate-fade-in');
        modal.querySelector('.animate-scale-up').classList.add('animate-scale-up');
        document.body.style.overflow = 'hidden';
      }

      function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in');
        modal.querySelector('.animate-scale-up').classList.remove('animate-scale-up');
        setTimeout(() => {
            document.getElementById('modalImage').src = '';
            document.getElementById('modalTitle').textContent = '';
            document.getElementById('modalDesc').textContent = '';
        }, 300);
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