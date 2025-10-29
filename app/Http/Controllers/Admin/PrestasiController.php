<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    /**
     * HAPUS method __construct() DARI SINI
     * Kita akan otorisasi manual di setiap method
     */

    public function index(Request $request)
    {
        // 1. TAMBAHKAN OTORISASI DI SINI
        $this->authorize('access-prestasi'); 

        $query = Prestasi::query();
        // ... (sisa kode index Anda) ...
        $prestasis = $query->orderBy('tahun', 'desc')->orderBy('nama_lengkap_anggota')->paginate(10);
        $availableYears = Prestasi::select(DB::raw('DISTINCT tahun'))
                                  ->orderBy('tahun', 'desc')
                                  ->pluck('tahun');

        return view('cms.admin.prestasi.index', compact('prestasis', 'availableYears'));
    }

    public function create()
    {
        // 2. TAMBAHKAN OTORISASI DI SINI
        $this->authorize('access-prestasi'); 

        $tingkatPrestasiOptions = ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        return view('cms.admin.prestasi.create', compact('tingkatPrestasiOptions'));
    }

    public function store(Request $request)
    {
        // 3. TAMBAHKAN OTORISASI DI SINI
        $this->authorize('access-prestasi'); 

        $request->validate([
            'nama_lengkap_anggota' => 'required|string',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat_prestasi' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'instansi_penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        Prestasi::create($request->all());
        return redirect()->route('cms.admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Prestasi $prestasi)
    {
        // 4. TAMBAHKAN OTORISASI DI SINI
        $this->authorize('access-prestasi'); 

        $tingkatPrestasiOptions = ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        return view('cms.admin.prestasi.edit', compact('prestasi', 'tingkatPrestasiOptions'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        // 5. TAMBAHKAN OTORISASI DI SINI
        $this->authorize('access-prestasi'); 

        $request->validate([
            'nama_lengkap_anggota' => 'required|string',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat_prestasi' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'instansi_penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $prestasi->update($request->all());
        return redirect()->route('cms.admin.prestasi.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        // 6. OTORISASI KHUSUS ADMIN UNTUK HAPUS
        $this->authorize('access-admin-only'); 

        $prestasi->delete();
        return redirect()->route('cms.admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}