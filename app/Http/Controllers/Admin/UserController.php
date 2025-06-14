<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth; // <--- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('cms.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('cms.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'kontributor'])],
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
            'email_verified_at' => now(), // Opsional
        ]);

        return redirect()->route('cms.admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        return view('cms.admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('cms.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'kontributor'])],
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
        // Pastikan admin tidak bisa menghapus dirinya sendiri jika itu satu-satunya admin
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }
        // Atau jika Anda ingin mencegah penghapusan admin terakhir
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir.');
        }

        $user->delete();
        return redirect()->route('cms.admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}