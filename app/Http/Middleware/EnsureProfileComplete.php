<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Peserta wajib melengkapi profil sebelum memakai fitur lain.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'peserta' && !$user->profilLengkap() && !$request->routeIs('peserta.profile.*', 'peserta.status.sinkron', 'peserta.notifikasi.*')) {
            return redirect()->route('peserta.profile.edit')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu untuk melanjutkan.');
        }

        return $next($request);
    }
}
