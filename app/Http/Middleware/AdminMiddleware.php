<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika tidak diizinkan, alihkan pengguna dan berikan pesan error
        if (Auth::check()) {
            // Pengguna login tapi bukan admin
            return redirect()->route('cms.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Pengguna belum login
        return redirect()->route('login')->with('error', 'Silakan login sebagai admin untuk mengakses halaman ini.');
    }
}