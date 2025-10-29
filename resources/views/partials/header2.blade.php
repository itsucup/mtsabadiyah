<header class="bg-white shadow-md p-4 flex items-center justify-between border-b-2 border-emerald-600">
    <div class="flex items-center">
        {{-- Tombol untuk menampilkan sidebar di mobile --}}
        <button id="sidebar-toggle" class="text-gray-700 focus:outline-none mr-4 md:hidden">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="text-2xl font-bold text-gray-800">
            Dashboard <span
                class="text-emerald-600">{{ $lembagaSettings->nama_lembaga ?? 'Nama Lembaga Belum Disetel' }}</span>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        {{-- Hari, Tanggal, Waktu Realtime --}}
        <div id="datetime-display" class="text-gray-600 text-sm font-medium">
            {{-- Konten ini akan diperbarui oleh JavaScript --}}
        </div>

        <div class="relative">
            <button id="userDropdownToggle"
                class="flex items-center space-x-2 text-gray-700 hover:text-emerald-600 focus:outline-none">
                {{-- Avatar Dinamis --}}
                @auth {{-- Pastikan user sedang login --}}
                    @php
                        $userAvatar = asset('images/default_avatar.png'); // Default avatar
                        if (Auth::user()->role === 'admin') {
                            $userAvatar = asset('images/icon_admin.png');
                        } elseif (Auth::user()->role === 'kontributor') {
                            $userAvatar = asset('images/icon_kontributor.png');
                        }
                    @endphp
                    <img class="w-8 h-8 rounded-full border-2 border-emerald-600" src="{{ $userAvatar }}" alt="User Avatar">
                    <span class="hidden sm:block font-semibold">{{ Auth::user()->name }}</span> {{-- Tampilkan nama user
                    --}}
                    <i class="fas fa-chevron-down text-sm" id="userDropdownArrow"></i>
                @else
                    {{-- Jika belum login, tampilkan link login --}}
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600">Login</a>
                @endauth
            </button>

            {{-- Dropdown Menu (hidden by default) --}}
            @auth
                <div id="userDropdownMenu"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 disabled"
                        style="pointer-events: none;">
                        Role: <span class="font-bold">
                            {{ Auth::user()::ROLES[Auth::user()->role] ?? ucfirst(Auth::user()->role) }}
                        </span>
                    </a>
                    <div class="border-t border-gray-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dropdown User
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');
        const userDropdownArrow = document.getElementById('userDropdownArrow');

        if (userDropdownToggle && userDropdownMenu) { // Pastikan elemen ada (hanya jika user login)
            userDropdownToggle.addEventListener('click', function () {
                userDropdownMenu.classList.toggle('hidden');
                if (userDropdownArrow) {
                    userDropdownArrow.classList.toggle('rotate-180');
                }
            });

            // Tutup dropdown jika klik di luar
            window.addEventListener('click', function (e) {
                if (!userDropdownToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                    if (!userDropdownMenu.classList.contains('hidden')) {
                        userDropdownMenu.classList.add('hidden');
                        if (userDropdownArrow) {
                            userDropdownArrow.classList.remove('rotate-180');
                        }
                    }
                }
            });
        }

        // Realtime Hari, Tanggal, Waktu
        const datetimeDisplay = document.getElementById('datetime-display');

        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', hour12: false };

            const dateString = now.toLocaleDateString('id-ID', optionsDate); // Format tanggal Indonesia
            const timeString = now.toLocaleTimeString('id-ID', optionsTime); // Format waktu Indonesia (sekarang tanpa detik)

            datetimeDisplay.textContent = `${dateString}, ${timeString} WIB`; // Tambahkan WIB
        }

        updateDateTime(); // Panggil sekali saat dimuat
        setInterval(updateDateTime, 1000);
    });
</script>