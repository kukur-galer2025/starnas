<?php

namespace App\Http\Controllers;

use App\Support\Verifikasi;

/**
 * Halaman publik hasil scan QR pada sertifikat / LoA.
 */
class VerifikasiController extends Controller
{
    public function show(string $kode)
    {
        $data = Verifikasi::periksa($kode);

        return response()
            ->view('verifikasi', ['data' => $data, 'kode' => $kode], $data ? 200 : 404)
            ->header('X-Robots-Tag', 'noindex');
    }
}
