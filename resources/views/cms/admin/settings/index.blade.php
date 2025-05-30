@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Pengaturan Aplikasi</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Ada masalah!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            {{-- Karena form HTML hanya mendukung GET/POST, kita gunakan method POST di sini,
                 dan akan menggunakan @method('PUT') di route jika memang ingin PATCH/PUT.
                 Namun, untuk kasus ini, route Anda sudah POST, jadi tidak perlu @method. --}}

            <div class="mb-4">
                <label for="app_name" class="block text-gray-700 text-sm font-semibold mb-2">Nama Aplikasi</label>
                <input type="text" id="app_name" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? '') }}"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('app_name') border-red-500 @enderror">
                @error('app_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contact_email" class="block text-gray-700 text-sm font-semibold mb-2">Email Kontak</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('contact_email') border-red-500 @enderror">
                @error('contact_email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="pagination_limit" class="block text-gray-700 text-sm font-semibold mb-2">Batas Pagination</label>
                <input type="number" id="pagination_limit" name="pagination_limit" value="{{ old('pagination_limit', $settings['pagination_limit'] ?? '') }}"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('pagination_limit') border-red-500 @enderror">
                @error('pagination_limit')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                Simpan Pengaturan
            </button>
        </form>
    </div>
@endsection