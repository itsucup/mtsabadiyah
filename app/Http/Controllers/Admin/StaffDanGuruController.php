<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffDanGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload/hapus file

class StaffDanGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = StaffDanGuru::latest()->paginate(10);
        return view('cms.admin.staff_dan_guru.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admin.staff_dan_guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file foto
            'jabatan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_aktif' => 'boolean', // Validasi untuk checkbox
        ]);

        $fotoUrl = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/staff_photos');
            $fotoUrl = Storage::url($path);
        }

        StaffDanGuru::create([
            'nama' => $request->nama,
            'foto' => $fotoUrl,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.staff_dan_guru.index')
                         ->with('success', 'Staff/Guru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffDanGuru $staffDanGuru)
    {
        return view('cms.admin.staff_dan_guru.edit', compact('staffDanGuru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffDanGuru $staffDanGuru)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jabatan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_aktif' => 'boolean',
            'delete_foto' => 'nullable|boolean', // Untuk checkbox hapus foto
        ]);

        $fotoUrl = $staffDanGuru->foto;

        // Logika Hapus Foto
        if ($request->boolean('delete_foto')) {
            if ($staffDanGuru->foto) {
                Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
            }
            $fotoUrl = null;
        }

        // Proses upload foto BARU
        if ($request->hasFile('foto')) {
            if ($staffDanGuru->foto && !$request->boolean('delete_foto')) {
                 Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
            }
            $path = $request->file('foto')->store('public/staff_photos');
            $fotoUrl = Storage::url($path);
        }

        $staffDanGuru->update([
            'nama' => $request->nama,
            'foto' => $fotoUrl,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.staff_dan_guru.index')
                         ->with('success', 'Staff/Guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffDanGuru $staffDanGuru)
    {
        // Hapus foto dari storage jika ada
        if ($staffDanGuru->foto) {
            Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
        }

        $staffDanGuru->delete();

        return redirect()->route('cms.admin.staff_dan_guru.index')
                         ->with('success', 'Staff/Guru berhasil dihapus!');
    }
}