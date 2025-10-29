<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LembagaSetting;
use App\Models\Berita;
use App\Models\User;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\StaffDanGuru;
use App\Models\Ekstrakulikuler;
use App\Models\ProgramKelas;
use App\Models\Prestasi;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $lembagaSettings = LembagaSetting::firstOrCreate([]);

        // Statistik
        $totalBerita = Berita::count();
        $totalUsers = User::count();
        $totalGaleriFoto = GaleriFoto::count();
        $totalGaleriVideo = GaleriVideo::count();
        $totalStaffDanGuru = StaffDanGuru::count();
        $totalEkstrakulikuler = Ekstrakulikuler::count();
        $totalProgramKelas = ProgramKelas::count();
        $totalPrestasi = Prestasi::count();

        // Asumsi ada kategori dengan slug 'pengumuman'
        $latestAnnouncements = Berita::where('status', true)
                                    ->whereHas('kategori', function($query) {
                                        $query->where('slug', 'pengumuman');
                                    })
                                    ->latest()
                                    ->take(6)
                                    ->get();

        return view('cms.dashboard', compact(
            'lembagaSettings',
            'totalBerita',
            'totalUsers',
            'totalGaleriFoto',
            'totalGaleriVideo',
            'totalStaffDanGuru',
            'totalEkstrakulikuler',
            'totalProgramKelas',
            'totalPrestasi',
            'latestAnnouncements'
        ));
    }
}