<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleriFotoController as AdminGaleriFotoController;
use App\Http\Controllers\Admin\GaleriVideoController as AdminGaleriVideoController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\StaffDanGuruController as AdminStaffDanGuruController;
use App\Http\Controllers\Admin\HymneAbadiyahController as AdminHymneAbadiyahController;
use App\Http\Controllers\Admin\MarsMadrasahAbadiyahController as AdminMarsController;
use App\Http\Controllers\Admin\SambutanKepalaSekolahController as AdminSambutanController;
use App\Http\Controllers\Admin\VisiMisiController as AdminVisiMisiController;
use App\Http\Controllers\Admin\EkstrakulikulerController as AdminEkstrakulikulerController;
use App\Http\Controllers\Admin\ProgramKelasController as AdminProgramKelasController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController; // Alias untuk CMS

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PublicPagesController;

Route::get('/', [PublicPagesController::class, 'showBeranda'])->name('beranda');

Route::prefix('profil')->group(function () {
    Route::get('sambutan', [PublicPagesController::class, 'showSambutan'])->name('profil.sambutan');
    Route::get('sejarah', [PublicPagesController::class, 'showSejarah'])->name('profil.sejarah');
    Route::get('visi-misi', [PublicPagesController::class, 'showVisiMisi'])->name('profil.visi_misi');
    Route::get('/staffdanguru', [PublicPagesController::class, 'showStaffDanGuru'])->name('profil.staffdanguru');
    Route::view('saranaprasarana', 'profil.saranaprasarana')->name('profil.saranaprasarana');
    Route::get('ekstrakulikuler', [PublicPagesController::class, 'showEkstrakulikuler'])->name('profil.ekstrakulikuler');
    Route::get('mars', [PublicPagesController::class, 'showMars'])->name('profil.mars');
    Route::get('hymne', [PublicPagesController::class, 'showHymne'])->name('profil.hymne');
});

Route::prefix('galeri')->group(function () {
    Route::get('foto', [PublicPagesController::class, 'showGaleriFoto'])->name('galeri.foto');
    Route::get('video', [PublicPagesController::class, 'showGaleriVideo'])->name('galeri.video');
    Route::view('karya', 'galeri.karya')->name('galeri.karya');
});

Route::get('/berita', [PublicPagesController::class, 'showBeritaList'])->name('berita');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('detail');
Route::get('/prestasi', [PublicPagesController::class, 'showPrestasiList'])->name('prestasi');

Route::get('/programkelas', [PublicPagesController::class, 'showProgramKelas'])->name('programkelas');


