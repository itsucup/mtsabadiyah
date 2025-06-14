<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderSlider; // <-- Import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <-- Import ini
use App\Models\GeneralSetting; // Asumsi Anda punya model GeneralSetting atau yang serupa

class SettingController extends Controller
{

    /**
     * Menampilkan form pengaturan umum.
     */
    public function index()
    {

        // Ambil data slider untuk ditampilkan di tabel
        $sliders = HeaderSlider::orderBy('order')->paginate(10); // Ambil slider dengan paginasi

        return view('cms.admin.settings.index', compact('settings', 'sliders'));
    }

    /**
     * Memperbarui pengaturan umum (method yang sudah ada).
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => 'nullable|string|max:255', // Contoh field general setting
            'contact_email' => 'nullable|email',
            // ... validasi field general settings lainnya
        ]);

        return redirect()->route('admin.settings')->with('success', 'Pengaturan umum berhasil diperbarui!');
    }

    // --- Metode Baru untuk Header Slider ---

    /**
     * Menyimpan gambar slider baru.
     */
    public function storeSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Wajib, max 5MB
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'order' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/sliders'); // Simpan di storage/app/public/sliders
            $imageUrl = Storage::url($path);
        }

        HeaderSlider::create([
            'image_url' => $imageUrl,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0, // Default 0 jika kosong
            'status' => $request->boolean('status'),
            'user_id' => Auth::id(), // User yang mengupload
        ]);

        return redirect()->route('admin.settings')->with('success', 'Gambar slider berhasil ditambahkan!');
    }

    /**
     * Memperbarui gambar slider yang sudah ada.
     */
    public function updateSlider(Request $request, HeaderSlider $slider) // Route Model Binding
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'order' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        $imageUrl = $slider->image_url;

        // Logika untuk menghapus gambar lama jika checkbox 'delete_image' dicentang
        if ($request->has('delete_image') && $slider->image_url) {
            Storage::delete(str_replace('/storage', 'public', $slider->image_url));
            $imageUrl = null;
        }

        // Logika untuk upload gambar baru
        if ($request->hasFile('image')) {
            if ($slider->image_url && !$request->has('delete_image')) { // Hapus yang lama hanya jika belum dihapus oleh checkbox
                Storage::delete(str_replace('/storage', 'public', $slider->image_url));
            }
            $path = $request->file('image')->store('public/sliders');
            $imageUrl = Storage::url($path);
        }

        $slider->update([
            'image_url' => $imageUrl,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('admin.settings')->with('success', 'Gambar slider berhasil diperbarui!');
    }

    /**
     * Menghapus gambar slider.
     */
    public function destroySlider(HeaderSlider $slider) // Route Model Binding
    {
        if ($slider->image_url) {
            Storage::delete(str_replace('/storage', 'public', $slider->image_url));
        }
        $slider->delete();
        return redirect()->route('admin.settings')->with('success', 'Gambar slider berhasil dihapus!');
    }
}