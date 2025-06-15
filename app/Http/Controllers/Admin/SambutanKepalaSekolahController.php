<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SambutanKepalaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanKepalaSekolahController extends Controller
{
    public function index()
    {
        $sambutan = SambutanKepalaSekolah::first();
        return view('cms.admin.sambutan_kepala_sekolah.index', compact('sambutan'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'gambar_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sambutan_text' => 'nullable|string',
            'nama_kepala_sekolah' => 'required|string|max:100',
            'jabatan_kepala_sekolah' => 'nullable|string|max:100',
            'delete_gambar_header' => 'nullable|boolean', // TAMBAHAN VALIDASI
        ]);

        $sambutan = SambutanKepalaSekolah::firstOrNew([]);
        $gambarHeaderUrl = $sambutan->gambar_header;

        // Logika Hapus Gambar
        if ($request->boolean('delete_gambar_header')) {
            if ($sambutan->gambar_header) {
                Storage::delete(str_replace('/storage', 'public', $sambutan->gambar_header));
            }
            $gambarHeaderUrl = null; // Set URL gambar menjadi null
        }

        // Proses upload gambar header BARU
        if ($request->hasFile('gambar_header')) {
            if ($sambutan->gambar_header && !$request->boolean('delete_gambar_header')) {
                 Storage::delete(str_replace('/storage', 'public', $sambutan->gambar_header));
            }
            $path = $request->file('gambar_header')->store('public/sambutan_headers');
            $gambarHeaderUrl = Storage::url($path);
        }

        $sambutan->judul = $request->judul;
        $sambutan->gambar_header = $gambarHeaderUrl;
        $sambutan->sambutan_text = $request->sambutan_text;
        $sambutan->nama_kepala_sekolah = $request->nama_kepala_sekolah;
        $sambutan->jabatan_kepala_sekolah = $request->jabatan_kepala_sekolah;
        $sambutan->save();

        return redirect()->route('cms.admin.sambutan_kepala_sekolah.index')
                         ->with('success', 'Data Sambutan Kepala Sekolah berhasil diperbarui!');
    }
}