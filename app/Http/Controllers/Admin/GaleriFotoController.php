<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use App\Models\KategoriFoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query untuk model GaleriFoto dengan eager loading relasi
        $fotos = GaleriFoto::with(['kategoriFoto', 'user']);

        // 1. Filter berdasarkan pencarian judul
        if ($search = $request->input('search')) {
            $fotos->where('judul', 'like', '%' . $search . '%');
        }

        // 2. Filter berdasarkan kategori
        if ($kategoriId = $request->input('kategori')) {
            // Pastikan '0' berarti semua kategori, bukan ID kategori 0
            if ($kategoriId != 0) {
                $fotos->where('kategori_foto_id', $kategoriId);
            }
        }

        // 3. Filter berdasarkan status
        // 'status_filter' dari request bisa '1' (aktif), '0' (tidak aktif), atau kosong
        if ($request->has('status_filter') && $request->input('status_filter') !== null && $request->input('status_filter') !== '') {
            $status = (bool) $request->input('status_filter'); // Konversi string '1'/'0' ke boolean true/false
            $fotos->where('status', $status);
        }

        // 4. Filter berdasarkan pengupload
        if ($uploaderId = $request->input('uploader')) {
             // Pastikan '0' berarti semua pengupload, bukan ID user 0
            if ($uploaderId != 0) {
                $fotos->where('user_id', $uploaderId);
            }
        }

        // Urutkan dan tambahkan paginasi
        $fotos = $fotos->orderBy('created_at', 'desc')->paginate(10); // Sesuaikan jumlah item per halaman

        // Ambil semua kategori foto untuk dropdown filter
        $kategoriFotos = KategoriFoto::all();

        // Ambil semua user yang pernah mengupload foto untuk dropdown filter
        // Ambil hanya user yang memiliki role 'admin' atau 'user'
        $uploaders = User::whereIn('role', ['admin', 'user'])->get();


        return view('cms.admin.galeri.foto.index', compact('fotos', 'kategoriFotos', 'uploaders'));
    }

    public function create()
    {
        $kategoriFotos = KategoriFoto::orderBy('nama')->get(); // <-- Ambil semua kategori
        return view('cms.admin.galeri.foto.create', compact('kategoriFotos')); // <-- Kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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