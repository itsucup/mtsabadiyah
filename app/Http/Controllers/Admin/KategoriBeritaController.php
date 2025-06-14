<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita; // Import Model KategoriBerita
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Validation\Rule; // Untuk validasi unique slug

class KategoriBeritaController extends Controller
{

    /**
     * Menampilkan daftar kategori berita.
     */
    public function index()
    {
        $kategoris = KategoriBerita::latest()->paginate(10); // Ambil semua kategori, dengan paginasi
        return view('cms.admin.kategori_berita.index', compact('kategoris'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('cms.admin.kategori_berita.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama', // Nama harus unik
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        KategoriBerita::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama), // Buat slug dari nama
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('cms.admin.kategori_berita.index')->with('success', 'Kategori berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(KategoriBerita $kategoriBeritum) // Route Model Binding
    {
        // Variabel disesuaikan agar konsisten dengan view
        $kategori = $kategoriBeritum;
        return view('cms.admin.kategori_berita.edit', compact('kategori'));
    }

    /**
     * Memperbarui kategori yang sudah ada.
     */
    public function update(Request $request, KategoriBerita $kategoriBeritum) // Route Model Binding
    {
        $kategori = $kategoriBeritum; // Penamaan ulang

        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategori_berita', 'nama')->ignore($kategori->id), // Nama harus unik, kecuali dirinya sendiri
            ],
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama), // Update slug jika nama berubah
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('cms.admin.kategori_berita.index')->with('success', 'Kategori berita berhasil diperbarui!');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(KategoriBerita $kategoriBeritum) // Route Model Binding
    {
        $kategori = $kategoriBeritum; // Penamaan ulang

        // Opsional: Anda bisa menambahkan pengecekan apakah ada berita yang menggunakan kategori ini
        // Jika ada, Anda bisa mencegah penghapusan atau mengubah kategori berita terkait menjadi NULL
        // Migrasi kita sudah onDelete('set null'), jadi aman untuk menghapus kategori

        $kategori->delete();
        return redirect()->route('cms.admin.kategori_berita.index')->with('success', 'Kategori berita berhasil dihapus!');
    }
}