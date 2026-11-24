<?php

namespace App\Support;

use App\Models\EmailLog;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NotifPeserta
{
    /** Jumlah email antrean yang dikirim per putaran (menjaga batas kirim SMTP). */
    public const BATCH_ANTREAN = 10;

    /**
     * Catat lalu kirim email ke peserta.
     *
     * - Setiap email dicatat di tabel email_logs (status antri/terkirim/gagal)
     *   sehingga admin bisa memantau dan mengirim ulang dari panel.
     * - Pengiriman berjalan setelah respons HTTP dikirim ke browser (afterResponse):
     *   halaman tidak menunggu SMTP dan tidak butuh queue worker.
     * - Kegagalan SMTP tidak pernah menggagalkan proses utama.
     * - $notifikasi=false: hanya email, tanpa notifikasi lonceng (mis. reset password).
     */
    public static function kirim(?User $user, string $subjek, string $judul, array $baris, ?string $catatan = null, ?string $tombolTeks = null, ?string $tombolUrl = null, bool $notifikasi = true): void
    {
        if (!$user || !$user->email) {
            return;
        }

        if ($notifikasi) {
            self::buatNotifikasi($user, $judul, $baris[0] ?? null, $tombolUrl);
        }

        $log = self::catatEmail($user, $subjek, $judul, $baris, $catatan, $tombolTeks, $tombolUrl);

        if ($log) {
            self::jadwalkan($log);
        }
    }

    /** Notifikasi lonceng di dashboard peserta (tetap ada walau email gagal / masuk spam). */
    public static function buatNotifikasi(User $user, string $judul, ?string $pesan, ?string $url, ?int $pengumumanId = null): void
    {
        try {
            Notifikasi::create([
                'user_id' => $user->id,
                'pengumuman_id' => $pengumumanId,
                'judul' => $judul,
                'pesan' => $pesan,
                'url' => $url,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal membuat notifikasi untuk user ' . $user->id . ': ' . $e->getMessage());
        }
    }

    /** Catat email dengan status "antri" tanpa langsung mengirim. */
    public static function catatEmail(User $user, string $subjek, string $judul, array $baris, ?string $catatan = null, ?string $tombolTeks = null, ?string $tombolUrl = null, ?int $pengumumanId = null): ?EmailLog
    {
        try {
            return EmailLog::create([
                'user_id' => $user->id,
                'pengumuman_id' => $pengumumanId,
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
            return null;
        }
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

    /**
     * Kirim sebagian email yang masih "antri" setelah respons terkirim (maks. BATCH_ANTREAN).
     * Dipanggil saat broadcast dibuat dan setiap kali panel admin memeriksa status,
     * sehingga email massal terkirim bertahap tanpa queue worker / cron.
     */
    public static function prosesAntreanNanti(array $idSegera = []): void
    {
        if (EmailLog::kuotaHabisSampai() || !EmailLog::where('status', 'antri')->exists()) {
            return;
        }

        dispatch(function () use ($idSegera) {
            // Kunci agar dua permintaan tidak mengirim email yang sama bersamaan.
            $kunci = Cache::lock('proses-antrean-email', 300);
            if (!$kunci->get()) {
                return;
            }

            try {
                // Email biasa langsung dikirim oleh kirim()/jadwalkan(); yang baru disentuh
                // (< 60 detik) dilewati agar tidak terkirim ganda. $idSegera (email pengumuman
                // yang tidak dijadwalkan satu per satu) boleh langsung diambil.
                EmailLog::where('status', 'antri')
                    ->where(fn ($q) => $q->where('updated_at', '<', now()->subSeconds(60))
                        ->when($idSegera, fn ($w) => $w->orWhereIn('id', $idSegera)))
                    ->orderBy('id')
                    ->take(self::BATCH_ANTREAN)
                    ->get()
                    ->each(function (EmailLog $log) {
                        if (EmailLog::kuotaHabisSampai()) {
                            return false;
                        }
                        $log->kirimSekarang();
                    });
            } finally {
                $kunci->release();
            }
        })->afterResponse();
    }
}
