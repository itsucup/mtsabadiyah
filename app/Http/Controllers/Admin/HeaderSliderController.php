<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Masih perlu jika Anda menggunakan Auth::id() di tempat lain

class HeaderSliderController extends Controller
{

    /**
     * Menampilkan daftar slider.
     */
    public function index()
    {
        // Ambil semua slider, urutkan berdasarkan ID (atau sesuai kebutuhan)
        $sliders = HeaderSlider::latest()->paginate(10);
        return view('cms.admin.header_sliders.index', compact('sliders'));
    }

    /**
     * Menampilkan form untuk membuat slider baru.
     */
    public function create()
    {
        return view('cms.admin.header_sliders.create');
    }

    /**
     * Menyimpan slider baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Hanya validasi image
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/sliders');
            $imageUrl = Storage::url($path);
        }

        HeaderSlider::create([
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('cms.admin.header_sliders.index')->with('success', 'Gambar slider berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit slider.
     */
    public function edit(HeaderSlider $slider)
    {
        return view('cms.admin.header_sliders.edit', compact('slider'));
    }

    /**
     * Memperbarui slider yang sudah ada.
     */
    public function update(Request $request, HeaderSlider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Hanya validasi image
        ]);

        $imageUrl = $slider->image_url;

        // Logika untuk menghapus gambar lama jika checkbox 'delete_image' dicentang
        if ($request->has('delete_image') && $slider->image_url) {
            Storage::delete(str_replace('/storage', 'public', $slider->image_url));
            $imageUrl = null;
        }

        // Logika untuk upload gambar baru
        if ($request->hasFile('image')) {
            if ($slider->image_url && !$request->has('delete_image')) {
                Storage::delete(str_replace('/storage', 'public', $slider->image_url));
            }
            $path = $request->file('image')->store('public/sliders');
            $imageUrl = Storage::url($path);
        }

        $slider->update([
            'image_url' => $imageUrl,
            // Kolom lain dihapus
        ]);

        return redirect()->route('cms.admin.header_sliders.index')->with('success', 'Gambar slider berhasil diperbarui!');
    }

    /**
     * Menghapus slider.
     */
    public function destroy(HeaderSlider $slider)
    {
        if ($slider->image_url) {
            Storage::delete(str_replace('/storage', 'public', $slider->image_url));
        }
        $slider->delete();
        return redirect()->route('cms.admin.header_sliders.index')->with('success', 'Gambar slider berhasil dihapus!');
    }
}