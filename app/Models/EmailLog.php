<?php

namespace App\Models;

use App\Mail\NotifikasiPeserta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailLog extends Model
{
    public const MAKS_PERCOBAAN = 3;

    protected $fillable = [
        'user_id',
        'email',
        'subjek',
        'payload',
        'status',
        'percobaan',
        'error',
        'terkirim_at',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'terkirim_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Penanda di cache saat server email menolak karena kuota harian habis
     * (mis. Gmail "550 5.4.5 Daily user sending limit exceeded", atau batas Hostinger). Selama penanda
     * aktif, pengiriman ditunda agar tidak terus menabrak batas yang sama.
     */
    public const CACHE_KUOTA_HABIS = 'email_kuota_habis_sampai';
    public const JEDA_KUOTA_MENIT = 60;
    public const PESAN_KUOTA = 'Kuota kirim akun email pengirim sudah habis (batas dari penyedia email). Email ditunda, kirim ulang setelah kuota pulih.';

    /** Waktu sampai kapan pengiriman ditunda karena kuota habis, atau null. */
    public static function kuotaHabisSampai(): ?Carbon
    {
        $sampai = Cache::get(self::CACHE_KUOTA_HABIS);

        return $sampai && now()->lt($sampai) ? Carbon::parse($sampai) : null;
    }

    private static function errorKuota(\Throwable $e): bool
    {
        $pesan = $e->getMessage();

        return str_contains($pesan, '5.4.5')
            || stripos($pesan, 'limit exceeded') !== false
            || stripos($pesan, 'quota exceeded') !== false
            || stripos($pesan, 'ratelimit') !== false
            || stripos($pesan, 'rate limit') !== false;
    }

    /**
     * Kirim email ini sekarang dan catat hasilnya (terkirim / gagal).
     * Mengulang otomatis sampai MAKS_PERCOBAAN bila SMTP sedang bermasalah,
     * kecuali kuota harian habis (mengulang tidak ada gunanya).
     */
    public function kirimSekarang(): void
    {
        if (self::kuotaHabisSampai()) {
            $this->update(['status' => 'gagal', 'error' => self::PESAN_KUOTA]);
            return;
        }

        $p = $this->payload;
        $mail = new NotifikasiPeserta(
            '[STARNAS ASASI 2026] ' . $this->subjek,
            $p['nama'] ?? 'Peserta',
            $p['judul'] ?? $this->subjek,
            $p['baris'] ?? [],
            $p['catatan'] ?? null,
            $p['tombol_teks'] ?? null,
            $p['tombol_url'] ?? null,
        );

        for ($i = 1; $i <= self::MAKS_PERCOBAAN; $i++) {
            $this->increment('percobaan');

            try {
                Mail::to($this->email)->send($mail);
                $this->update(['status' => 'terkirim', 'error' => null, 'terkirim_at' => now()]);
                return;
            } catch (\Throwable $e) {
                Log::error("Gagal kirim email #{$this->id} ke {$this->email} (percobaan {$i}): " . $e->getMessage());

                if (self::errorKuota($e)) {
                    Cache::put(self::CACHE_KUOTA_HABIS, now()->addMinutes(self::JEDA_KUOTA_MENIT)->toIso8601String(), now()->addMinutes(self::JEDA_KUOTA_MENIT));
                    $this->update(['status' => 'gagal', 'error' => self::PESAN_KUOTA]);
                    return;
                }

                $this->update(['status' => 'gagal', 'error' => mb_substr($e->getMessage(), 0, 1000)]);

                if ($i < self::MAKS_PERCOBAAN) {
                    sleep($i * 2);
                }
            }
        }
    }

    public function labelStatus(): array
    {
        return match ($this->status) {
            'terkirim' => ['Terkirim', 'bg-emerald-100 text-emerald-700', 'fa-circle-check'],
            'gagal' => ['Gagal', 'bg-red-100 text-red-700', 'fa-circle-xmark'],
            default => ['Mengirim...', 'bg-amber-100 text-amber-700', 'fa-spinner fa-spin'],
        };
    }
}