// --- ROUTE AUTENTIKASI ---
Route::get('/admin/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

// --- ROUTE YANG MEMBUTUHKAN AUTENTIKASI (LOGIN) ---
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'cms.dashboard')->name('cms.dashboard');

    Route::resource('cms/berita', BeritaController::class)->parameters([
        'berita' => 'berita' // <--- INI PENYEBAB MASALAHNYA! HAPUS BARIS INI
    ])->names([
        'index' => 'cms.berita.index',
        'create' => 'cms.berita.create',
        'store' => 'cms.berita.store',
        'edit' => 'cms.berita.edit',
        'update' => 'cms.berita.update',
        'destroy' => 'cms.berita.destroy',
    ])->except(['show']);

    // Route untuk Manajemen Pengguna (User) [Rout Khusus Admin]
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'cms.admin.users.index',
        'create' => 'cms.admin.users.create',
        'store' => 'cms.admin.users.store',
        'edit' => 'cms.admin.users.edit',
        'update' => 'cms.admin.users.update',
        'destroy' => 'cms.admin.users.destroy',
    ]);

    // Route untuk Manajemen Website (Settings) [Rout Khusus Admin]
    Route::resource('admin/settings', UserController::class)->names([
        'index' => 'cms.admin.settings.index',
        'create' => 'cms.admin.settings.create',
        'store' => 'cms.admin.settings.store',
        'show' => 'cms.admin.settings.show',
        'edit' => 'cms.admin.settings.edit',
        'update' => 'cms.admin.settings.update',
        'destroy' => 'cms.admin.settings.destroy',
    ]);

    // Rute untuk Manajemen Galeri Foto di CMS
    Route::resource('cms/admin/galeri/foto', AdminGaleriFotoController::class)->parameters([
        'foto' => 'galeriFoto'
    ])->names([
        'index' => 'cms.admin.galeri.foto.index',
        'create' => 'cms.admin.galeri.foto.create',
        'store' => 'cms.admin.galeri.foto.store',
        'edit' => 'cms.admin.galeri.foto.edit',
        'update' => 'cms.admin.galeri.foto.update',
        'destroy' => 'cms.admin.galeri.foto.destroy',
    ])->except(['show']);

    // Rute untuk Manajemen Galeri Video di CMS
    Route::resource('cms/admin/galeri/video', AdminGaleriVideoController::class)->parameters([
        'video' => 'galeriVideo' // Nama parameter harus cocok dengan segmen URI terakhir
    ])->names([
        'index' => 'cms.admin.galeri.video.index',
        'create' => 'cms.admin.galeri.video.create',
        'store' => 'cms.admin.galeri.video.store',
        'edit' => 'cms.admin.galeri.video.edit',
        'update' => 'cms.admin.galeri.video.update',
        'destroy' => 'cms.admin.galeri.video.destroy',
    ])->except(['show']);
    
    // Rute untuk Manajemen Staff dan Guru di CMS
    Route::resource('cms/admin/staff-dan-guru', AdminStaffDanGuruController::class)->names([
        'index' => 'cms.admin.staff_dan_guru.index',
        'create' => 'cms.admin.staff_dan_guru.create',
        'store' => 'cms.admin.staff_dan_guru.store',
        'edit' => 'cms.admin.staff_dan_guru.edit',
        'update' => 'cms.admin.staff_dan_guru.update',
        'destroy' => 'cms.admin.staff_dan_guru.destroy',
    ])->except(['show']);

    // Rute untuk Manajemen Ekstrakulikuler di CMS
    Route::resource('cms/admin/ekstrakulikuler', AdminEkstrakulikulerController::class)->names([
        'index' => 'cms.admin.ekstrakulikuler.index',
        'create' => 'cms.admin.ekstrakulikuler.create',
        'store' => 'cms.admin.ekstrakulikuler.store',
        'edit' => 'cms.admin.ekstrakulikuler.edit',
        'update' => 'cms.admin.ekstrakulikuler.update',
        'destroy' => 'cms.admin.ekstrakulikuler.destroy',
    ])->except(['show']);

    // Rute untuk Manajemen Halaman Sejarah di CMS
    Route::get('cms/admin/sejarah', [SejarahController::class, 'index'])->name('cms.admin.sejarah.index');
    Route::post('cms/admin/sejarah', [SejarahController::class, 'storeOrUpdate'])->name('cms.admin.sejarah.store_or_update');

    // Rute untuk Manajemen Halaman Hymne Abadiyah di CMS
    Route::get('cms/admin/hymne-abadiyah', [AdminHymneAbadiyahController::class, 'index'])->name('cms.admin.hymne_abadiyah.index');
    Route::post('cms/admin/hymne-abadiyah', [AdminHymneAbadiyahController::class, 'storeOrUpdate'])->name('cms.admin.hymne_abadiyah.store_or_update');

    // Rute untuk Manajemen Halaman Mars Madrasah Abadiyah di CMS
    Route::get('cms/admin/mars-madrasah-abadiyah', [AdminMarsController::class, 'index'])->name('cms.admin.mars_madrasah_abadiyah.index');
    Route::post('cms/admin/mars-madrasah-abadiyah', [AdminMarsController::class, 'storeOrUpdate'])->name('cms.admin.mars_madrasah_abadiyah.store_or_update');

    // Rute untuk Manajemen Halaman Sambutan Kepala Sekolah di CMS
    Route::get('cms/admin/sambutan-kepala-sekolah', [AdminSambutanController::class, 'index'])->name('cms.admin.sambutan_kepala_sekolah.index');
    Route::post('cms/admin/sambutan-kepala-sekolah', [AdminSambutanController::class, 'storeOrUpdate'])->name('cms.admin.sambutan_kepala_sekolah.store_or_update');

    // Rute untuk Manajemen Halaman Visi dan Misi di CMS
    Route::get('cms/admin/visi-misi', [AdminVisiMisiController::class, 'index'])->name('cms.admin.visi_misi.index');
    Route::post('cms/admin/visi-misi', [AdminVisiMisiController::class, 'storeOrUpdate'])->name('cms.admin.visi_misi.store_or_update');

    // Rute untuk Manajemen Program Kelas di CMS
    Route::resource('cms/admin/program-kelas', AdminProgramKelasController::class)->names([
        'index' => 'cms.admin.program_kelas.index',
        'create' => 'cms.admin.program_kelas.create',
        'store' => 'cms.admin.program_kelas.store',
        'edit' => 'cms.admin.program_kelas.edit',
        'update' => 'cms.admin.program_kelas.update',
        'destroy' => 'cms.admin.program_kelas.destroy',
    ])->except(['show']); // Asumsi show tidak diperlukan

    // Rute untuk Manajemen Prestasi (list, tambah, edit, hapus item)
    Route::resource('cms/admin/prestasi', AdminPrestasiController::class)->names([
        'index' => 'cms.admin.prestasi.index',
        'create' => 'cms.admin.prestasi.create',
        'store' => 'cms.admin.prestasi.store',
        'edit' => 'cms.admin.prestasi.edit',
        'update' => 'cms.admin.prestasi.update',
        'destroy' => 'cms.admin.prestasi.destroy',
    ])->except(['show']);
    
});

// --- ROUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'admin'])->group(function () {
    
    

    // Route untuk Pengaturan Aplikasi (Settings)
    // Asumsi ada SettingController dengan method index dan update
    // Jika Anda punya SettingController, pastikan sudah diimport di atas
    // Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
    // Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');


});