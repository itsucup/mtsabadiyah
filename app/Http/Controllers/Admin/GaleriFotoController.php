<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class GaleriFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data galeri foto dengan relasi user (pengupload)
        // Admin bisa melihat semua foto
        // User non-admin (misal kontributor) hanya melihat foto yang diuploadnya
        if (Auth::user()->role === 'admin') {
            $galeriFotos = GaleriFoto::with('user')->latest()->paginate(10);
        } else {
            $galeriFotos = GaleriFoto::where('user_id', Auth::id())->with('user')->latest()->paginate(10);
        }

        return view('cms.admin.galeri.foto.index', compact('galeriFotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admin.galeri.foto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Wajib ada gambar saat membuat baru
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        $gambarUrl = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/galeri_foto');
            $gambarUrl = Storage::url($path);
        }

        GaleriFoto::create([
            'gambar_url' => $gambarUrl,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_aktif' => $request->boolean('status_aktif'),
            'user_id' => Auth::id(), // Simpan ID user yang mengupload
        ]);

        return redirect()->route('cms.admin.galeri.foto.index')
                         ->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriFoto $galeriFoto) // Variabel galeriFoto
    {
        // Pastikan hanya admin atau pengupload yang bisa mengedit
        if (Auth::user()->role !== 'admin' && $galeriFoto->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.foto.index')->with('error', 'Anda tidak memiliki izin untuk mengedit foto ini.');
        }
        return view('cms.admin.galeri.foto.edit', compact('galeriFoto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GaleriFoto $galeriFoto)
    {
        // Pastikan hanya admin atau pengupload yang bisa mengupdate
        if (Auth::user()->role !== 'admin' && $galeriFoto->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.foto.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui foto ini.');
        }

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar tidak wajib saat update (bisa tanpa perubahan)
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
            'status_aktif' => 'boolean',
            'delete_gambar' => 'nullable|boolean', // Checkbox hapus gambar
        ]);

        $gambarUrl = $galeriFoto->gambar_url;

        // Logika Hapus Gambar
        if ($request->boolean('delete_gambar')) {
            if ($galeriFoto->gambar_url) {
                Storage::delete(str_replace('/storage', 'public', $galeriFoto->gambar_url));
            }
            $gambarUrl = null;
        }

        // Proses upload gambar BARU
        if ($request->hasFile('gambar')) {
            if ($galeriFoto->gambar_url && !$request->boolean('delete_gambar')) {
                 Storage::delete(str_replace('/storage', 'public', $galeriFoto->gambar_url));
            }
            $path = $request->file('gambar')->store('public/galeri_foto');
            $gambarUrl = Storage::url($path);
        }

        $galeriFoto->update([
            'gambar_url' => $gambarUrl,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_aktif' => $request->boolean('status_aktif'),
            // user_id tidak diupdate karena hanya pengupload awal
        ]);

        return redirect()->route('cms.admin.galeri.foto.index')
                         ->with('success', 'Foto galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleriFoto $galeriFoto)
    {
        // Pastikan hanya admin atau pengupload yang bisa menghapus
        if (Auth::user()->role !== 'admin' && $galeriFoto->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.foto.index')->with('error', 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        // Hapus gambar dari storage jika ada
        if ($galeriFoto->gambar_url) {
            Storage::delete(str_replace('/storage', 'public', $galeriFoto->gambar_url));
        }

        $galeriFoto->delete();

        return redirect()->route('cms.admin.galeri.foto.index')
                         ->with('success', 'Foto galeri berhasil dihapus!');
    }
    // Method show() tidak disertakan karena di-except di route
}