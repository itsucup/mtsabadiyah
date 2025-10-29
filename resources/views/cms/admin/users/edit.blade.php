@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Edit Pengguna: {{ $user->name }}</h1>

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
        <form action="{{ route('cms.admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk update --}}

            {{-- Nama --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" id="password" name="password"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <label for="role" class="block text-gray-700 text-sm font-semibold mb-2">Role</label>
                <select id="role" name="role" required
                        class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('role') border-red-500 @enderror">
                    
                    <option value="">Pilih Role</option>
                    
                    {{-- Loop dinamis dari User::ROLES --}}
                    @foreach($roles as $value => $label)
                        <option value="{{ $value }}" {{ old('role', $user->role) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach

                </select>
                @error('role')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 text-sm font-semibold mb-2">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('alamat') border-red-500 @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-4">
                <label for="nomor_telepon" class="block text-gray-700 text-sm font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('nomor_telepon') border-red-500 @enderror">
                @error('nomor_telepon')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6 flex items-center">
                <input type="checkbox" id="status" name="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }}
                       class="form-checkbox h-4 w-4 text-emerald-600 rounded focus:ring-emerald-500 transition duration-150 ease-in-out">
                <label for="status" class="ml-2 block text-gray-900 text-sm">Akun Aktif</label>
                @error('status')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                    Perbarui Pengguna
                </button>
                <a href="{{ route('cms.admin.users.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection