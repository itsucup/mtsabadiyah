<?php

namespace App\Providers;

use App\Models\User; // <-- PENTING: Import model User
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\LembagaSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 1. SUPER ADMIN: (DEFINISI BARU)
        // Gate::before() hanya untuk Super Admin.
        // Jika user adalah SA, dia lolos SEMUA @can()
        Gate::before(function (User $user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
            return null; // Penting: biarkan Gate::define() yang memutuskan
        });

        // 2. ADMIN BIASA:
        Gate::define('access-admin-only', function (User $user) {
            return $user->isAdmin();
        });

        // 3. Izin Dashboard (Admin & Kontributor)
        Gate::define('access-dashboard', function (User $user) {
            return $user->isAdmin() || $user->isKontributor();
        });

        // 4. Izin Dropdown CMS (Admin & Kontributor)
        Gate::define('access-cms-dropdown', function (User $user) {
            return $user->isAdmin() || $user->isKontributor();
        });

        // 5. Izin Berita (Admin & Kontributor)
        Gate::define('access-berita', function (User $user) {
            return $user->isAdmin() || $user->isKontributor();
        });

        // 6. Izin Prestasi (Admin & Kontributor)
        Gate::define('access-prestasi', function (User $user) {
            return $user->isAdmin() || $user->isKontributor();
        });

        // Mengikat data pengaturan lembaga ke tampilan partials.footer DAN partials.header
        View::composer(['partials.footer', 'partials.header', 'partials.header2', 'partials.sidebar'], function ($view) { // <-- TAMBAHKAN 'partials.header' di sini
            // Ambil record pertama (dan satu-satunya) dari tabel settings.
            // Jika belum ada, buat instance baru agar tidak error saat diakses.
            $lembagaSettings = LembagaSetting::firstOrCreate([]);
            $view->with('lembagaSettings', $lembagaSettings);
        });
    }
}
