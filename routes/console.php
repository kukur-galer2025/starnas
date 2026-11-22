<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Uji pengaturan SMTP di server: php artisan email:tes alamat@tujuan.com
Artisan::command('email:tes {tujuan}', function (string $tujuan) {
    $this->info('Server  : ' . config('mail.mailers.smtp.host') . ':' . config('mail.mailers.smtp.port') . ' (scheme: ' . (config('mail.mailers.smtp.scheme') ?: 'otomatis') . ')');
    $this->info('Pengirim: ' . config('mail.from.name') . ' <' . config('mail.from.address') . '>');
    $this->line('Mengirim email uji ke ' . $tujuan . ' ...');

    try {
        \Illuminate\Support\Facades\Mail::to($tujuan)->send(new \App\Mail\NotifikasiPeserta(
            '[STARNAS ASASI 2026] Email Uji Coba',
            'Admin',
            'Pengaturan email berhasil',
            ['Jika Anda menerima email ini, pengaturan SMTP sistem STARNAS ASASI 2026 sudah benar.'],
        ));
        $this->info('BERHASIL. Cek kotak masuk (dan folder Spam) di ' . $tujuan . '.');
    } catch (\Throwable $e) {
        $this->error('GAGAL: ' . $e->getMessage());
        return 1;
    }
})->purpose('Kirim email uji coba untuk memastikan pengaturan SMTP benar');
