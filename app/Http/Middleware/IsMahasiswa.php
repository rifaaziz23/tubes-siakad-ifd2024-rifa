<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMahasiswa
{
    /**
     * Handle an incoming request.
     * Only allows users with role 'mahasiswa' to pass through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'mahasiswa') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Mahasiswa.');
        }

        return $next($request);
    }
}
