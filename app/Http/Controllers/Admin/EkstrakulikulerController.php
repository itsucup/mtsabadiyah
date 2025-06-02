<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload/hapus file

class EkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakulikulers = Ekstrakulikuler::latest()->paginate(10);
        return view('cms.admin.ekstrakulikuler.index', compact('ekstrakulikulers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admin.ekstrakulikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar/ikon
            'deskripsi_singkat' => 'nullable|string',
            'status_aktif' => 'boolean', // Validasi untuk checkbox
        ]);

        $fotoIconUrl = null;
        if ($request->hasFile('foto_icon')) {
            $path = $request->file('foto_icon')->store('public/ekstrakulikuler_icons');
            $fotoIconUrl = Storage::url($path);
        }

        Ekstrakulikuler::create([
            'nama' => $request->nama,
            'foto_icon' => $fotoIconUrl,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Ekstrakulikuler berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakulikuler $ekstrakulikuler)
    {
        return view('cms.admin.ekstrakulikuler.edit', compact('ekstrakulikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakulikuler $ekstrakulikuler)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_singkat' => 'nullable|string',
            'status_aktif' => 'boolean',
            'delete_foto_icon' => 'nullable|boolean', // Untuk checkbox hapus foto/ikon
        ]);

        $fotoIconUrl = $ekstrakulikuler->foto_icon;

        // Logika Hapus Gambar/Ikon
        if ($request->boolean('delete_foto_icon')) {
            if ($ekstrakulikuler->foto_icon) {
                Storage::delete(str_replace('/storage', 'public', $ekstrakulikuler->foto_icon));
            }
            $fotoIconUrl = null;
        }

        // Proses upload gambar/ikon BARU
        if ($request->hasFile('foto_icon')) {
            if ($ekstrakulikuler->foto_icon && !$request->boolean('delete_foto_icon')) {
                 Storage::delete(str_replace('/storage', 'public', $ekstrakulikuler->foto_icon));
            }
            $path = $request->file('foto_icon')->store('public/ekstrakulikuler_icons');
            $fotoIconUrl = Storage::url($path);
        }

        $ekstrakulikuler->update([
            'nama' => $request->nama,
            'foto_icon' => $fotoIconUrl,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Ekstrakulikuler berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakulikuler $ekstrakulikuler)
    {
        // Hapus foto/ikon dari storage jika ada
        if ($ekstrakulikuler->foto_icon) {
            Storage::delete(str_replace('/storage', 'public', $ekstrakulikuler->foto_icon));
        }

        $ekstrakulikuler->delete();

        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Ekstrakulikuler berhasil dihapus!');
    }
}