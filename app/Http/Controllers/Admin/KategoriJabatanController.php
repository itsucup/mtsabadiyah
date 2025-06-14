<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriJabatan; // Import Model KategoriJabatan
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriJabatanController extends Controller
{

    /**
     * Menampilkan daftar kategori jabatan.
     */
    public function index()
    {
        $kategoriJabatans = KategoriJabatan::latest()->paginate(10);
        return view('cms.admin.kategori_jabatan.index', compact('kategoriJabatans'));
    }

    /**
     * Menampilkan form untuk membuat kategori jabatan baru.
     */
    public function create()
    {
        return view('cms.admin.kategori_jabatan.create');
    }

    /**
     * Menyimpan kategori jabatan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_jabatan,nama',
        ]);

        KategoriJabatan::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama), // Buat slug otomatis
        ]);

        return redirect()->route('cms.admin.kategori_jabatan.index')->with('success', 'Kategori jabatan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit kategori jabatan.
     */
    public function edit(KategoriJabatan $kategoriJabatan) // Route Model Binding
    {
        return view('cms.admin.kategori_jabatan.edit', compact('kategoriJabatan'));
    }

    /**
     * Memperbarui kategori jabatan yang sudah ada.
     */
    public function update(Request $request, KategoriJabatan $kategoriJabatan) // Route Model Binding
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategori_jabatan', 'nama')->ignore($kategoriJabatan->id),
            ],
        ]);

        $kategoriJabatan->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('cms.admin.kategori_jabatan.index')->with('success', 'Kategori jabatan berhasil diperbarui!');
    }

    /**
     * Menghapus kategori jabatan.
     */
    public function destroy(KategoriJabatan $kategoriJabatan) // Route Model Binding
    {
        // Pastikan tidak ada staff yang menggunakan kategori ini jika tidak onDelete('set null')
        $kategoriJabatan->delete();
        return redirect()->route('cms.admin.kategori_jabatan.index')->with('success', 'Kategori jabatan berhasil dihapus!');
    }
}