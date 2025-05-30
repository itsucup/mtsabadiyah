<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index()
    {
        $fotos = GaleriFoto::with('user')->latest()->paginate(10);
        // View sekarang di subfolder 'foto'
        return view('cms.admin.galeri.foto.index', compact('fotos'));
    }

    public function create()
    {
        // View sekarang di subfolder 'foto'
        return view('cms.admin.galeri.foto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'boolean', // Validasi status
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
            'status' => $request->boolean('status'), // Simpan status
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cms.admin.galeri.foto.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(GaleriFoto $galeriFoto)
    {
        // View sekarang di subfolder 'foto'
        return view('cms.admin.galeri.foto.edit', compact('galeriFoto'));
    }

    public function update(Request $request, GaleriFoto $galeriFoto)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'boolean', // Validasi status
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
            'status' => $request->boolean('status'), // Perbarui status
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