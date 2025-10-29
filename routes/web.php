<?php

use Illuminate\Support\Facades\Route;

// Controller Publik
use App\Http\Controllers\PublicPagesController;

// Controller Auth
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Controller CMS (Semua Role)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BeritaController; // Ini adalah 'CmsBeritaController' Anda

// Controller CMS (Hanya Admin)
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleriFotoController as AdminGaleriFotoController;
use App\Http\Controllers\Admin\GaleriKaryaController;
use App\Http\Controllers\Admin\GaleriVideoController as AdminGaleriVideoController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\StaffDanGuruController as AdminStaffDanGuruController;
use App\Http\Controllers\Admin\HymneAbadiyahController as AdminHymneAbadiyahController;
use App\Http\Controllers\Admin\MarsMadrasahAbadiyahController as AdminMarsController;
use App\Http\Controllers\Admin\SambutanKepalaSekolahController as AdminSambutanController;
use App\Http\Controllers\Admin\VisiMisiController as AdminVisiMisiController;
use App\Http\Controllers\Admin\EkstrakulikulerController as AdminEkstrakulikulerController;
use App\Http\Controllers\Admin\ProgramKelasController as AdminProgramKelasController;
use App\Http\Controllers\Admin\LembagaSettingController;
use App\Http\Controllers\Admin\HeaderSliderController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KategoriFotoController;
use App\Http\Controllers\Admin\KategoriJabatanController;
use App\Http\Controllers\Admin\SaranaPrasaranaController;

// Controller CMS (Hanya Kontributor Prestasi)
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK (TIDAK PERLU LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicPagesController::class, 'showBeranda'])->name('beranda');

Route::prefix('profil')->group(function () {
    Route::get('sambutan', [PublicPagesController::class, 'showSambutan'])->name('profil.sambutan');
    Route::get('sejarah', [PublicPagesController::class, 'showSejarah'])->name('profil.sejarah');
    Route::get('visi-dan-misi', [PublicPagesController::class, 'showVisiMisi'])->name('profil.visi_misi');
    Route::get('/staff-dan-guru', [PublicPagesController::class, 'showStaffDanGuru'])->name('profil.staffdanguru');
    Route::get('/sarana-dan-prasarana', [PublicPagesController::class, 'showSaranaPrasaranaList'])->name('profil.saranaprasarana');
    Route::get('ekstrakulikuler', [PublicPagesController::class, 'showEkstrakulikuler'])->name('profil.ekstrakulikuler');
    Route::get('mars-madrasah-abadiyah', [PublicPagesController::class, 'showMars'])->name('profil.mars');
    Route::get('hymne-abadiyah', [PublicPagesController::class, 'showHymne'])->name('profil.hymne');
});

Route::prefix('galeri')->group(function () {
    Route::get('foto', [PublicPagesController::class, 'showGaleriFoto'])->name('galeri.foto');
    Route::get('video', [PublicPagesController::class, 'showGaleriVideo'])->name('galeri.video');
    Route::view('karya', 'galeri.karya')->name('galeri.karya'); // Asumsi ini view statis
});

Route::get('/berita', [PublicPagesController::class, 'showBeritaList'])->name('berita.index');
Route::get('/berita/{berita}', [PublicPagesController::class, 'showBeritaDetail'])->name('berita.show');
Route::get('/prestasi', [PublicPagesController::class, 'showPrestasiList'])->name('prestasi');
Route::get('/program-kelas', [PublicPagesController::class, 'showProgramKelas'])->name('programkelas');

