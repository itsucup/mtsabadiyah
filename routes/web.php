<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleriFotoController;
use App\Http\Controllers\Admin\GaleriVideoController;
use App\Http\Controllers\BeritaController;

Route::view('/', 'beranda')->name('beranda');

Route::prefix('profil')->group(function () {
    Route::view('sambutan', 'profil.sambutan')->name('profil.sambutan');
    Route::view('sejarah', 'profil.sejarah')->name('profil.sejarah');
    Route::view('visimisi', 'profil.visimisi')->name('profil.visimisi');
    Route::view('staffdanguru', 'profil.staffdanguru')->name('profil.staffdanguru');
    Route::view('saranaprasarana', 'profil.saranaprasarana')->name('profil.saranaprasarana');
    Route::view('ekstrakulikuler', 'profil.ekstrakulikuler')->name('profil.ekstrakulikuler');
    Route::view('mars', 'profil.mars')->name('profil.mars');
    Route::view('hymne', 'profil.hymne')->name('profil.hymne');
});

Route::prefix('galeri')->group(function () {
    Route::view('foto', 'galeri.foto')->name('galeri.foto');
    Route::view('video', 'galeri.video')->name('galeri.video');
    Route::view('karya', 'galeri.karya')->name('galeri.karya');
});

Route::view('/berita', 'berita')->name('berita');
Route::view('/detail', 'detail')->name('detail');
Route::view('/prestasi', 'prestasi')->name('prestasi');
Route::view('/programkelas', 'programkelas')->name('programkelas');

// --- ROUTE AUTENTIKASI ---
Route::get('/admin/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

// --- ROUTE YANG MEMBUTUHKAN AUTENTIKASI (LOGIN) ---
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'cms.dashboard')->name('cms.dashboard');

    Route::resource('cms/berita', BeritaController::class)->names([
        'index' => 'cms.berita.index',
        'create' => 'cms.berita.create',
        'store' => 'cms.berita.store',
        'show' => 'cms.berita.show',
        'edit' => 'cms.berita.edit',
        'update' => 'cms.berita.update',
        'destroy' => 'cms.berita.destroy',
    ]);

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

    // Route untuk Manajemen Galeri Foto [Rout Khusus Admin]
    Route::resource('cms/admin/galeri/foto', GaleriFotoController::class)->parameters([
        'foto' => 'galeriFoto' // Nama parameter harus cocok dengan segmen URI terakhir
    ])->names([
        'index' => 'cms.admin.galeri.foto.index',
        'create' => 'cms.admin.galeri.foto.create',
        'store' => 'cms.admin.galeri.foto.store',
        'edit' => 'cms.admin.galeri.foto.edit',
        'update' => 'cms.admin.galeri.foto.update',
        'destroy' => 'cms.admin.galeri.foto.destroy',
    ])->except(['show']);

    // Route untuk Manajemen Galeri Video (URL: cms/admin/galeri/video)
    Route::resource('cms/admin/galeri/video', GaleriVideoController::class)->parameters([
        'video' => 'galeriVideo'
    ])->names([
        'index' => 'cms.admin.galeri.video.index',
        'create' => 'cms.admin.galeri.video.create',
        'store' => 'cms.admin.galeri.video.store',
        'edit' => 'cms.admin.galeri.video.edit',
        'update' => 'cms.admin.galeri.video.update',
        'destroy' => 'cms.admin.galeri.video.destroy',
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