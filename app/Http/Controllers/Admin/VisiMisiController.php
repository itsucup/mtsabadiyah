<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi; // Pastikan model sudah diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan facade Storage sudah diimpor

class VisiMisiController extends Controller
{
    /**
     * Menampilkan form untuk mengelola (melihat dan mengedit) halaman Visi dan Misi.
     * Diasumsikan hanya ada satu record.
     */
    public function index() // <-- Pastikan method ini ada dan namanya 'index'
    {
        // Coba ambil record VisiMisi pertama. Jika belum ada, akan null.
        $visiMisi = VisiMisi::first();

        return view('cms.admin.visi_misi.index', compact('visiMisi'));
    }

    /**
     * Menyimpan atau memperbarui data Visi dan Misi.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'gambar_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'delete_gambar_header' => 'nullable|boolean', // Untuk checkbox hapus gambar
        ]);

        $visiMisi = VisiMisi::firstOrNew([]);
        $gambarHeaderUrl = $visiMisi->gambar_header; // Pertahankan URL lama

        // Logika Hapus Gambar
        if ($request->boolean('delete_gambar_header')) {
            if ($visiMisi->gambar_header) {
                Storage::delete(str_replace('/storage', 'public', $visiMisi->gambar_header));
            }
            $gambarHeaderUrl = null; // Set URL gambar menjadi null
        }

        // Proses upload gambar header BARU
        if ($request->hasFile('gambar_header')) {
            // Jika ada file baru diupload, hapus dulu yang lama (kecuali jika sudah dihapus karena checkbox)
            if ($visiMisi->gambar_header && !$request->boolean('delete_gambar_header')) {
                 Storage::delete(str_replace('/storage', 'public', $visiMisi->gambar_header));
            }
            $path = $request->file('gambar_header')->store('public/visi_misi_headers');
            $gambarHeaderUrl = Storage::url($path);
        }

        $visiMisi->gambar_header = $gambarHeaderUrl;
        $visiMisi->visi = $request->visi;
        $visiMisi->misi = $request->misi;

        $visiMisi->save();

        return redirect()->route('cms.admin.visi_misi.index')
                         ->with('success', 'Data Visi dan Misi berhasil diperbarui!');
    }
}