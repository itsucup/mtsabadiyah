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
        /* Hilangkan panah default dari <details> - jika masih ada gaya ini, asalnya dari tempat lain */
        details summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
        details summary { cursor: pointer; }
    </style>
</head>
<body class="font-inter bg-gray-50"> {{-- Tambahkan bg-gray-50 untuk konsistensi --}}

    @include('partials.header')

    <section class="bg-sky-100 mx-5 md:mx-20 my-4 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="/">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('galeri.foto') }}">Galeri</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Foto</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-8">
        <h2 class="text-2xl font-bold text-emerald-600 mb-4">Galeri Foto</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @forelse ($galeriFotos as $foto)
                <div class="cursor-pointer" onclick="openModal('{{ $foto->gambar_url }}', '{{ $foto->judul }}', '{{ $foto->deskripsi_singkat }}')">
                    <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}" class="rounded-lg shadow-md hover:scale-105 transition duration-300 w-full h-48 object-cover" />
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada foto di galeri yang aktif.</p>
                </div>
            @endforelse
        </div>
    </section>

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
        document.getElementById('modalDesc').textContent = description;
        document.getElementById('modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Nonaktifkan scroll body
      }

      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modalImage').src = '';
        document.getElementById('modalTitle').textContent = '';
        document.getElementById('modalDesc').textContent = '';
        document.body.style.overflow = ''; // Aktifkan kembali scroll body
      }
      // Menutup modal dengan menekan tombol ESC
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !document.getElementById('modal').classList.contains('hidden')) {
          closeModal();
        }
      });
      // Menutup modal dengan klik di luar modal
      document.getElementById('modal').addEventListener('click', function(event) {
        if (event.target === this) { // Hanya jika klik langsung pada overlay modal, bukan isinya
          closeModal();
        }
      });
    </script>

    @include('partials.footer')

</body>
</html>