/*
|--------------------------------------------------------------------------
| 2. ROUTE AUTENTIKASI (LOGIN/LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| 3. ROUTE CMS (WAJIB LOGIN)
|--------------------------------------------------------------------------
|
| Semua route di bawah ini dilindungi oleh middleware 'auth'.
| Kita akan mengelompokkan sisanya berdasarkan Otorisasi (Gate)
|
*/
Route::middleware(['auth'])->group(function () {

    // --- DASHBOARD (Bisa diakses Admin, K. Berita, K. Prestasi) ---
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('cms.dashboard')
        ->middleware('can:access-dashboard'); // <-- REVISI: Pakai Gate

    // --- GRUP KONTRIBUTOR BERITA (Bisa diakses Admin & K. Berita) ---
    Route::middleware('can:access-berita')->group(function () {
        Route::resource('cms/berita', BeritaController::class)->parameters([
            'berita' => 'berita'
        ])->names([
                    'index' => 'cms.berita.index',
                    'create' => 'cms.berita.create',
                    'store' => 'cms.berita.store',
                    'edit' => 'cms.berita.edit',
                    'update' => 'cms.berita.update',
                    'destroy' => 'cms.berita.destroy',
                ])->except('show');
    });

    // --- GRUP KONTRIBUTOR PRESTASI (Bisa diakses Admin & K. Prestasi) ---
    Route::middleware('can:access-prestasi')->group(function () {
        Route::resource('cms/admin/prestasi', AdminPrestasiController::class)->names([
            'index' => 'cms.admin.prestasi.index',
            'create' => 'cms.admin.prestasi.create',
            'store' => 'cms.admin.prestasi.store',
            'edit' => 'cms.admin.prestasi.edit',
            'update' => 'cms.admin.prestasi.update',
            'destroy' => 'cms.admin.prestasi.destroy',
        ]);
    });

    // --- GRUP ADMIN (HANYA BISA DIAKSES ADMIN) ---
    Route::middleware('can:access-admin-only')->prefix('cms/admin')->name('cms.admin.')->group(function () {

        // REVISI: Mengganti semua 'AdminMiddleware::class' dengan 'can:access-admin-only'
        // dan mengelompokkannya agar rapi.

        // Manajemen Kategori
        Route::resource('kategori-berita', KategoriBeritaController::class)
            ->names('kategori_berita');

        Route::resource('galeri/kategori', KategoriFotoController::class)->parameters([
            'kategori' => 'kategoriFoto'
        ])->names('galeri.kategori');

        Route::resource('kategori-jabatan', KategoriJabatanController::class)
            ->names('kategori_jabatan');

        // Manajemen Galeri
        Route::resource('galeri/foto', AdminGaleriFotoController::class)->parameters([
            'foto' => 'galeriFoto'
        ])->names('galeri.foto');

        Route::resource('galeri/video', AdminGaleriVideoController::class)->parameters([
            'video' => 'galeriVideo'
        ])->names('galeri.video');

        // Manajemen User
        // REVISI: Path diubah dari 'admin/users' menjadi 'users' (prefix 'cms/admin/' sudah ada)
        // Ini akan menghasilkan URL: /cms/admin/users
        Route::resource('users', UserController::class)
            ->names('users');

        // Manajemen Halaman Profil (Single Page)
        Route::get('sambutan-kepala-sekolah', [AdminSambutanController::class, 'index'])->name('sambutan_kepala_sekolah.index');
        Route::post('sambutan-kepala-sekolah', [AdminSambutanController::class, 'storeOrUpdate'])->name('sambutan_kepala_sekolah.store_or_update');

        Route::get('sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
        Route::post('sejarah', [SejarahController::class, 'storeOrUpdate'])->name('sejarah.store_or_update');

        Route::get('visi-misi', [AdminVisiMisiController::class, 'index'])->name('visi_misi.index');
        Route::post('visi-misi', [AdminVisiMisiController::class, 'storeOrUpdate'])->name('visi_misi.store_or_update');

        Route::get('mars-madrasah-abadiyah', [AdminMarsController::class, 'index'])->name('mars_madrasah_abadiyah.index');
        Route::post('mars-madrasah-abadiyah', [AdminMarsController::class, 'storeOrUpdate'])->name('mars_madrasah_abadiyah.store_or_update');

        Route::get('hymne-abadiyah', [AdminHymneAbadiyahController::class, 'index'])->name('hymne_abadiyah.index');
        Route::post('hymne-abadiyah', [AdminHymneAbadiyahController::class, 'storeOrUpdate'])->name('hymne_abadiyah.store_or_update');

        // Manajemen Halaman Profil (Resource)
        Route::resource('staff-dan-guru', AdminStaffDanGuruController::class)
            ->names('staff_dan_guru');

        Route::resource('sarana-prasarana', SaranaPrasaranaController::class)
            ->names('sarana_prasarana');

        Route::resource('ekstrakulikuler', AdminEkstrakulikulerController::class)
            ->names('ekstrakulikuler');

        Route::resource('program-kelas', AdminProgramKelasController::class)
            ->names('program_kelas');

        // Manajemen Settings
        Route::get('lembaga-settings', [LembagaSettingController::class, 'index'])->name('settings.index');
        Route::put('lembaga-settings', [LembagaSettingController::class, 'update'])->name('settings.update');

        Route::resource('header-slider', HeaderSliderController::class)->parameters([
            'header-slider' => 'slider'
        ])->names('header_sliders');

    }); // <-- Akhir dari grup 'can:access-admin-only'

}); // <-- Akhir dari grup 'auth'