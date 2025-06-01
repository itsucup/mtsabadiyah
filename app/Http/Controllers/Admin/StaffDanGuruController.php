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
        // Ambil semua data staff dan guru, bisa ditambahkan paginasi jika banyak
        $staffs = StaffDanGuru::orderBy('created_at', 'desc')->paginate(10); // Contoh paginasi 10 item per halaman
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'jabatan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_aktif' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/staff_photos');
            $data['foto'] = Storage::url($path); // Simpan path yang bisa diakses publik
        }

        StaffDanGuru::create($data);

        return redirect()->route('cms.admin.staff_dan_guru.index')
                         ->with('success', 'Staff/Guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffDanGuru $staffDanGuru)
    {
        // Dalam konteks CMS, show mungkin tidak terlalu diperlukan jika semua info ada di index atau edit
        // Tapi kita tetap definisikan untuk kelengkapan resource controller
        return view('cms.admin.staff_dan_guru.show', compact('staffDanGuru'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'jabatan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_aktif' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($staffDanGuru->foto) {
                Storage::delete(str_replace('/storage', 'public', $staffDanGuru->foto));
            }
            $path = $request->file('foto')->store('public/staff_photos');
            $data['foto'] = Storage::url($path);
        }

        $staffDanGuru->update($data);

        return redirect()->route('cms.admin.staff_dan_guru.index')
                         ->with('success', 'Data Staff/Guru berhasil diperbarui.');
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
                         ->with('success', 'Staff/Guru berhasil dihapus.');
    }
}