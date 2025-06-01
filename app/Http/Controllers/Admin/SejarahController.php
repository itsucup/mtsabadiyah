<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah; // Impor model Sejarah
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Impor Storage untuk upload file

class SejarahController extends Controller
{
    /**
     * Menampilkan form untuk mengelola (melihat dan mengedit) halaman sejarah.
     * Diasumsikan hanya ada satu record sejarah.
     */
    public function index()
    {
        // Coba ambil record sejarah pertama. Jika belum ada, akan null.
        $sejarah = Sejarah::first();

        return view('cms.admin.sejarah.index', compact('sejarah'));
    }

    /**
     * Menyimpan atau memperbarui data halaman sejarah.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar header
            'isi_konten' => 'required|string', // Konten dari WYSIWYG editor
        ]);

        // Coba ambil record sejarah yang sudah ada, atau buat instance baru jika tidak ada
        $sejarah = Sejarah::firstOrNew([]);

        // Pertahankan URL gambar header lama jika tidak ada upload gambar baru
        $headerImageUrl = $sejarah->header_image;

        // Proses upload gambar header jika ada file yang dikirim
        if ($request->hasFile('header_image')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($sejarah->header_image) {
                Storage::delete(str_replace('/storage', 'public', $sejarah->header_image));
            }
            // Simpan gambar baru ke direktori 'public/sejarah_headers'
            $path = $request->file('header_image')->store('public/sejarah_headers');
            // Dapatkan URL yang dapat diakses publik
            $headerImageUrl = Storage::url($path);
        }

        // Isi atribut model dengan data dari request
        $sejarah->judul = $request->judul;
        $sejarah->header_image = $headerImageUrl;
        $sejarah->isi_konten = $request->isi_konten; 
        
        // Simpan perubahan ke database (ini akan membuat baru jika belum ada, atau memperbarui jika sudah ada)
        $sejarah->save();

        return redirect()->route('cms.admin.sejarah.index')
                         ->with('success', 'Data Sejarah berhasil diperbarui!');
    }
}