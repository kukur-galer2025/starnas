<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pengecekan pertama: Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();

        // Pengecekan kedua: Bandingkan role user dengan role yang diizinkan (dari route)
        if ($user->role !== $role) {
            // Jika role tidak cocok, kembalikan 403 (Akses Ditolak)
            return abort(403, 'Akses Ditolak: Anda tidak memiliki peran yang sesuai.');
        }

        return $next($request);
    }
}