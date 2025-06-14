<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriFotoController extends Controller
{

    public function index()
    {
        $kategoriFotos = KategoriFoto::latest()->paginate(10);
        return view('cms.admin.galeri.kategori.index', compact('kategoriFotos'));
    }

    public function create()
    {
        return view('cms.admin.galeri.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_foto,nama',
        ]);

        KategoriFoto::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('cms.admin.galeri.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

   public function edit(KategoriFoto $kategoriFoto)
    {
        return view('cms.admin.galeri.kategori.edit', compact('kategoriFoto'));
    }

    public function update(Request $request, KategoriFoto $kategoriFoto)
    {
         $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_foto,nama,' . $kategoriFoto->id,
        ]);

        $kategoriFoto->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('cms.admin.galeri.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }


    public function destroy(KategoriFoto $kategoriFoto)
    {
        $kategoriFoto->delete();
        return redirect()->route('cms.admin.galeri.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}