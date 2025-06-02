<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarsMadrasahAbadiyah; // Import Model MarsMadrasahAbadiyah
use Illuminate\Http\Request;

class MarsMadrasahAbadiyahController extends Controller
{
    /**
     * Menampilkan form untuk mengelola (melihat dan mengedit) halaman Mars Madrasah Abadiyah.
     * Diasumsikan hanya ada satu record.
     */
    public function index()
    {
        // Coba ambil record Mars Madrasah pertama. Jika belum ada, akan null.
        $mars = MarsMadrasahAbadiyah::first();

        return view('cms.admin.mars_madrasah_abadiyah.index', compact('mars'));
    }

    /**
     * Menyimpan atau memperbarui data Mars Madrasah Abadiyah.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'video_url' => 'nullable|url|max:255', // URL video, harus format URL, max 255 karakter
            'lirik' => 'nullable|string', // Lirik lagu
        ]);

        // Coba ambil record yang sudah ada, atau buat instance baru jika tidak ada
        $mars = MarsMadrasahAbadiyah::firstOrNew([]);

        // Isi atribut model dengan data dari request
        $mars->video_url = $request->video_url;
        $mars->lirik = $request->lirik;

        // Simpan perubahan ke database (ini akan membuat baru jika belum ada, atau memperbarui jika sudah ada)
        $mars->save();

        return redirect()->route('cms.admin.mars_madrasah_abadiyah.index')
                         ->with('success', 'Data Mars Madrasah Abadiyah berhasil diperbarui!');
    }
}