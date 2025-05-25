<?php

use Illuminate\Support\Facades\Route;

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

// Route::prefix('program')->group(function () {
//     Route::view('tahfidz', 'program.tahfidz')->name('program.tahfidz');
//     Route::view('kitab-salaf', 'program.kitab-salaf')->name('program.kitab-salaf');
//     Route::view('sains-riset', 'program.sains-riset')->name('program.sains-riset');
//     Route::view('seni-olahraga', 'program.seni-olahraga')->name('program.seni-olahraga');
//     Route::view('reguler', 'program.reguler')->name('program.reguler');
// });

Route::prefix('galeri')->group(function () {
    Route::view('foto', 'galeri.foto')->name('galeri.foto');
    Route::view('vide', 'galeri.video')->name('galeri.video');
    Route::view('karya', 'galeri.karya')->name('galeri.karya');
});

Route::view('/berita', 'berita')->name('berita');
Route::view('/detail', 'detail')->name('detail');
Route::view('/prestasi', 'prestasi')->name('prestasi');

Route::view('/admin/login', 'cms.login')->name('login');
Route::view('/admin/register', 'cms.register')->name('register');


Route::view('/dashboard', 'cms.dashboard')->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::view('/dashboard', 'cms.dashboard')->name('dashboard');
//     Route::view('/profile', 'cms.profile')->name('profile');
// });