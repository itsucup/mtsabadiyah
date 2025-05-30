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
    <title>MTs Abadiyah</title>
</head>
<body class="font-inter">

  @include('partials.header')

      <!-- Section Breadcumb -->
    <section class="bg-sky-100 mx-5 md:mx-20 my-4 p-4 rounded">
      <div class="">
        <a class="text-slate-500" href="/">Home</a>
        >
        <a class="text-slate-500" href="/galeri">Galeri</a>
        >
        <span class="text-emerald-700 font-semibold">Karya</span>
      </div>
    </section>

    <!-- Section Galeri -->
    <section class="mx-5 md:mx-20 my-8">
      <h2 class="text-2xl font-bold text-emerald-600 mb-4">Galeri Karya</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Gambar -->
        <div class="cursor-pointer" onclick="openModal('https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg', 'Judul Foto 1', 'Deskripsi singkat dari foto pertama.')">
          <img src="https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg" alt="Foto 1" class="rounded-lg shadow-md hover:scale-105 transition duration-300 w-full h-48 object-cover" />
        </div>

        <div class="cursor-pointer" onclick="openModal('https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg', 'Judul Foto 2', 'Deskripsi foto kedua, misalnya kegiatan belajar.')">
          <img src="https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg" alt="Foto 2" class="rounded-lg shadow-md hover:scale-105 transition duration-300 w-full h-48 object-cover" />
        </div>

        <div class="cursor-pointer" onclick="openModal('https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg', 'Judul Foto 3', 'Deskripsi foto kedua, misalnya kegiatan belajar.')">
          <img src="https://www.dbl.id/thumbs/extra-large/uploads/post/2023/11/27/efrael%20yerusyalom%20enrichia%20dbl%20jakarta%202023%20indonesia%20arena%203.jpg" alt="Foto 3" class="rounded-lg shadow-md hover:scale-105 transition duration-300 w-full h-48 object-cover" />
        </div>

      </div>
    </section>

    <!-- Modal Zoom Gambar -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-2xl w-[90%] max-h-[90vh] overflow-auto p-4 relative">
            <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 text-2xl font-bold hover:text-red-500 z-10">&times;</button>
            <img id="modalImage" src="" alt="Zoom" class="w-full max-h-[60vh] object-contain rounded mb-4" />
            <h3 id="modalTitle" class="text-lg font-semibold text-emerald-700 mb-1"></h3>
            <p id="modalDesc" class="text-sm text-gray-700"></p>
        </div>
    </div>

    <!-- Script Modal -->
    <script>
      function openModal(imageSrc, title, description) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent = description;
        document.getElementById('modal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modalImage').src = '';
        document.getElementById('modalTitle').textContent = '';
        document.getElementById('modalDesc').textContent = '';
      }
    </script>

  @include('partials.footer')

</body>
</html>