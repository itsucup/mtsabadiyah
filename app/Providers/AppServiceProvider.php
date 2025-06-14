<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\LembagaSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate untuk mengakses halaman atau fungsionalitas khusus admin
        Gate::define('view-admin-pages', function ($user) {
            return $user->role === 'admin';
        });

        // Gate untuk mengakses halaman atau fungsionalitas CMS (admin atau kontributor)
        Gate::define('view-cms-pages', function ($user) {
            return $user->role === 'admin' || $user->role === 'kontributor';
        });

        // Mengikat data pengaturan lembaga ke tampilan partials.footer DAN partials.header
        View::composer(['partials.footer', 'partials.header', 'partials.header2', 'partials.sidebar'], function ($view) { // <-- TAMBAHKAN 'partials.header' di sini
            // Ambil record pertama (dan satu-satunya) dari tabel settings.
            // Jika belum ada, buat instance baru agar tidak error saat diakses.
            $lembagaSettings = LembagaSetting::firstOrCreate([]);
            $view->with('lembagaSettings', $lembagaSettings);
        });

        // Opsional: Gate untuk memeriksa role tertentu
        /*
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('is-kontributor', function ($user) {
            return $user->role === 'kontributor';
        });
        */
    }

}