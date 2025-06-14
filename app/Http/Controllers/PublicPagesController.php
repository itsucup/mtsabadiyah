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
use App\Models\KategoriBerita;
use App\Models\KategoriFoto;
use App\Models\KategoriJabatan;
use App\Models\HeaderSlider;
use App\Models\SaranaPrasarana;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class PublicPagesController extends Controller
{

    /**
     * Menampilkan halaman beranda dengan header slider.
     */
    public function showBeranda()
    {
        // Ambil 6 berita terbaru yang aktif
        $latestBeritas = Berita::where('status', true)->latest()->take(6)->with('user')->get();

        // Ambil 6 program kelas yang aktif
        $unggulanProgramKelas = ProgramKelas::where('status_aktif', true)->latest()->take(6)->get();

        // Ambil semua gambar slider
        $headerSliders = HeaderSlider::all();

        // Mengambil link embed google maps
        $lembagaSettings = \App\Models\LembagaSetting::firstOrCreate([]);

        return view('beranda', compact('latestBeritas', 'unggulanProgramKelas', 'headerSliders', 'lembagaSettings')); // <-- Kirim ke view
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
        $query = StaffDanGuru::with('kategoriJabatan')->where('status_aktif', true); // Eager load kategoriJabatan

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // Filter Kategori Jabatan
        if ($request->filled('kategori_jabatan')) {
            $kategoriJabatanSlug = $request->input('kategori_jabatan');
            $kategori = KategoriJabatan::where('slug', $kategoriJabatanSlug)->first();
            if ($kategori) {
                $query->where('kategori_jabatan_id', $kategori->id);
            }
        }

        // Terapkan paginasi di sisi server (8 item per halaman)
        $staffs = $query->orderBy('nama')->paginate(8)->withQueryString();

        // Ambil semua kategori jabatan untuk opsi filter dropdown
        $availableKategoriJabatans = KategoriJabatan::orderBy('nama')->get();

        return view('profil.staffdanguru', compact('staffs', 'availableKategoriJabatans')); // Kirimkan ini
    }

    /**
     * Menampilkan daftar galeri foto di sisi publik dengan filter kategori.
     */
    public function showGaleriFoto(Request $request)
    {
        $query = GaleriFoto::with('kategoriFoto')->where('status', true); // Hanya foto aktif, eager load kategori

        // Filter Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            });
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $kategoriId = $request->input('kategori');
            if ($kategoriId !== '0') { // '0' akan jadi "Semua Kategori"
                $query->where('kategori_foto_id', $kategoriId);
            }
        }

        $galeriFotos = $query->latest()->paginate(12)->withQueryString(); // 12 foto per halaman

        // Ambil semua kategori foto untuk dropdown filter
        $kategoriFotosFilter = KategoriFoto::orderBy('nama')->get();

        return view('galeri.foto', compact('galeriFotos', 'kategoriFotosFilter')); // Kirimkan data kategori untuk filter
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
     * Menampilkan daftar berita di sisi publik dengan filter.
     */
    public function showBeritaList(Request $request)
    {
        $query = Berita::with('user', 'kategori')->where('status', true); // Hanya berita aktif, eager load user & kategori

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
            $kategoriSlug = $request->input('kategori');
            $kategori = KategoriBerita::where('slug', $kategoriSlug)->first();
            if ($kategori) {
                $query->where('kategori_id', $kategori->id);
            }
        }

        // Filter Tahun dan Bulan
        if ($request->filled('year')) {
            $year = $request->input('year');
            $query->whereYear('created_at', $year);
            if ($request->filled('month')) {
                $month = $request->input('month');
                $query->whereMonth('created_at', $month);
            }
        }

        $beritas = $query->latest()->paginate(5)->withQueryString(); // 5 berita per halaman

        // Data untuk Sidebar Filter
        $kategoris = KategoriBerita::orderBy('nama')->get();
        $archives = Berita::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('status', true)
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        // Format archives menjadi nested array untuk view: [tahun => [bulan => count]]
        $archiveYears = [];
        foreach ($archives as $archive) {
            $archiveYears[$archive->year][] = [
                'month_num' => $archive->month,
                'month_name' => Carbon::createFromDate($archive->year, $archive->month)->translatedFormat('F'), // Menggunakan Carbon
                'count' => $archive->count,
            ];
        }

        return view('berita.index', compact('beritas', 'kategoris', 'archiveYears'));
    }

    /**
     * Menampilkan detail berita di sisi publik.
     */
    public function showBeritaDetail(Berita $berita) // Menggunakan Route Model Binding
    {
        // Pastikan berita aktif sebelum ditampilkan
        if (!$berita->status) {
            // Jika berita tidak aktif, kembalikan 404 atau redirect
            abort(404); // Atau redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan atau tidak aktif.');
        }
        return view('berita.show', compact('berita'));
    }

    /**
     * Menampilkan daftar prestasi di sisi publik dengan filter.
     */
    public function showPrestasiList(Request $request)
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

        $prestasis = $query->orderBy('tahun', 'desc')->orderBy('nama_lengkap_anggota')->paginate(10)->withQueryString();

        // Ambil daftar tahun yang unik untuk dropdown filter
        $availableYears = Prestasi::select(DB::raw('DISTINCT tahun'))
                                ->orderBy('tahun', 'desc')
                                ->pluck('tahun');

        return view('prestasi', compact('prestasis', 'availableYears'));
    }

    /**
     * Menampilkan daftar sarana dan prasarana di sisi publik.
     */
    public function showSaranaPrasaranaList()
    {
        $saranas = SaranaPrasarana::where('status', true)->latest()->paginate(12); // Hanya yang aktif
        return view('profil.saranaprasarana', compact('saranas'));
    }
}