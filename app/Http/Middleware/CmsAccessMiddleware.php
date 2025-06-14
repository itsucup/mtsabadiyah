<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting: Import Facade Auth
use Symfony\Component\HttpFoundation\Response;

class CmsAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // 2. Periksa apakah role pengguna adalah 'admin' ATAU 'kontributor'
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'kontributor') {
                return $next($request); // Jika ya, lanjutkan permintaan
            } else {
                // 3. Jika pengguna login tetapi role tidak diizinkan, alihkan ke dashboard dengan pesan error.
                // Pastikan route('cms.dashboard') ada dan sesuai.
                return redirect()->route('cms.dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses bagian CMS ini.');
            }
        }

        // 4. Jika pengguna belum login, alihkan ke halaman login dengan pesan error.
        // Pastikan route('login') ada dan sesuai.
        return redirect()->route('login')->with('error', 'Silakan login untuk mengakses halaman CMS.');
    }
}