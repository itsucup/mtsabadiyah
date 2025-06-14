<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting: Import Facade Auth
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
            // 2. Periksa apakah role pengguna adalah 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request); // Jika ya, lanjutkan permintaan
            } else {
                // 3. Jika pengguna login tetapi bukan admin, alihkan ke dashboard dengan pesan error.
                // Pastikan route('cms.dashboard') ada dan sesuai.
                return redirect()->route('cms.dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman admin.');
            }
        }

        // 4. Jika pengguna belum login, alihkan ke halaman login dengan pesan error.
        // Pastikan route('login') ada dan sesuai.
        return redirect()->route('login')->with('error', 'Silakan login sebagai admin untuk mengakses halaman ini.');
    }
}