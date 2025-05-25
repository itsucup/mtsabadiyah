<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - MTs Abadiyah</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-inter">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-emerald-700 text-white flex flex-col py-6 px-4 shadow-lg">
      <div class="mb-10 flex items-center space-x-3">
        <img src="https://mtsabadiyah.sch.id/uploads/logo.png" class="w-10 h-10" alt="Logo" />
        <span class="text-xl font-semibold">MTs Abadiyah</span>
      </div>

      <nav class="flex-1 space-y-3">
        <a href="" class="block py-2 px-4 rounded-lg hover:bg-emerald-600 transition">Dashboard</a>
        <a href="" class="block py-2 px-4 rounded-lg hover:bg-emerald-600 transition">Berita</a>
        <a href="" class="block py-2 px-4 rounded-lg hover:bg-emerald-600 transition">Prestasi</a>
        <a href="" class="block py-2 px-4 rounded-lg hover:bg-emerald-600 transition">Program Kelas</a>
        <a href="" class="block py-2 px-4 rounded-lg hover:bg-emerald-600 transition">Galeri</a>
        <!-- Tambahkan menu lainnya sesuai kebutuhan -->
      </nav>

      <form method="POST" action="">
        @csrf
        <button class="mt-6 py-2 px-4 w-full bg-red-500 hover:bg-red-600 rounded-lg text-white text-left">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
      </form>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>
  </div>

</body>
</html>
