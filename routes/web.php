<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\LembagaSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderSliderController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KategoriFotoController;
use App\Http\Controllers\Admin\KategoriJabatanController;
use App\Http\Controllers\Admin\SaranaPrasaranaController;

use App\Http\Controllers\BeritaController as CmsBeritaController; // Alias untuk CMS Berita

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PublicPagesController;

use App\Http\Middleware\AdminMiddleware;

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
    Route::view('karya', 'galeri.karya')->name('galeri.karya');
});

// Route untuk daftar Berita (publik)
Route::get('/berita', [PublicPagesController::class, 'showBeritaList'])->name('berita.index'); // Nama route ini diubah dari 'berita' ke 'berita.index'
Route::get('/berita/{berita}', [PublicPagesController::class, 'showBeritaDetail'])->name('berita.show'); // Route detail berita

Route::get('/prestasi', [PublicPagesController::class, 'showPrestasiList'])->name('prestasi');

Route::get('/program-kelas', [PublicPagesController::class, 'showProgramKelas'])->name('programkelas');

// --- ROUTE KHUSUS ADMIN ---
Route::middleware(['auth'])->group(function () {
    // Dashboard CMS
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('cms.dashboard');

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

    // Route untuk Manajemen Kategori Berita
    Route::resource('cms/admin/kategori-berita', KategoriBeritaController::class)->names([
        'index' => 'cms.admin.kategori_berita.index',
        'create' => 'cms.admin.kategori_berita.create',
        'store' => 'cms.admin.kategori_berita.store',
        'edit' => 'cms.admin.kategori_berita.edit',
        'update' => 'cms.admin.kategori_berita.update',
        'destroy' => 'cms.admin.kategori_berita.destroy',
    ])->middleware(AdminMiddleware::class);

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
    ])->except('show');

    // Route untuk Manajemen Kategori Berita
    Route::resource('cms/admin/galeri/kategori', KategoriFotoController::class)->parameters([
        'kategori' => 'kategoriFoto' // <--- TAMBAHKAN BARIS INI
    ])->names([
        'index' => 'cms.admin.galeri.kategori.index',
        'create' => 'cms.admin.galeri.kategori.create',
        'store' => 'cms.admin.galeri.kategori.store',
        'edit' => 'cms.admin.galeri.kategori.edit',
        'update' => 'cms.admin.galeri.kategori.update',
        'destroy' => 'cms.admin.galeri.kategori.destroy',
    ])->middleware(AdminMiddleware::class);

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
    ]);

    // Route untuk Manajemen Pengguna (User) [Rout Khusus Admin]
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'cms.admin.users.index',
        'create' => 'cms.admin.users.create',
        'store' => 'cms.admin.users.store',
        'edit' => 'cms.admin.users.edit',
        'update' => 'cms.admin.users.update',
        'destroy' => 'cms.admin.users.destroy',
    ])->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Halaman Sambutan Kepala Sekolah di CMS
    Route::get('cms/admin/sambutan-kepala-sekolah', [AdminSambutanController::class, 'index'])->name('cms.admin.sambutan_kepala_sekolah.index')->middleware(AdminMiddleware::class);
    Route::post('cms/admin/sambutan-kepala-sekolah', [AdminSambutanController::class, 'storeOrUpdate'])->name('cms.admin.sambutan_kepala_sekolah.store_or_update')->middleware(AdminMiddleware::class);
    
    // Rute untuk Manajemen Halaman Sejarah di CMS
    Route::get('cms/admin/sejarah', [SejarahController::class, 'index'])->name('cms.admin.sejarah.index')->middleware(AdminMiddleware::class);
    Route::post('cms/admin/sejarah', [SejarahController::class, 'storeOrUpdate'])->name('cms.admin.sejarah.store_or_update')->middleware(AdminMiddleware::class);
    
    // Rute untuk Manajemen Halaman Visi dan Misi di CMS
    Route::get('cms/admin/visi-misi', [AdminVisiMisiController::class, 'index'])->name('cms.admin.visi_misi.index')->middleware(AdminMiddleware::class);
    Route::post('cms/admin/visi-misi', [AdminVisiMisiController::class, 'storeOrUpdate'])->name('cms.admin.visi_misi.store_or_update')->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Staff dan Guru di CMS
    Route::resource('cms/admin/staff-dan-guru', AdminStaffDanGuruController::class)->names([
        'index' => 'cms.admin.staff_dan_guru.index',
        'create' => 'cms.admin.staff_dan_guru.create',
        'store' => 'cms.admin.staff_dan_guru.store',
        'edit' => 'cms.admin.staff_dan_guru.edit',
        'update' => 'cms.admin.staff_dan_guru.update',
        'destroy' => 'cms.admin.staff_dan_guru.destroy',
    ])->middleware(AdminMiddleware::class);

    // Route untuk Manajemen Kategori Jabatan
    Route::resource('cms/admin/kategori-jabatan', KategoriJabatanController::class)->names([ // <-- Tambahkan ini
        'index' => 'cms.admin.kategori_jabatan.index',
        'create' => 'cms.admin.kategori_jabatan.create',
        'store' => 'cms.admin.kategori_jabatan.store',
        'edit' => 'cms.admin.kategori_jabatan.edit',
        'update' => 'cms.admin.kategori_jabatan.update',
        'destroy' => 'cms.admin.kategori_jabatan.destroy',
    ])->middleware(AdminMiddleware::class);

    // Route untuk Manajemen Sarana dan Prasarana
    Route::resource('cms/admin/sarana-prasarana', SaranaPrasaranaController::class)->names([
        'index' => 'cms.admin.sarana_prasarana.index',
        'create' => 'cms.admin.sarana_prasarana.create',
        'store' => 'cms.admin.sarana_prasarana.store',
        'edit' => 'cms.admin.sarana_prasarana.edit',
        'update' => 'cms.admin.sarana_prasarana.update',
        'destroy' => 'cms.admin.sarana_prasarana.destroy',
    ])->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Ekstrakulikuler di CMS
    Route::resource('cms/admin/ekstrakulikuler', AdminEkstrakulikulerController::class)->names([
        'index' => 'cms.admin.ekstrakulikuler.index',
        'create' => 'cms.admin.ekstrakulikuler.create',
        'store' => 'cms.admin.ekstrakulikuler.store',
        'edit' => 'cms.admin.ekstrakulikuler.edit',
        'update' => 'cms.admin.ekstrakulikuler.update',
        'destroy' => 'cms.admin.ekstrakulikuler.destroy',
    ])->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Halaman Mars Madrasah Abadiyah di CMS
    Route::get('cms/admin/mars-madrasah-abadiyah', [AdminMarsController::class, 'index'])->name('cms.admin.mars_madrasah_abadiyah.index')->middleware(AdminMiddleware::class);
    Route::post('cms/admin/mars-madrasah-abadiyah', [AdminMarsController::class, 'storeOrUpdate'])->name('cms.admin.mars_madrasah_abadiyah.store_or_update')->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Halaman Hymne Abadiyah di CMS
    Route::get('cms/admin/hymne-abadiyah', [AdminHymneAbadiyahController::class, 'index'])->name('cms.admin.hymne_abadiyah.index')->middleware(AdminMiddleware::class);
    Route::post('cms/admin/hymne-abadiyah', [AdminHymneAbadiyahController::class, 'storeOrUpdate'])->name('cms.admin.hymne_abadiyah.store_or_update')->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Program Kelas di CMS
    Route::resource('cms/admin/program-kelas', AdminProgramKelasController::class)->names([
        'index' => 'cms.admin.program_kelas.index',
        'create' => 'cms.admin.program_kelas.create',
        'store' => 'cms.admin.program_kelas.store',
        'edit' => 'cms.admin.program_kelas.edit',
        'update' => 'cms.admin.program_kelas.update',
        'destroy' => 'cms.admin.program_kelas.destroy',
    ])->middleware(AdminMiddleware::class);

    // Rute untuk Manajemen Prestasi (list, tambah, edit, hapus item)
    Route::resource('cms/admin/prestasi', AdminPrestasiController::class)->names([
        'index' => 'cms.admin.prestasi.index',
        'create' => 'cms.admin.prestasi.create',
        'store' => 'cms.admin.prestasi.store',
        'edit' => 'cms.admin.prestasi.edit',
        'update' => 'cms.admin.prestasi.update',
        'destroy' => 'cms.admin.prestasi.destroy',
    ])->middleware(AdminMiddleware::class);
    
    // Route untuk Pengaturan Profil Lembaga
    Route::get('/cms/admin/lembaga-settings', [LembagaSettingController::class, 'index'])->name('cms.admin.settings.index')->middleware(AdminMiddleware::class);
    Route::put('/cms/admin/lembaga-settings', [LembagaSettingController::class, 'update'])->name('cms.admin.settings.update')->middleware(AdminMiddleware::class);

        // Rute untuk Manajemen Program Kelas di CMS
    Route::resource('cms/admin/header-slider', HeaderSliderController::class)->parameters([
        'header-slider' => 'slider' // Nama parameter harus cocok dengan segmen URI terakhir
    ])->names([
        'index' => 'cms.admin.header_sliders.index',
        'create' => 'cms.admin.header_sliders.create',
        'store' => 'cms.admin.header_sliders.store',
        'edit' => 'cms.admin.header_sliders.edit',
        'update' => 'cms.admin.header_sliders.update',
        'destroy' => 'cms.admin.header_sliders.destroy',
    ])->middleware(AdminMiddleware::class);

});


// --- ROUTE AUTENTIKASI ---
Route::get('/admin/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');