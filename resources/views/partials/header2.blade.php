<header class="bg-white shadow-md p-4 flex items-center justify-between border-b-2 border-emerald-600"> {{-- Tambahkan border bawah emerald --}}
    <div class="flex items-center">
        {{-- Tombol untuk menampilkan sidebar di mobile --}}
        <button id="sidebar-toggle" class="text-gray-700 focus:outline-none mr-4 md:hidden">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="text-2xl font-bold text-gray-800">
            Dashboard <span class="text-emerald-600">MTs Abadiyah</span> {{-- Aksen nama instansi --}}
        </div>
    </div>

    <div class="flex items-center space-x-4">
        {{-- Hari, Tanggal, Waktu Realtime --}}
        <div id="datetime-display" class="text-gray-600 text-sm font-medium">
            {{-- Konten ini akan diperbarui oleh JavaScript --}}
        </div>

        <div class="relative">
            <button class="flex items-center space-x-2 text-gray-700 hover:text-emerald-600 focus:outline-none"> {{-- Hover text warna emerald --}}
                <img class="w-8 h-8 rounded-full border-2 border-emerald-600" src="https://via.placeholder.com/150" alt="User Avatar"> {{-- Border emerald di avatar --}}
                <span class="hidden sm:block">Admin</span> {{-- Nama pengguna bisa disederhanakan/disembunyikan di layar kecil --}}
                <i class="fas fa-chevron-down text-sm"></i>
            </button>
            {{-- Dropdown menu bisa ditambahkan di sini dengan JavaScript --}}
        </div>
    </div>
</header>