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
     * Display a listing of the resource (Prestasi).
     */
    public function index(Request $request)
    {
        $query = Prestasi::query();

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap_anggota', 'like', '%' . $search . '%')
                  ->orWhere('nama_prestasi', 'like', '%' . $search . '%')
                  ->orWhere('instansi_penyelenggara', 'like', '%' . $search . '%');
            });
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->input('tahun'));
        }

        // Urutkan berdasarkan tahun terbaru dan nama (atau sesuai kebutuhan)
        $prestasis = $query->orderBy('tahun', 'desc')->orderBy('nama_lengkap_anggota')->paginate(10); // Maksimal 25 data

        // Ambil daftar tahun yang unik untuk dropdown filter
        $availableYears = Prestasi::select(DB::raw('DISTINCT tahun'))
                                ->orderBy('tahun', 'desc')
                                ->pluck('tahun');

        return view('cms.admin.prestasi.index', compact('prestasis', 'availableYears'));
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