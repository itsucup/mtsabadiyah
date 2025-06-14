@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Dashboard Overview</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600 col-span-full">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-3 md:mb-0">Profil Lembaga</h2>
                <a href="{{ route('cms.admin.settings.index') }}" class="text-emerald-600 hover:text-emerald-800 focus:outline-none flex items-center space-x-2">
                    <i class="fas fa-edit"></i> <span>Edit Profil</span>
                </a>
            </div>

            <div class="flex flex-col md:flex-row items-start md:space-x-6 space-y-4 md:space-y-0">
                <div class="flex flex-col items-center justify-center min-w-[120px]">
                    <div class="relative group">
                        <img id="logoDisplay" src="{{ $lembagaSettings->logo_url ?? asset('images/logo_mtsabadiyah.png') }}" alt="Logo Lembaga" class="h-28 w-28 object-contain rounded-full border-2 border-gray-200 group-hover:border-emerald-600 transition-colors duration-200">
                    </div>
                </div>

                <div class="flex-1 space-y-2 text-gray-800">
                    <p class="text-lg font-bold flex items-center"><i class="fas fa-school mr-2 text-emerald-600"></i> <span id="institutionNameDisplay">{{ $lembagaSettings->nama_lembaga ?? 'Nama Lembaga Belum Disetel' }}</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-map-marker-alt mr-2 mt-1 text-emerald-600"></i> <span id="institutionAddressDisplay">{{ $lembagaSettings->alamat ?? 'Alamat Belum Disetel' }}</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-phone-alt mr-2 mt-1 text-emerald-600"></i> <span id="institutionPhoneDisplay">{{ $lembagaSettings->no_telepon ?? 'No. Telepon Belum Disetel' }}</span></p>
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-envelope mr-2 mt-1 text-emerald-600"></i> <span id="institutionEmailDisplay">{{ $lembagaSettings->email ?? 'Email Belum Disetel' }}</span></p>
                    @if($lembagaSettings->no_fax)
                    <p class="text-sm text-gray-600 flex items-start"><i class="fas fa-fax mr-2 mt-1 text-emerald-600"></i> <span id="institutionFaxDisplay">{{ $lembagaSettings->no_fax }}</span></p>
                    @endif
                    <div class="flex items-center space-x-3 mt-2">
                        @if($lembagaSettings->facebook_url)
                        <a href="{{ $lembagaSettings->facebook_url }}" target="_blank" class="text-emerald-600 hover:text-emerald-800"><i class="fab fa-facebook-f text-lg"></i></a>
                        @endif
                        @if($lembagaSettings->instagram_url)
                        <a href="{{ $lembagaSettings->instagram_url }}" target="_blank" class="text-emerald-600 hover:text-emerald-800"><i class="fab fa-instagram text-lg"></i></a>
                        @endif
                        @if($lembagaSettings->tiktok_url)
                        <a href="{{ $lembagaSettings->tiktok_url }}" target="_blank" class="text-emerald-600 hover:text-emerald-800"><i class="fab fa-tiktok text-lg"></i></a>
                        @endif
                        @if($lembagaSettings->youtube_url)
                        <a href="{{ $lembagaSettings->youtube_url }}" target="_blank" class="text-emerald-600 hover:text-emerald-800"><i class="fab fa-youtube text-lg"></i></a>
                        @endif
                    </div>
                </div>

                {{-- Bagian Jam Analog Fungsional --}}
                <div class="w-full md:w-1/4 flex justify-center items-center">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 border border-gray-300 relative overflow-hidden shadow-inner">
                        {{-- Angka jam (opsional, bisa digambar manual atau pakai JS) --}}
                        <div class="absolute text-xs text-gray-700 font-semibold" style="top: 8px; left: 50%; transform: translateX(-50%);">12</div>
                        <div class="absolute text-xs text-gray-700 font-semibold" style="top: 50%; right: 8px; transform: translateY(-50%);">3</div>
                        <div class="absolute text-xs text-gray-700 font-semibold" style="bottom: 8px; left: 50%; transform: translateX(-50%);">6</div>
                        <div class="absolute text-xs text-gray-700 font-semibold" style="top: 50%; left: 8px; transform: translateY(-50%);">9</div>

                        {{-- Pusat jam --}}
                        <div class="absolute w-2 h-2 bg-gray-800 rounded-full z-20"></div>

                        {{-- Jarum Jam --}}
                        <div id="hour-hand" class="absolute bg-gray-700 origin-bottom rounded-full" style="width: 4px; height: 35%; top: 15%; left: calc(50% - 2px); z-index: 10;"></div>
                        {{-- Jarum Menit --}}
                        <div id="minute-hand" class="absolute bg-gray-700 origin-bottom rounded-full" style="width: 3px; height: 45%; top: 5%; left: calc(50% - 1.5px); z-index: 15;"></div>
                        {{-- Jarum Detik --}}
                        <div id="second-hand" class="absolute bg-red-500 origin-bottom rounded-full" style="width: 2px; height: 48%; top: 2%; left: calc(50% - 1px); z-index: 20;"></div>
                    </div>
                </div>
            </div>

            <div id="editMode" class="hidden space-y-4">
                {{-- ... input fields yang sudah ada ... --}}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Statistik</h2>
            <p class="text-gray-600">Total Berita: <span class="font-bold text-emerald-600">{{ $totalBerita }}</span></p>
            <p class="text-gray-600">Total User: <span class="font-bold text-emerald-600">{{ $totalUsers }}</span></p>
            <p class="text-gray-600">Total Galeri Foto: <span class="font-bold text-emerald-600">{{ $totalGaleriFoto }}</span></p>
            <p class="text-gray-600">Total Galeri Video: <span class="font-bold text-emerald-600">{{ $totalGaleriVideo }}</span></p>
            <p class="text-gray-600">Total Staff & Guru: <span class="font-bold text-emerald-600">{{ $totalStaffDanGuru }}</span></p>
            <p class="text-gray-600">Total Ekstrakurikuler: <span class="font-bold text-emerald-600">{{ $totalEkstrakulikuler }}</span></p>
            <p class="text-gray-600">Total Program Kelas: <span class="font-bold text-emerald-600">{{ $totalProgramKelas }}</span></p>
            <p class="text-gray-600">Total Prestasi: <span class="font-bold text-emerald-600">{{ $totalPrestasi }}</span></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-t-4 border-emerald-600">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Pengumuman Terbaru</h2>
            <ul class="text-gray-600 text-sm space-y-2">
                @forelse($latestAnnouncements as $announcement)
                    <li><span class="font-semibold text-emerald-600">{{ $announcement->created_at->format('d M Y') }}:</span> {{ Str::limit($announcement->judul, 40) }}</li>
                @empty
                    <li>Tidak ada pengumuman terbaru.</li>
                @endforelse
            </ul>
        </div>

    </div>

    {{-- Script untuk Jam Analog --}}
    @push('scripts') {{-- Pastikan layout.app Anda memiliki @stack('scripts') --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hourHand = document.getElementById('hour-hand');
            const minuteHand = document.getElementById('minute-hand');
            const secondHand = document.getElementById('second-hand');

            function updateClock() {
                const now = new Date();
                let hours = now.getHours();
                let minutes = now.getMinutes();
                let seconds = now.getSeconds();

                // Hitung derajat rotasi
                // Detik: (detik / 60) * 360 derajat
                const secondsDegrees = ((seconds / 60) * 360);
                // Menit: ((menit + detik/60) / 60) * 360 derajat
                const minutesDegrees = ((minutes + seconds / 60) / 60) * 360;
                // Jam: ((jam % 12 + menit/60) / 12) * 360 derajat
                const hoursDegrees = ((hours % 12 + minutes / 60) / 12) * 360;

                // Terapkan rotasi
                if (secondHand) {
                    secondHand.style.transform = `rotate(${secondsDegrees}deg)`;
                }
                if (minuteHand) {
                    minuteHand.style.transform = `rotate(${minutesDegrees}deg)`;
                }
                if (hourHand) {
                    hourHand.style.transform = `rotate(${hoursDegrees}deg)`;
                }
            }

            // Panggil fungsi updateClock pertama kali saat halaman dimuat
            updateClock();
            // Perbarui jam setiap detik
            setInterval(updateClock, 1000);
        });
    </script>
    @endpush
@endsection