<footer class="">
  <div class="bg-emerald-700 text-white pt-6 pb-6 px-6 md:px-20 grid grid-cols-1 md:grid-cols-2 gap-10">
    <div class="flex flex-col space-y-8">

      <div>
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ $lembagaSettings->logo_url ?? asset('images/logo_mtsabadiyah.png') }}"
            alt="{{ $lembagaSettings->nama_lembaga ?? 'Logo MTs Abadiyah' }}" class="w-12 h-12 object-contain" />
          <h3 class="text-lg md:text-xl font-bold">{{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah' }}</h3>
        </div>
        <p class="text-sm text-gray-200 leading-relaxed">
          {{ $lembagaSettings->deskripsi_singkat ?? 'MTs Abadiyah Gabus Pati adalah madrasah berbasis pesantren yang mengedepankan pendidikan karakter, akademik, dan spiritual.' }}
        </p>
      </div>

      <div>
        <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
        <div class="flex space-x-4 text-xl md:text-2xl">
          @if ($lembagaSettings->facebook_url)
            <a href="{{ $lembagaSettings->facebook_url }}" target="_blank" aria-label="Facebook"
              class="hover:text-gray-300 transition">
              <i class="fab fa-facebook-f"></i>
            </a>
          @endif
          @if ($lembagaSettings->instagram_url)
            <a href="{{ $lembagaSettings->instagram_url }}" target="_blank" aria-label="Instagram"
              class="hover:text-gray-300 transition">
              <i class="fab fa-instagram"></i>
            </a>
          @endif
          @if ($lembagaSettings->tiktok_url)
            <a href="{{ $lembagaSettings->tiktok_url }}" target="_blank" aria-label="TikTok"
              class="hover:text-gray-300 transition">
              <i class="fab fa-tiktok"></i>
            </a>
          @endif
          @if ($lembagaSettings->youtube_url)
            <a href="{{ $lembagaSettings->youtube_url }}" target="_blank" aria-label="YouTube"
              class="hover:text-gray-300 transition">
              <i class="fab fa-youtube"></i>
            </a>
          @endif
        </div>
      </div>
    </div>

    <div>
      <h4 class="text-lg font-semibold mb-4">Kontak Kami</h4>
      <ul class="text-sm space-y-2 text-gray-200">
        @if ($lembagaSettings->alamat)
          <li class="flex items-start space-x-2">
            <i class="fas fa-map-marker-alt mt-1 w-5"></i>
            <span>{{ $lembagaSettings->alamat }}</span>
          </li>
        @endif
        @if ($lembagaSettings->no_telepon)
          <li class="flex items-center space-x-2">
            <i class="fas fa-phone w-5"></i>
            <span>{{ $lembagaSettings->no_telepon }} (Telepon)</span>
          </li>
        @endif
        @if ($lembagaSettings->no_fax)
          <li class="flex items-center space-x-2">
            <i class="fas fa-fax w-5"></i>
            <span>{{ $lembagaSettings->no_fax }} (Fax)</span>
          </li>
        @endif
        @if ($lembagaSettings->email)
          <li class="flex items-center space-x-2">
            <i class="fas fa-envelope w-5"></i>
            <span>{{ $lembagaSettings->email }}</span>
          </li>
        @endif
      </ul>
    </div>
  </div>

  <div class="border-t border-emerald-800 py-4 text-center text-gray-50 bg-emerald-900">
    <p class="text-xs md:text-sm">
      © {{ date('Y') }} {{ $lembagaSettings->nama_lembaga ?? 'MTs Abadiyah Gabus Pati' }}. All rights reserved.
    </p>
  </div>
</footer>