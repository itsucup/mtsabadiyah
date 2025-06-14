<?php

namespace App\Http\Controllers; // Pastikan namespace ini sesuai lokasi controller

use App\Http\Controllers\Controller;
use App\Models\Berita; // Impor Model Berita
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk upload file
use Carbon\Carbon; // Untuk format tanggal

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::with('user', 'kategori'); // Eager load user and kategori

        // Implementasi otorisasi: Kontributor hanya melihat berita mereka sendiri, admin melihat semua
        if (Auth::user()->role === 'kontributor') {
            $query->where('user_id', Auth::id());
        }

        // --- Logika Filter ---

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('konten', 'like', '%' . $search . '%');
            });
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $kategoriId = $request->input('kategori');
            // Pastikan kategoriId adalah integer yang valid jika tidak nol
            if ($kategoriId !== '0') { // 0 akan digunakan untuk "Semua Kategori" jika Anda ingin
                $query->where('kategori_id', $kategoriId);
            }
        }

        // Filter Status
        if ($request->filled('status_filter')) { // Menggunakan nama berbeda agar tidak konflik dengan nama kolom
            $statusValue = $request->input('status_filter');
            // '1' untuk aktif, '0' untuk draft
            if ($statusValue === '1') {
                $query->where('status', true);
            } elseif ($statusValue === '0') {
                $query->where('status', false);
            }
        }

        // Filter Pengupload (Uploader)
        if ($request->filled('uploader')) {
            $uploaderId = $request->input('uploader');
            // Pastikan uploaderId adalah integer yang valid jika tidak nol
            if ($uploaderId !== '0') {
                $query->where('user_id', $uploaderId);
            }
        }

        // --- Akhir Logika Filter ---

        $beritas = $query->latest()->paginate(10)->withQueryString(); // Urutkan terbaru, 10 per halaman, pertahankan query string

        // Data untuk Filter di View
        $kategoris = KategoriBerita::orderBy('nama')->get();
        // Ambil hanya user yang pernah mengupload berita untuk dropdown filter
        $uploaders = User::whereHas('beritas')->orderBy('name')->get(); // Menggunakan whereHas untuk memastikan user punya berita

        return view('cms.berita.index', compact('beritas', 'kategoris', 'uploaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriBerita::orderBy('nama')->get(); // Ambil semua kategori, urutkan berdasarkan nama
        return view('cms.berita.create', compact('kategoris')); // Kirim kategori ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'nullable|exists:kategori_berita,id', // <-- Validasi kategori_id
            'status' => 'boolean',
        ]);

        $headerUrl = null;
        if ($request->hasFile('header_image')) {
            $path = $request->file('header_image')->store('public/berita_headers');
            $headerUrl = Storage::url($path);
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'header_url' => $headerUrl,
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id, // <-- Simpan kategori_id
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Ini adalah method untuk halaman DETAIL BERITA PUBLIK.
     */
    public function show(Berita $berita) // Menggunakan $berita sebagai variabel model binding
    {
        // Tampilkan berita hanya jika aktif atau jika user adalah admin/penguploadnya
        if (!$berita->status_aktif && (Auth::guest() || (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()))) {
            abort(404); // Berita tidak ditemukan atau tidak aktif
        }
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita) 
    {
        $kategoris = KategoriBerita::orderBy('nama')->get(); // Ambil semua kategori, urutkan berdasarkan nama
        return view('cms.berita.edit', compact('berita', 'kategoris')); // Kirim berita dan kategori ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita) // Model binding
    {
        // Model binding di sini akan menjadi $beritum, sesuaikan penggunaan di bawah
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto header
            'kategori_id' => 'nullable|exists:kategori_berita,id', // <-- Validasi kategori_id
            'status' => 'boolean', // Validasi status
        ]);

        $headerUrl = $berita->header_url; // Pertahankan URL lama jika tidak ada upload baru

        // Logika untuk menghapus gambar lama jika checkbox 'delete_foto_header' dicentang
        if ($request->has('delete_foto_header') && $berita->header_url) {
            Storage::delete(str_replace('/storage', 'public', $berita->header_url));
            $headerUrl = null; // Set URL header menjadi null
        }

        // Logika untuk upload gambar baru
        if ($request->hasFile('header_image')) {
            // Hapus gambar lama (jika ada dan belum dihapus oleh checkbox) sebelum mengunggah yang baru
            if ($berita->header_url && !$request->has('delete_foto_header')) {
                Storage::delete(str_replace('/storage', 'public', $berita->header_url));
            }
            $path = $request->file('header_image')->store('public/berita_headers');
            $headerUrl = Storage::url($path);
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'header_url' => $headerUrl, // Gunakan URL yang sudah diupdate/hapus
            'kategori_id' => $request->kategori_id, // <-- Simpan kategori_id
            'status' => $request->boolean('status'), // Perbarui status
        ]);

        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Pastikan hanya admin atau pemilik berita yang bisa menghapus
        if (Auth::user()->role !== 'admin' && $berita->user_id !== Auth::id()) {
            return redirect()->route('cms.berita.index')->with('error', 'Anda tidak memiliki izin untuk menghapus berita ini.');
        }

        // Hapus gambar terkait jika ada
        if ($berita->foto_header) {
            Storage::delete(str_replace('/storage', 'public', $berita->foto_header));
        }

        $berita->delete();
        return redirect()->route('cms.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}