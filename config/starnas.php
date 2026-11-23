<?php

/*
|--------------------------------------------------------------------------
| Pengaturan acara STARNAS ASASI 2026
|--------------------------------------------------------------------------
*/

return [

    /*
     * Sertifikat peserta baru bisa diunduh mulai waktu ini (WIB), yaitu setelah
     * acara selesai (1-2 Desember 2026). Bisa diubah lewat .env:
     *   SERTIFIKAT_DIBUKA="2026-12-02 17:00"
     */
    'sertifikat_dibuka' => env('SERTIFIKAT_DIBUKA', '2026-12-02 17:00'),

];
