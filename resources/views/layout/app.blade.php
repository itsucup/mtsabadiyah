<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard MTS Abadiyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="flex h-screen bg-gray-50"> {{-- Latar belakang body menggunakan abu-abu sangat terang --}}

    {{-- Overlay untuk mode mobile, akan aktif saat sidebar terbuka --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('partials.header2')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6"> {{-- Area konten utama sedikit lebih gelap --}}
            @yield('content')
        </main>
    </div>
    
    @stack('scripts') {{-- Pastikan ini ada dan di posisi yang benar --}}

    {{-- Script untuk Sidebar Responsif dan Waktu Realtime --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const datetimeDisplay = document.getElementById('datetime-display');

            // Toggle Sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });

            // Close sidebar when overlay is clicked (mobile)
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });

            // Handle window resize: hide overlay and ensure sidebar is visible on larger screens
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) { // md breakpoint for Tailwind CSS
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            });

            // Realtime Date and Time
            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false // Menggunakan format 24 jam
                };
                datetimeDisplay.textContent = now.toLocaleDateString('id-ID', options); // id-ID untuk bahasa Indonesia
            }

            updateDateTime(); // Panggil pertama kali saat halaman dimuat
            setInterval(updateDateTime, 1000); // Perbarui setiap detik
        });
    </script>
</body>
</html>