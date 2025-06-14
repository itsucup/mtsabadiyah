<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LembagaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Import Storage facade

class LembagaSettingController extends Controller
{
    /**
     * Menampilkan form pengaturan profil lembaga.
     */
    public function index()
    {
        $settings = LembagaSetting::firstOrCreate([]);
        return view('cms.admin.settings.index', compact('settings'));
    }

    /**
     * Memperbarui pengaturan profil lembaga.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lembaga' => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:1000',
            'alamat' => 'nullable|string|max:500',
            'google_maps_url' => 'nullable|string|max:2048',
            'no_telepon' => 'nullable|string|max:50',
            'no_fax' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file logo (opsional, max 2MB)
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $settings = LembagaSetting::firstOrNew([]); // Ambil record pertama atau buat baru

        // Handle Logo Upload
        $logoUrl = $settings->logo_url; // Pertahankan URL lama jika tidak ada upload baru

        // Logika untuk menghapus logo lama jika checkbox 'delete_logo' dicentang
        if ($request->has('delete_logo') && $settings->logo_url) {
            Storage::delete(str_replace('/storage', 'public', $settings->logo_url));
            $logoUrl = null; // Set URL logo menjadi null
        }

        // Logika untuk upload logo baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama (jika ada dan belum dihapus oleh checkbox) sebelum mengunggah yang baru
            if ($settings->logo_url && !$request->has('delete_logo')) {
                Storage::delete(str_replace('/storage', 'public', $settings->logo_url));
            }
            $path = $request->file('logo')->store('public/lembaga'); // Simpan di storage/app/public/lembaga
            $logoUrl = Storage::url($path); // Dapatkan URL publik
        }

        $settings->fill($validatedData); // Isi data yang divalidasi
        $settings->logo_url = $logoUrl; // Update kolom logo_url

        $settings->save(); // Simpan perubahan

        return redirect()->route('cms.admin.settings.index')->with('success', 'Pengaturan Profil Lembaga berhasil diperbarui!');
    }
}
