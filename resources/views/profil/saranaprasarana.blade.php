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
    <title>MTs Abadiyah - Sarana & Prasarana</title>
</head>
<body class="font-inter pt-20 md:pt-24">

    @include('partials.header')

    <section class="bg-emerald-50 mx-5 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="{{ route('beranda') }}">Home</a>
            <span>></span>
            <a class="hover:text-emerald-600 font-medium transition-colors duration-200" href="#">Profil</a>
            <span>></span>
            <span class="text-emerald-700 font-semibold">Sarana & Prasarana</span>
        </div>
    </section>

    <section class="mx-5 md:mx-20 my-8">
        <h1 class="pb-6 text-3xl font-semibold text-center text-gray-800">Sarana & Prasarana</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($saranas as $sarana)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200 cursor-pointer" 
                    onclick="openSaranaModal('{{ $sarana->foto_url ?? asset('images/default_image.png') }}', '{{ $sarana->nama }}', '{{ $sarana->deskripsi ?? '' }}')"> {{-- Menambahkan onclick event --}}
                    
                    @if ($sarana->foto_url)
                        <img src="{{ $sarana->foto_url }}" alt="{{ $sarana->nama }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $sarana->nama }}</h2>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 py-10">
                    <p class="text-lg">Belum ada data sarana dan prasarana yang aktif.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-8 flex justify-center">
            {{ $saranas->links() }}
        </div>
    </section>

    @include('partials.footer')

    {{-- Modal untuk Sarana & Prasarana --}}
    <div id="saranaModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-2xl w-[90%] max-h-[90vh] overflow-auto p-4 relative">
            <button onclick="closeSaranaModal()" class="absolute top-2 right-3 text-gray-600 text-2xl font-bold hover:text-red-500 z-10">&times;</button>
            <img id="saranaModalImage" src="" alt="Zoom" class="w-full max-h-[60vh] object-contain rounded mb-4" />
            <h3 id="saranaModalTitle" class="text-lg font-semibold text-emerald-700 mb-1"></h3>
            <p id="saranaModalDesc" class="text-sm text-gray-700"></p>
        </div>
    </div>

    <script>
        function openSaranaModal(imageSrc, title, description) {
            document.getElementById('saranaModalImage').src = imageSrc;
            document.getElementById('saranaModalTitle').textContent = title;
            document.getElementById('saranaModalDesc').textContent = description;
            document.getElementById('saranaModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Nonaktifkan scroll body
        }

        function closeSaranaModal() {
            document.getElementById('saranaModal').classList.add('hidden');
            document.getElementById('saranaModalImage').src = '';
            document.getElementById('saranaModalTitle').textContent = '';
            document.getElementById('saranaModalDesc').textContent = '';
            document.body.style.overflow = ''; // Aktifkan kembali scroll body
        }
        
        // Menutup modal dengan menekan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !document.getElementById('saranaModal').classList.contains('hidden')) {
                closeSaranaModal();
            }
        });
        
        // Menutup modal dengan klik di luar modal
        document.getElementById('saranaModal').addEventListener('click', function(event) {
            if (event.target === this) { // Hanya jika klik langsung pada overlay modal
                closeSaranaModal();
            }
        });
    </script>

</body>
</html>