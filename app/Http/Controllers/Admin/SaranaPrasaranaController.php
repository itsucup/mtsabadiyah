<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaranaPrasarana; // Import Model SaranaPrasarana
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SaranaPrasaranaController extends Controller
{

    /**
     * Menampilkan daftar sarana dan prasarana.
     */
    public function index(Request $request)
    {
        // Mulai query untuk model SaranaPrasarana
        $saranas = SaranaPrasarana::query();

        // 1. Filter berdasarkan pencarian nama atau deskripsi
        if ($search = $request->input('search')) {
            $saranas->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter berdasarkan status
        if ($request->has('status_filter') && $request->input('status_filter') !== null && $request->input('status_filter') !== '') {
            $status = (bool) $request->input('status_filter'); // Konversi string '1'/'0' ke boolean true/false
            $saranas->where('status', $status);
        }

        // Urutkan dan tambahkan paginasi
        $saranas = $saranas->orderBy('created_at', 'desc')->paginate(10); // Sesuaikan jumlah item per halaman dan kolom pengurutan

        return view('cms.admin.sarana_prasarana.index', compact('saranas'));
    }

    /**
     * Menampilkan form untuk membuat sarana/prasarana baru.
     */
    public function create()
    {
        return view('cms.admin.sarana_prasarana.create');
    }

    /**
     * Menyimpan sarana/prasarana baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Opsional, max 5MB
            'deskripsi' => 'nullable|string|max:2000',
            'status' => 'boolean',
        ]);

        $fotoUrl = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/sarana_prasarana'); // Simpan di storage/app/public/sarana_prasarana
            $fotoUrl = Storage::url($path);
        }

        SaranaPrasarana::create([
            'nama' => $request->nama,
            'foto_url' => $fotoUrl,
            'deskripsi' => $request->deskripsi,
            'status' => $request->boolean('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cms.admin.sarana_prasarana.index')->with('success', 'Sarana/Prasarana berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit sarana/prasarana.
     */
    public function edit(SaranaPrasarana $saranaPrasarana) // Route Model Binding
    {
        return view('cms.admin.sarana_prasarana.edit', compact('saranaPrasarana'));
    }

    /**
     * Memperbarui sarana/prasarana yang sudah ada.
     */
    public function update(Request $request, SaranaPrasarana $saranaPrasarana)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'deskripsi' => 'nullable|string|max:2000',
            'status' => 'boolean',
        ]);

        $fotoUrl = $saranaPrasarana->foto_url;

        // Logika untuk menghapus gambar lama jika checkbox 'delete_foto' dicentang
        if ($request->has('delete_foto') && $saranaPrasarana->foto_url) {
            Storage::delete(str_replace('/storage', 'public', $saranaPrasarana->foto_url));
            $fotoUrl = null;
        }

        // Logika untuk upload gambar baru
        if ($request->hasFile('foto')) {
            if ($saranaPrasarana->foto_url && !$request->has('delete_foto')) {
                Storage::delete(str_replace('/storage', 'public', $saranaPrasarana->foto_url));
            }
            $path = $request->file('foto')->store('public/sarana_prasarana');
            $fotoUrl = Storage::url($path);
        }

        $saranaPrasarana->update([
            'nama' => $request->nama,
            'foto_url' => $fotoUrl,
            'deskripsi' => $request->deskripsi,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.admin.sarana_prasarana.index')->with('success', 'Sarana/Prasarana berhasil diperbarui!');
    }

    /**
     * Menghapus sarana/prasarana.
     */
    public function destroy(SaranaPrasarana $saranaPrasarana)
    {
        if ($saranaPrasarana->foto_url) {
            Storage::delete(str_replace('/storage', 'public', $saranaPrasarana->foto_url));
        }
        $saranaPrasarana->delete();
        return redirect()->route('cms.admin.sarana_prasarana.index')->with('success', 'Sarana/Prasarana berhasil dihapus!');
    }
}