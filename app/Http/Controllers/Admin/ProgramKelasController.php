<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload/hapus file

class ProgramKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai query untuk model ProgramKelas
        $programKelas = ProgramKelas::query();

        // 1. Filter berdasarkan pencarian nama atau deskripsi
        if ($search = $request->input('search')) {
            $programKelas->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter berdasarkan status_aktif
        if ($request->has('status_filter') && $request->input('status_filter') !== null && $request->input('status_filter') !== '') {
            $status = (bool) $request->input('status_filter'); // Konversi string '1'/'0' ke boolean true/false
            $programKelas->where('status_aktif', $status);
        }

        // Urutkan dan tambahkan paginasi
        $programKelas = $programKelas->orderBy('nama', 'asc')->paginate(10); // Sesuaikan jumlah item per halaman dan kolom pengurutan

        return view('cms.admin.program_kelas.index', compact('programKelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admin.program_kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar/ikon
            'deskripsi' => 'nullable|string',
            'status_aktif' => 'boolean', // Validasi untuk checkbox
        ]);

        $fotoIconUrl = null;
        if ($request->hasFile('foto_icon')) {
            $path = $request->file('foto_icon')->store('public/program_kelas_icons');
            $fotoIconUrl = Storage::url($path);
        }

        ProgramKelas::create([
            'nama' => $request->nama,
            'foto_icon' => $fotoIconUrl,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.program_kelas.index')
                         ->with('success', 'Program Kelas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramKelas $programKela) // Variabel ProgramKela karena Laravel singularizes
    {
        return view('cms.admin.program_kelas.edit', compact('programKela'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKelas $programKela)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
            'status_aktif' => 'boolean',
            'delete_foto_icon' => 'nullable|boolean', // Untuk checkbox hapus foto/ikon
        ]);

        $fotoIconUrl = $programKela->foto_icon;

        // Logika Hapus Gambar/Ikon
        if ($request->boolean('delete_foto_icon')) {
            if ($programKela->foto_icon) {
                Storage::delete(str_replace('/storage', 'public', $programKela->foto_icon));
            }
            $fotoIconUrl = null;
        }

        // Proses upload gambar/ikon BARU
        if ($request->hasFile('foto_icon')) {
            if ($programKela->foto_icon && !$request->boolean('delete_foto_icon')) {
                 Storage::delete(str_replace('/storage', 'public', $programKela->foto_icon));
            }
            $path = $request->file('foto_icon')->store('public/program_kelas_icons');
            $fotoIconUrl = Storage::url($path);
        }

        $programKela->update([
            'nama' => $request->nama,
            'foto_icon' => $fotoIconUrl,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.program_kelas.index')
                         ->with('success', 'Program Kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKelas $programKela)
    {
        // Hapus foto/ikon dari storage jika ada
        if ($programKela->foto_icon) {
            Storage::delete(str_replace('/storage', 'public', $programKela->foto_icon));
        }

        $programKela->delete();

        return redirect()->route('cms.admin.program_kelas.index')
                         ->with('success', 'Program Kelas berhasil dihapus!');
    }
}