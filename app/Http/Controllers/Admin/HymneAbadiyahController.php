<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HymneAbadiyah; // Import Model HymneAbadiyah
use Illuminate\Http\Request;

class HymneAbadiyahController extends Controller
{
    /**
     * Menampilkan form untuk mengelola (melihat dan mengedit) halaman Hymne Abadiyah.
     * Diasumsikan hanya ada satu record Hymne Abadiyah.
     */
    public function index()
    {
        // Coba ambil record Hymne Abadiyah pertama. Jika belum ada, akan null.
        $hymne = HymneAbadiyah::first();

        return view('cms.admin.hymne_abadiyah.index', compact('hymne'));
    }

    /**
     * Menyimpan atau memperbarui data Hymne Abadiyah.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'video_url' => 'nullable|url|max:255', // URL video, harus format URL, max 255 karakter
            'lirik' => 'nullable|string', // Lirik lagu
        ]);

        // Coba ambil record Hymne Abadiyah yang sudah ada, atau buat instance baru jika tidak ada
        $hymne = HymneAbadiyah::firstOrNew([]);

        // Isi atribut model dengan data dari request
        $hymne->video_url = $request->video_url;
        $hymne->lirik = $request->lirik;

        // Simpan perubahan ke database (ini akan membuat baru jika belum ada, atau memperbarui jika sudah ada)
        $hymne->save();

        return redirect()->route('cms.admin.hymne_abadiyah.index')
                         ->with('success', 'Data Hymne Abadiyah berhasil diperbarui!');
    }
}