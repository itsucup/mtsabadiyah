<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            // Sembunyikan email Super Admin dari daftar
            ->where('email', '!=', env('SUPER_ADMIN_EMAIL'));

        if ($search = $request->input('search')) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($role = $request->input('role')) {
            $users->where('role', $role);
        }

        if ($request->has('status') && $request->input('status') !== null && $request->input('status') !== '') {
            $status = (bool) $request->input('status');
            $users->where('status', $status);
        }

        $users = $users->orderBy('name', 'asc')->paginate(10);
        $roles = User::ROLES;

        return view('cms.admin.users.index', compact('users', 'roles'));

        // Kirim data pengguna dan JUGA daftar role untuk filter (jika ada)
        // return view('cms.admin.users.index', [
        //     'users' => $users,
        //     'roles' => User::ROLES // <-- TAMBAHAN: Untuk filter dropdown di halaman index
        // ]);
    }

    public function create()
    {
        // <-- PERUBAHAN: Kirim daftar ROLES ke view 'create'
        return view('cms.admin.users.create', [
            'roles' => User::ROLES
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'alamat' => 'nullable|string|max:500',
            'nomor_telepon' => 'nullable|string|max:20',
            'status' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'status' => $request->boolean('status'),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('cms.admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        return view('cms.admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // <-- PERUBAHAN: Kirim 'user' dan 'roles' ke view 'edit'
        return view('cms.admin.users.edit', [
            'user' => $user,
            'roles' => User::ROLES
        ]);
    }

    public function update(Request $request, User $user)
    {
        // --- LOGIKA PROTEKSI ---
        // Cek apakah user yang akan di-update adalah Super Admin
        if ($user->email === env('SUPER_ADMIN_EMAIL')) {
            // Hanya Super Admin sendiri yang bisa mengedit profilnya
            if (Auth::user()->email !== env('SUPER_ADMIN_EMAIL')) {
                return redirect()->route('cms.admin.users.index')
                                 ->with('error', 'Aksi dilarang. Anda tidak bisa mengedit Super Admin.');
            }
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            // <-- PERUBAHAN: Validasi role sekarang dinamis
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'alamat' => 'nullable|string|max:500',
            'nomor_telepon' => 'nullable|string|max:20',
            'status' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // --- LOGIKA PROTEKSI ---
        // Cek apakah user yang akan dihapus adalah Super Admin
        if ($user->email === env('SUPER_ADMIN_EMAIL')) {
            return back()->with('error', 'Aksi dilarang. Super Admin tidak bisa dihapus.');
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }
        
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir.');
        }

        $user->delete();
        return redirect()->route('cms.admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}