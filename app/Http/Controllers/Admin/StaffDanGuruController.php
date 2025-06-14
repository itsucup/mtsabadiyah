<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffDanGuru;
use App\Models\KategoriJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StaffDanGuruController extends Controller
{

    public function index()
    {
        $s = StaffDanGuru::with('kategoriJabatan')->latest()->paginate(10); // Eager load kategoriJabatan
        return view('cms.admin.staff_dan_guru.index', compact('s'));
    }

    public function create()
    {
        $kategoriJabatans = KategoriJabatan::orderBy('nama')->get(); // Ambil semua kategori jabatan
        return view('cms.admin.staff_dan_guru.create', compact('kategoriJabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_jabatan_id' => 'required|exists:kategori_jabatan,id', // <-- Validasi ini
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'status_aktif' => 'boolean',
        ]);

        $fotoUrl = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/staff');
            $fotoUrl = Storage::url($path);
        }

        StaffDanGuru::create([
            'nama' => $request->nama,
            'kategori_jabatan_id' => $request->kategori_jabatan_id, // <-- Simpan ID kategori
            'foto' => $fotoUrl,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.staff_dan_guru.index')->with('success', 'Data staff/guru berhasil ditambahkan!');
    }

    public function edit(StaffDanGuru $staffDanGuru)
    {
        $kategoriJabatans = KategoriJabatan::orderBy('nama')->get(); // Ambil semua kategori jabatan
        return view('cms.admin.staff_dan_guru.edit', compact('staffDanGuru', 'kategoriJabatans'));
    }

    public function update(Request $request, StaffDanGuru $staffDanGuru)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_jabatan_id' => 'required|exists:kategori_jabatan,id', // <-- Validasi ini
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'deskripsi' => 'nullable|string|max:2000',
            'status_aktif' => 'boolean',
        ]);

        $fotoUrl = $staffDanGuru->foto;
        if ($request->hasFile('foto')) {
            if ($staffDanGuru->foto) {
                Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
            }
            $path = $request->file('foto')->store('public/staff');
            $fotoUrl = Storage::url($path);
        }

        $staffDanGuru->update([
            'nama' => $request->nama,
            'kategori_jabatan_id' => $request->kategori_jabatan_id, // <-- Update ID kategori
            'foto' => $fotoUrl,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.staff_dan_guru.index')->with('success', 'Data staff/guru berhasil diperbarui!');
    }

    public function destroy(StaffDanGuru $staffDanGuru)
    {
        if ($staffDanGuru->foto) {
            Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
        }
        $staffDanGuru->delete();
        return redirect()->route('cms.admin.staff_dan_guru.index')->with('success', 'Data staff/guru berhasil dihapus!');
    }
}