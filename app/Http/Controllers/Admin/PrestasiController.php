<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->paginate(10);
        return view('cms.admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        $tingkatPrestasiOptions = ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        return view('cms.admin.prestasi.create', compact('tingkatPrestasiOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap_anggota' => 'required|string',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat_prestasi' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'instansi_penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        Prestasi::create([
            'nama_lengkap_anggota' => $request->nama_lengkap_anggota,
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'instansi_penyelenggara' => $request->instansi_penyelenggara,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('cms.admin.prestasi.index')
                         ->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Prestasi $prestasi)
    {
        $tingkatPrestasiOptions = ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        return view('cms.admin.prestasi.edit', compact('prestasi', 'tingkatPrestasiOptions'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'nama_lengkap_anggota' => 'required|string',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat_prestasi' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'instansi_penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $prestasi->update([
            'nama_lengkap_anggota' => $request->nama_lengkap_anggota,
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'instansi_penyelenggara' => $request->instansi_penyelenggara,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('cms.admin.prestasi.index')
                             ->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('cms.admin.prestasi.index')
                             ->with('success', 'Prestasi berhasil dihapus!');
    }
}