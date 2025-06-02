<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::first();
        return view('cms.admin.sejarah.index', compact('sejarah'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi_konten' => 'required|string',
            'delete_header_image' => 'nullable|boolean', // TAMBAHAN VALIDASI
        ]);

        $sejarah = Sejarah::firstOrNew([]);
        $headerImageUrl = $sejarah->header_image;

        // Logika Hapus Gambar
        if ($request->boolean('delete_header_image')) {
            if ($sejarah->header_image) {
                Storage::delete(str_replace('/storage', 'public', $sejarah->header_image));
            }
            $headerImageUrl = null; // Set URL gambar menjadi null
        }

        // Proses upload gambar header BARU
        if ($request->hasFile('header_image')) {
            if ($sejarah->header_image && !$request->boolean('delete_header_image')) {
                 Storage::delete(str_replace('/storage', 'public', $sejarah->header_image));
            }
            $path = $request->file('header_image')->store('public/sejarah_headers');
            $headerImageUrl = Storage::url($path);
        }

        $sejarah->judul = $request->judul;
        $sejarah->header_image = $headerImageUrl;
        $sejarah->isi_konten = $request->isi_konten;
        $sejarah->save();

        return redirect()->route('cms.admin.sejarah.index')
                         ->with('success', 'Data Sejarah berhasil diperbarui!');
    }
}