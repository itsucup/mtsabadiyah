<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use App\Models\HymneAbadiyah;
use App\Models\MarsMadrasahAbadiyah;
use App\Models\SambutanKepalaSekolah;
use App\Models\VisiMisi;
use App\Models\Ekstrakulikuler;
use App\Models\ProgramKelas;
use App\Models\StaffDanGuru;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\Berita;
use App\Models\Prestasi;

use Illuminate\Http\Request;

class PublicPagesController extends Controller
{

    /**
     * Menampilkan halaman beranda dengan berita terbaru dan program kelas unggulan.
     */
    public function showBeranda()
    {
        // Ambil 6 berita terbaru yang aktif (sesuai dengan 6 card di desain Anda)
        $latestBeritas = Berita::where('status_aktif', true)
                               ->latest()
                               ->take(6) // Ambil hanya 6
                               ->with('user') // Ambil data user yang mengupload
                               ->get();

        // Ambil semua program kelas yang aktif (sesuai dengan desain Anda)
        $unggulanProgramKelas = ProgramKelas::where('status_aktif', true)
                                            ->latest() // Urutkan terbaru, atau sesuaikan jika ada urutan lain
                                            ->get();

        return view('beranda', compact('latestBeritas', 'unggulanProgramKelas'));
    }
    
    /**
     * Menampilkan halaman sejarah di sisi publik.
     */
    public function showSejarah()
    {
        // Ambil record sejarah pertama. Jika belum ada, akan null.
        $sejarah = Sejarah::first();
        return view('profil.sejarah', compact('sejarah'));
    }

    /**
     * Menampilkan halaman hymne di sisi publik.
     */
    public function showHymne()
    {
        // Ambil record hymne pertama. Jika belum ada, akan null.
        $hymne = HymneAbadiyah::first();
        return view('profil.hymne', compact('hymne'));
    }

    /**
     * Menampilkan halaman mars di sisi publik.
     */
    public function showMars()
    {
        // Ambil record mars pertama. Jika belum ada, akan null.
        $mars = MarsMadrasahAbadiyah::first();
        return view('profil.mars', compact('mars'));
    }

    /**
     * Menampilkan halaman mars di sisi publik.
     */
    public function showSambutan()
    {
        // Ambil record mars pertama. Jika belum ada, akan null.
        $sambutan = SambutanKepalaSekolah::first();
        return view('profil.sambutan', compact('sambutan'));
    }

    /**
     * Menampilkan halaman visi dan misi di sisi publik.
     */
    public function showVisiMisi()
    {
        // Ambil record visi dan misi pertama. Jika belum ada, akan null.
        $visiMisi = VisiMisi::first();
        return view('profil.visi_misi', compact('visiMisi'));
    }

    /**
     * Menampilkan daftar ekstrakulikuler di sisi publik.
     */
    public function showEkstrakulikuler()
    {
        // Hanya tampilkan ekstrakurikuler yang status_aktif-nya true
        $ekstrakulikulers = Ekstrakulikuler::where('status_aktif', true)->latest()->get();
        return view('profil.ekstrakulikuler', compact('ekstrakulikulers'));
    }

    /**
     * Menampilkan daftar program kelas di sisi publik.
     */
    public function showProgramKelas()
    {
        // Hanya tampilkan program kelas yang status_aktif-nya true
        $programKelas = ProgramKelas::where('status_aktif', true)->latest()->get();
        return view('programkelas', compact('programKelas'));
    }

    /**
     * Menampilkan daftar staff dan guru di sisi publik.
     */
    public function showStaffDanGuru(Request $request)
    {
        // Ambil semua jabatan unik untuk opsi filter dropdown
        $uniquePositions = StaffDanGuru::select('jabatan')
                                        ->distinct()
                                        ->pluck('jabatan')
                                        ->sort()
                                        ->toArray();

        // Ambil filter jabatan dari request (URL query parameter, misal ?position=Guru)
        $selectedPosition = $request->input('position', 'all'); // Default 'all' jika tidak ada filter

        // Query dasar: ambil staff yang aktif
        $query = StaffDanGuru::where('status_aktif', true);

        // Terapkan filter jabatan jika ada yang dipilih (selain 'all')
        if ($selectedPosition !== 'all') {
            $query->where('jabatan', $selectedPosition);
        }

        // Terapkan paginasi di sisi server (8 item per halaman)
        $staffs = $query->orderBy('nama')->paginate(8)->withQueryString();
        // withQueryString() penting agar filter tetap aktif saat paginasi

        return view('profil.staffdanguru', compact('staffs', 'uniquePositions', 'selectedPosition'));
    }

    /**
     * Menampilkan daftar galeri foto di sisi publik.
     */
    public function showGaleriFoto()
    {
        // Hanya tampilkan foto yang status_aktif-nya true
        $galeriFotos = GaleriFoto::where('status_aktif', true)->latest()->get();
        return view('galeri.foto', compact('galeriFotos'));
    }

    /**
     * Menampilkan daftar galeri video di sisi publik.
     */
    public function showGaleriVideo()
    {
        // Hanya tampilkan video yang status_aktif-nya true
        $galeriVideos = GaleriVideo::where('status_aktif', true)->latest()->get();
        return view('galeri.video', compact('galeriVideos'));
    }

    /**
     * Menampilkan daftar berita di sisi publik.
     */
    public function showBeritaList()
    {
        // Hanya tampilkan berita yang status_aktif-nya true
        $beritas = Berita::where('status_aktif', true)->latest()->paginate(5); // Contoh 5 berita per halaman
        return view('berita', compact('beritas'));
    }

    /**
     * Menampilkan daftar prestasi di sisi publik.
     */
    public function showPrestasiList()
    {
        $prestasis = Prestasi::orderBy('tahun', 'desc')->orderBy('nama_prestasi')->paginate(10);

        return view('prestasi', compact('prestasis'));
    }

}