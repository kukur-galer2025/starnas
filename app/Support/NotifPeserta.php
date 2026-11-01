<?php

namespace App\Support;

use App\Models\EmailLog;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotifPeserta
{
    /**
     * Catat lalu kirim email ke peserta.
     *
     * - Setiap email dicatat di tabel email_logs (status antri/terkirim/gagal)
     *   sehingga admin bisa memantau dan mengirim ulang dari panel.
     * - Pengiriman berjalan setelah respons HTTP dikirim ke browser (afterResponse):
     *   halaman tidak menunggu SMTP dan tidak butuh queue worker.
     * - Kegagalan SMTP tidak pernah menggagalkan proses utama.
     */
    public static function kirim(?User $user, string $subjek, string $judul, array $baris, ?string $catatan = null, ?string $tombolTeks = null, ?string $tombolUrl = null): void
    {
        if (!$user || !$user->email) {
            return;
        }

        // Notifikasi di dalam aplikasi (lonceng) - tetap ada walau email gagal / masuk spam.
        try {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => $judul,
                'pesan' => $baris[0] ?? null,
                'url' => $tombolUrl,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal membuat notifikasi untuk user ' . $user->id . ': ' . $e->getMessage());
        }

        try {
            $log = EmailLog::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'subjek' => $subjek,
                'payload' => [
                    'nama' => $user->nama_lengkap ?: 'Peserta',
                    'judul' => $judul,
                    'baris' => $baris,
                    'catatan' => $catatan,
                    'tombol_teks' => $tombolTeks,
                    'tombol_url' => $tombolUrl,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mencatat email untuk ' . $user->email . ': ' . $e->getMessage());
            return;
        }

        self::jadwalkan($log);
    }

    /**
     * Jalankan pengiriman sebuah log email setelah respons terkirim.
     */
    public static function jadwalkan(EmailLog $log): void
    {
        $id = $log->id;

        dispatch(function () use ($id) {
            EmailLog::find($id)?->kirimSekarang();
        })->afterResponse();
    }
}
