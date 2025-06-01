<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler; // Pastikan model sudah diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan facade Storage sudah diimpor

class EkstrakulikulerController extends Controller
{
    /**
     * Menampilkan daftar semua resource (ekstrakulikuler).
     */
    public function index()
    {
        // Ambil semua data ekstrakulikuler, diurutkan dari yang terbaru dan dipaginasi
        $ekstrakulikulers = Ekstrakulikuler::latest()->paginate(10); // Menggunakan latest() untuk order by created_at DESC

        return view('cms.admin.ekstrakulikuler.index', compact('ekstrakulikulers'));
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     */
    public function create()
    {
        return view('cms.admin.ekstrakulikuler.create');
    }

    /**
     * Menyimpan resource yang baru dibuat ke storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_ekstrakulikuler' => 'required|string|max:100',
            'foto_ekstrakulikuler' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'deskripsi_singkat' => 'nullable|string',
            // Validasi 'boolean' di sini penting jika Anda ingin memastikan nilai yang datang adalah 0 atau 1
            // Namun, metode $request->boolean() di bawah akan menangani kasus tidak adanya field
            // jadi validasi ini opsional jika Anda percaya pada $request->boolean().
            // Jika ada nilai lain yang mungkin dikirim, tetap pakai 'boolean'.
            'status_aktif' => 'boolean',
        ]);

        // Inisialisasi variabel untuk URL foto
        $fotoUrl = null;

        // Proses upload foto jika ada
        if ($request->hasFile('foto_ekstrakulikuler')) {
            $path = $request->file('foto_ekstrakulikuler')->store('public/ekstrakulikuler_photos');
            $fotoUrl = Storage::url($path); // Dapatkan URL yang bisa diakses publik
        }

        // Membuat record baru di database
        Ekstrakulikuler::create([
            'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
            'foto_ekstrakulikuler' => $fotoUrl,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            // $request->boolean('status_aktif') akan mengembalikan:
            // true jika checkbox dicentang (nilai '1' atau 'on')
            // false jika checkbox tidak dicentang (field tidak ada di request)
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Ekstrakulikuler berhasil ditambahkan!');
    }

    /**
     * Menampilkan resource yang ditentukan.
     */
    public function show(Ekstrakulikuler $ekstrakulikuler)
    {
        // Umumnya tidak terlalu sering digunakan di CMS jika detail sudah terlihat di index atau edit
        return view('cms.admin.ekstrakulikuler.show', compact('ekstrakulikuler'));
    }

    /**
     * Menampilkan form untuk mengedit resource yang ditentukan.
     */
    public function edit(Ekstrakulikuler $ekstrakulikuler)
    {
        return view('cms.admin.ekstrakulikuler.edit', compact('ekstrakulikuler'));
    }

    /**
     * Memperbarui resource yang ditentukan di storage.
     */
    public function update(Request $request, Ekstrakulikuler $ekstrakulikuler)
    {
        // Validasi input
        $request->validate([
            'nama_ekstrakulikuler' => 'required|string|max:100',
            'foto_ekstrakulikuler' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_singkat' => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        // Pertahankan URL foto lama jika tidak ada upload baru
        $fotoUrl = $ekstrakulikuler->foto_ekstrakulikuler; 

        // Proses upload foto baru jika ada
        if ($request->hasFile('foto_ekstrakulikuler')) {
            // Hapus foto lama jika ada
            if ($ekstrakulikuler->foto_ekstrakulikuler) {
                Storage::delete(str_replace('/storage', 'public', $ekstrakulikuler->foto_ekstrakulikuler));
            }
            $path = $request->file('foto_ekstrakulikuler')->store('public/ekstrakulikuler_photos');
            $fotoUrl = Storage::url($path);
        }

        // Perbarui record di database
        $ekstrakulikuler->update([
            'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
            'foto_ekstrakulikuler' => $fotoUrl,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Data Ekstrakulikuler berhasil diperbarui!');
    }

    /**
     * Menghapus resource yang ditentukan dari storage.
     */
    public function destroy(Ekstrakulikuler $ekstrakulikuler)
    {
        // Hapus foto terkait dari storage jika ada
        if ($ekstrakulikuler->foto_ekstrakulikuler) {
            Storage::delete(str_replace('/storage', 'public', $ekstrakulikuler->foto_ekstrakulikuler));
        }

        // Hapus record dari database
        $ekstrakulikuler->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('cms.admin.ekstrakulikuler.index')
                         ->with('success', 'Ekstrakulikuler berhasil dihapus!');
    }
}