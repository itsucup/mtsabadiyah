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
    public function index(Request $request)
    {
        $s = StaffdanGuru::with('kategoriJabatan');

        if ($search = $request->input('search')) {
            $s->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhereHas('kategoriJabatan', function ($q) use ($search) {
                          $q->where('nama', 'like', '%' . $search . '%');
                      });
            });
        }

        if ($request->has('status_filter') && $request->input('status_filter') !== null && $request->input('status_filter') !== '') {
            $status = (bool) $request->input('status_filter'); // Konversi string '1'/'0' ke boolean true/false
            $s->where('status_aktif', $status); // Gunakan 'status_aktif' sesuai migrasi
        }

        // Urutkan dan tambahkan paginasi
        $s = $s->orderBy('created_at', 'desc')->paginate(10); // Sesuaikan jumlah item per halaman dan kolom pengurutan

        // Ambil semua kategori jabatan untuk dropdown filter
        $kategoriJabatans = KategoriJabatan::all();

        return view('cms.admin.staff_dan_guru.index', compact('s', 'kategoriJabatans')); // Pastikan variabel view sesuai
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