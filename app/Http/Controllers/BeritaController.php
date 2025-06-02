<?php

namespace App\Http\Controllers; // Pastikan namespace ini sesuai lokasi controller

use App\Http\Controllers\Controller;
use App\Models\Berita; // Impor Model Berita
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk upload file
use Carbon\Carbon; // Untuk format tanggal

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tampilkan berita berdasarkan role
        if (Auth::user()->role === 'admin') {
            $beritas = Berita::with('user')->latest()->paginate(10);
        } else {
            // Kontributor hanya melihat berita yang mereka upload
            $beritas = Berita::where('user_id', Auth::id())->with('user')->latest()->paginate(10);
        }

        return view('cms.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Foto header
            'konten' => 'required|string', // Konten dari Markdown
            'status_aktif' => 'boolean', // status bisa true/false
        ]);

        $fotoHeaderUrl = null;
        if ($request->hasFile('foto_header')) {
            $path = $request->file('foto_header')->store('public/berita_headers');
            $fotoHeaderUrl = Storage::url($path);
        }

        Berita::create([
            'judul' => $request->judul,
            'foto_header' => $fotoHeaderUrl,
            'konten' => $request->konten,
            'status_aktif' => $request->boolean('status_aktif'),
            'user_id' => Auth::id(), // ID user yang sedang login
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Ini adalah method untuk halaman DETAIL BERITA PUBLIK.
     */
    public function show(Berita $berita) // Menggunakan $berita sebagai variabel model binding
    {
        // Tampilkan berita hanya jika aktif atau jika user adalah admin/penguploadnya
        if (!$berita->status_aktif && (Auth::guest() || (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()))) {
            abort(404); // Berita tidak ditemukan atau tidak aktif
        }
        return view('berita.detail', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa mengedit
        if (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk mengedit berita ini.');
        }
        return view('cms.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa mengupdate
        if (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui berita ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'foto_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten' => 'required|string',
            'status_aktif' => 'boolean',
            'delete_foto_header' => 'nullable|boolean', // Checkbox hapus foto header
        ]);

        $fotoHeaderUrl = $berita->foto_header; // Pertahankan URL lama

        // Logika Hapus Foto Header
        if ($request->boolean('delete_foto_header')) {
            if ($berita->foto_header) {
                Storage::delete(str_replace('/storage', 'public', $berita->foto_header));
            }
            $fotoHeaderUrl = null;
        }

        // Proses upload foto header BARU
        if ($request->hasFile('foto_header')) {
            if ($berita->foto_header && !$request->boolean('delete_foto_header')) {
                 Storage::delete(str_replace('/storage', 'public', $berita->foto_header));
            }
            $path = $request->file('foto_header')->store('public/berita_headers');
            $fotoHeaderUrl = Storage::url($path);
        }

        $berita->update([
            'judul' => $request->judul,
            'foto_header' => $fotoHeaderUrl,
            'konten' => $request->konten,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa menghapus
        if (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk menghapus berita ini.');
        }

        // Hapus gambar terkait jika ada
        if ($berita->foto_header) {
            Storage::delete(str_replace('/storage', 'public', $berita->foto_header));
        }

        $berita->delete();
        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}