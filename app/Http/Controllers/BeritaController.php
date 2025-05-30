<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita; // Import Model Berita
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk upload file

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
            'konten' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'status' => 'boolean', // status bisa true/false
        ]);

        $headerUrl = null;
        if ($request->hasFile('header_image')) {
            $path = $request->file('header_image')->store('public/berita_headers');
            $headerUrl = Storage::url($path); // Dapatkan URL publik
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'header_url' => $headerUrl,
            'user_id' => Auth::id(), // ID user yang sedang login
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum) // Menggunakan $beritum karena Laravel secara default menggunakan singular model name
    {
        // Pastikan hanya admin atau pemilik berita yang bisa mengedit
        if (Auth::user()->role !== 'admin' && $beritum->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk mengedit berita ini.');
        }
        return view('cms.berita.edit', compact('beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa mengupdate
        if (Auth::user()->role !== 'admin' && $beritum->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui berita ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        $headerUrl = $beritum->header_url; // Pertahankan URL lama jika tidak ada upload baru
        if ($request->hasFile('header_image')) {
            // Hapus gambar lama jika ada
            if ($beritum->header_url) {
                Storage::delete(str_replace('/storage', 'public', $beritum->header_url));
            }
            $path = $request->file('header_image')->store('public/berita_headers');
            $headerUrl = Storage::url($path);
        }

        $beritum->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'header_url' => $headerUrl,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa menghapus
        if (Auth::user()->role !== 'admin' && $beritum->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk menghapus berita ini.');
        }

        // Hapus gambar terkait jika ada
        if ($beritum->header_url) {
            Storage::delete(str_replace('/storage', 'public', $beritum->header_url));
        }

        $beritum->delete();
        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}