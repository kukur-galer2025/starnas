<?php

namespace App\Models;

use App\Mail\NotifikasiPeserta;
use Illuminate\Database\Eloquent\Model;
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
     * Kirim email ini sekarang dan catat hasilnya (terkirim / gagal).
     * Mengulang otomatis sampai MAKS_PERCOBAAN bila SMTP sedang bermasalah.
     */
    public function kirimSekarang(): void
    {
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
                $this->update(['status' => 'gagal', 'error' => mb_substr($e->getMessage(), 0, 1000)]);
                Log::error("Gagal kirim email #{$this->id} ke {$this->email} (percobaan {$i}): " . $e->getMessage());

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
