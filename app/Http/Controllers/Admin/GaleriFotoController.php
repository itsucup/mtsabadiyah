<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use App\Models\KategoriFoto; // <-- Tambahkan import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index()
    {
        // Eager load relasi 'kategoriFoto' untuk menghindari N+1 problem
        $fotos = GaleriFoto::with('user', 'kategoriFoto')->latest()->paginate(10);
        return view('cms.admin.galeri.foto.index', compact('fotos'));
    }

    public function create()
    {
        $kategoriFotos = KategoriFoto::orderBy('nama')->get(); // <-- Ambil semua kategori
        return view('cms.admin.galeri.foto.create', compact('kategoriFotos')); // <-- Kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_foto_id' => 'nullable|exists:kategori_foto,id', // <-- Validasi ini
            'status' => 'boolean',
        ]);

        $gambarUrl = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/galeri');
            $gambarUrl = Storage::url($path);
        }

        GaleriFoto::create([
            'gambar_url' => $gambarUrl,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_foto_id' => $request->kategori_foto_id, // <-- Simpan ID kategori
            'status' => $request->boolean('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cms.admin.galeri.foto.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(GaleriFoto $galeriFoto)
    {
        $kategoriFotos = KategoriFoto::orderBy('nama')->get(); // <-- Ambil semua kategori
        return view('cms.admin.galeri.foto.edit', compact('galeriFoto', 'kategoriFotos')); // <-- Kirim ke view
    }

    public function update(Request $request, GaleriFoto $galeriFoto)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_foto_id' => 'nullable|exists:kategori_foto,id', // <-- Validasi ini
            'status' => 'boolean',
        ]);

        $gambarUrl = $galeriFoto->gambar_url;
        if ($request->hasFile('gambar')) {
            if ($galeriFoto->gambar_url) {
                Storage::delete(str_replace('/storage', 'public', $galeriFoto->gambar_url));
            }
            $path = $request->file('gambar')->store('public/galeri');
            $gambarUrl = Storage::url($path);
        }

        $galeriFoto->update([
            'gambar_url' => $gambarUrl,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_foto_id' => $request->kategori_foto_id, // <-- Update ID kategori
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.admin.galeri.foto.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(GaleriFoto $galeriFoto)
    {
        if ($galeriFoto->gambar_url) {
            Storage::delete(str_replace('/storage', 'public', $galeriFoto->gambar_url));
        }

        $galeriFoto->delete();
        return redirect()->route('cms.admin.galeri.foto.index')->with('success', 'Foto berhasil dihapus!');
    }
}