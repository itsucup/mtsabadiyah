@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">General Settings</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><strong>Terjadi kesalahan:</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form General Settings --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pengaturan Umum Website</h2>
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('POST') {{-- Umumnya PUT/PATCH, tapi jika route Anda POST, biarkan POST --}}

            <div class="mb-4">
                <label for="site_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Situs:</label>
                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('site_name') border-red-500 @enderror">
                @error('site_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="contact_email" class="block text-gray-700 text-sm font-bold mb-2">Email Kontak Situs:</label>
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('contact_email') border-red-500 @enderror">
                @error('contact_email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                Simpan Pengaturan Umum
            </button>
        </form>
    </div>

    {{-- --- BAGIAN BARU: MANAJEMEN HEADER SLIDER --- --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Header Slider</h1>

    {{-- Form Tambah Slider Baru --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Gambar Slider Baru</h2>
        <form action="{{ route('admin.settings.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Slider:</label>
                <input type="file" name="image" id="image" accept="image/*" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF, SVG. Max: 2MB.</p>
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul/Teks Slider (Opsional):</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional):</label>
                <textarea name="description" id="description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampil (Opsional):</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="status" id="status" value="1" class="form-checkbox h-5 w-5 text-emerald-600" {{ old('status', true) ? 'checked' : '' }}>
                <label for="status" class="ml-2 text-gray-700">Aktif (Tampilkan di front-end)</label>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                Tambah Slider
            </button>
        </form>
    </div>

    {{-- Tabel Daftar Slider --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 p-6 pb-0">Daftar Gambar Slider</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gambar</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Urutan</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $loop->iteration + ($sliders->currentPage() - 1) * $sliders->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if ($slider->image_url)
                                    <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="w-24 h-16 object-cover rounded">
                                @else
                                    <div class="w-24 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xs">No Image</div>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ Str::limit($slider->title ?? '-', 50) }}
                                @if($slider->description)
                                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($slider->description, 70) }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $slider->order }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    <span aria-hidden class="absolute inset-0 {{ $slider->status ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                    <span class="relative text-{{ $slider->status ? 'green' : 'red' }}-900">{{ $slider->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex flex-col items-center space-y-2">
                                    {{-- Tombol Edit --}}
                                    <button onclick="showEditSliderModal({{ json_encode($slider) }})" class="text-amber-600 hover:text-amber-900 px-3 py-1 rounded-md border border-amber-600 hover:border-amber-900 transition duration-200 w-24 text-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                    {{-- Form Hapus --}}
                                    <form action="{{ route('admin.settings.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?');" class="w-24">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md border border-red-600 hover:border-red-900 transition duration-200 w-full text-center">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Belum ada gambar slider.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $sliders->links() }}
        </div>
    </div>
    {{-- --- AKHIR BAGIAN MANAJEMEN HEADER SLIDER --- --}}
</div>

{{-- Modal Edit Slider --}}
<div id="editSliderModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Gambar Slider</h2>
        <form id="editSliderForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" id="editSliderId"> {{-- Untuk menyimpan ID slider --}}

            <div class="mb-4">
                <label for="edit_image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Saat Ini:</label>
                <img id="currentImagePreview" src="" alt="Current Slider Image" class="w-32 h-24 object-cover rounded mb-2">
                <input type="file" name="image" id="edit_image" accept="image/*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru jika ingin mengubah. Max: 5MB.</p>
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="delete_image" value="1" class="form-checkbox h-5 w-5 text-red-600">
                    <span class="ml-2 text-sm text-red-700">Hapus Gambar Saat Ini</span>
                </label>
            </div>

            <div class="mb-4">
                <label for="edit_title" class="block text-gray-700 text-sm font-bold mb-2">Judul/Teks Slider:</label>
                <input type="text" name="title" id="edit_title"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="edit_description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="description" id="edit_description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"></textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="edit_order" class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampil:</label>
                <input type="number" name="order" id="edit_order"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="status" id="edit_status" value="1" class="form-checkbox h-5 w-5 text-emerald-600">
                <label for="edit_status" class="ml-2 text-gray-700">Aktif (Tampilkan di front-end)</label>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="hideEditSliderModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Batal
                </button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk Modal Slider --}}
@push('scripts')
<script>
    const editSliderModal = document.getElementById('editSliderModal');
    const editSliderForm = document.getElementById('editSliderForm');
    const currentImagePreview = document.getElementById('currentImagePreview');
    const editSliderId = document.getElementById('editSliderId');
    const editTitle = document.getElementById('edit_title');
    const editDescription = document.getElementById('edit_description');
    const editOrder = document.getElementById('edit_order');
    const editStatus = document.getElementById('edit_status');

    function showEditSliderModal(slider) {
        // Set action form untuk update
        editSliderForm.action = `{{ route('admin.settings.sliders.update', '') }}/${slider.id}`;
        editSliderId.value = slider.id;

        // Isi form dengan data slider
        if (slider.image_url) {
            currentImagePreview.src = slider.image_url;
            currentImagePreview.classList.remove('hidden');
        } else {
            currentImagePreview.classList.add('hidden');
        }
        editTitle.value = slider.title || '';
        editDescription.value = slider.description || '';
        editOrder.value = slider.order;
        editStatus.checked = slider.status;

        // Tampilkan modal
        editSliderModal.classList.remove('hidden');
    }

    function hideEditSliderModal() {
        editSliderModal.classList.add('hidden');
        editSliderForm.reset(); // Reset form saat ditutup
        currentImagePreview.classList.add('hidden'); // Sembunyikan preview
    }

    // Handle ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !editSliderModal.classList.contains('hidden')) {
            hideEditSliderModal();
        }
    });

    // Handle click outside modal to close
    editSliderModal.addEventListener('click', function(event) {
        if (event.target === editSliderModal) {
            hideEditSliderModal();
        }
    });
</script>
@endpush
@endsection