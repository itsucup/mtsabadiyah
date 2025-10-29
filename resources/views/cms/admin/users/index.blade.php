@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-emerald-600 pb-2 inline-block">Manajemen Pengguna
        </h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
            <a href="{{ route('cms.admin.users.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Pengguna Baru
            </a>

            {{-- Form Filter dan Pencarian --}}
            <form action="{{ route('cms.admin.users.index') }}" method="GET"
                class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                <div class="relative w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}"
                        class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>

                <select name="role"
                    class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>

                <select name="status"
                    class="block w-full md:w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>

                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out">
                    Filter
                </button>
                @if(request('search') || request('role') || request('status'))
                    <a href="{{ route('cms.admin.users.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md shadow transition duration-300 ease-in-out flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden"> {{-- Mengganti div class dari yang lama --}}
            <div class="overflow-x-auto"> {{-- Tambahkan div ini untuk responsive table --}}
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Role
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    @php
                                        $bgColor = 'bg-gray-200';
                                        $textColor = 'text-gray-900';
                                        $roleName = ucfirst($user->role);

                                        switch ($user->role) {
                                            case 'admin':
                                                $bgColor = 'bg-blue-200';
                                                $textColor = 'text-blue-900';
                                                $roleName = 'Admin'; // Teks untuk 'admin'
                                                break;
                                            case 'kontributor':
                                                $bgColor = 'bg-yellow-200';
                                                $textColor = 'text-yellow-900';
                                                $roleName = 'Kontributor';
                                                break;
                                        }
                                    @endphp

                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $textColor }}">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 opacity-50 rounded-full {{ $bgColor }}"></span>
                                        <span class="relative">{{ $roleName }}</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $user->status ? 'text-green-900' : 'text-red-900' }}">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 opacity-50 rounded-full {{ $user->status ? 'bg-green-200' : 'bg-red-200' }}"></span>
                                        <span class="relative">{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <div class="flex flex-col items-center space-y-2">
                                        <a href="{{ route('cms.admin.users.edit', $user) }}"
                                            class="text-amber-600 hover:text-amber-900 px-3 py-1 rounded-md border border-amber-600 hover:border-amber-900 transition duration-200 w-24 text-center">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('cms.admin.users.destroy', $user) }}" method="POST" class="w-24"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md border border-red-600 hover:border-red-900 transition duration-200 w-full text-center">
                                                <i class="fas fa-trash-alt mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-5 bg-white text-sm text-center text-gray-500">Tidak ada data
                                    pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection