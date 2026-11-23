<?php

namespace App\Support;

use App\Models\Abstrak;
use App\Models\Pembayaran;
use App\Models\User;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

/**
 * Kode verifikasi dokumen (sertifikat & LoA) untuk QR code.
 *
 * Format kode: <tipe>-<id>-<tanda>, mis. "S-12-9f3a1c7b2e4d".
 *   tipe  S = sertifikat peserta (id = user), L = LoA (id = abstrak)
 *   tanda = HMAC dari APP_KEY, sehingga kode tidak bisa ditebak / dipalsukan
 *           tanpa menyimpan apa pun di database.
 */
class Verifikasi
{
    private const PANJANG_TANDA = 12;

    public static function kode(string $tipe, int $id): string
    {
        return $tipe . '-' . $id . '-' . self::tanda($tipe, $id);
    }

    public static function url(string $tipe, int $id): string
    {
        return route('verifikasi', self::kode($tipe, $id));
    }

    /** QR code berisi URL verifikasi, sebagai data URI (PNG bila GD tersedia, SVG bila tidak). */
    public static function qr(string $tipe, int $id): string
    {
        $png = extension_loaded('gd');

        $options = new QROptions([
            'outputType' => $png ? QROutputInterface::GDIMAGE_PNG : QROutputInterface::MARKUP_SVG,
            'outputBase64' => true,
            'eccLevel' => EccLevel::M,
            'scale' => 8,
            'quietzoneSize' => 1,
        ]);

        return (new QRCode($options))->render(self::url($tipe, $id));
    }

    /**
     * Cek sebuah kode. Mengembalikan data dokumen bila asli & masih berlaku, atau null.
     *
     * @return array{tipe:string, judul:string, baris:array<string,string>}|null
     */
    public static function periksa(string $kode): ?array
    {
        if (!preg_match('/^([SL])-(\d+)-([a-f0-9]{' . self::PANJANG_TANDA . '})$/', $kode, $m)) {
            return null;
        }

        [, $tipe, $id, $tanda] = $m;
        if (!hash_equals(self::tanda($tipe, (int) $id), $tanda)) {
            return null;
        }

        return match ($tipe) {
            'S' => self::dataSertifikat((int) $id),
            'L' => self::dataLoa((int) $id),
        };
    }

    private static function dataSertifikat(int $userId): ?array
    {
        $user = User::find($userId);
        $bayar = $user ? Pembayaran::where('user_id', $user->id)->where('status', 'verified')->latest()->first() : null;
        if (!$user || !$bayar) {
            return null;
        }

        return [
            'tipe' => 'Sertifikat',
            'judul' => 'Sertifikat Penghargaan STARNAS ASASI 2026',
            'baris' => [
                'Nomor' => self::nomorSertifikat($user->id),
                'Nama' => $user->nama_lengkap,
                'Peran' => self::peranPeserta($user, $bayar),
                'Institusi' => $user->institusi ?: '-',
                'Acara' => '1–2 Desember 2026, The Malioboro Hotel, Yogyakarta',
            ],
        ];
    }

    private static function dataLoa(int $abstrakId): ?array
    {
        $abstrak = Abstrak::with('user')->find($abstrakId);
        if (!$abstrak || $abstrak->status_abstrak !== 'diterima' || !$abstrak->user) {
            return null;
        }

        return [
            'tipe' => 'Letter of Acceptance',
            'judul' => 'Letter of Acceptance STARNAS ASASI 2026',
            'baris' => [
                'ID Naskah' => self::idNaskah($abstrak->id),
                'Judul Naskah' => $abstrak->judul_abstrak,
                'Penulis' => $abstrak->penulis ?: $abstrak->user->nama_lengkap,
                'Diterima' => $abstrak->updated_at?->locale('id')->translatedFormat('j F Y') ?? '-',
            ],
        ];
    }

    public static function nomorSertifikat(int $userId): string
    {
        return 'ASASI01122026-' . str_pad($userId, 4, '0', STR_PAD_LEFT);
    }

    public static function idNaskah(int $abstrakId): string
    {
        return 'STARNAS-2026-' . str_pad($abstrakId, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Peran di sertifikat ditentukan sistem (bukan dipilih peserta):
     * Presenter bila punya abstrak diterima DAN membayar kategori pemakalah.
     */
    public static function peranPeserta(User $user, Pembayaran $bayar): string
    {
        $adaDiterima = Abstrak::where('user_id', $user->id)->where('status_abstrak', 'diterima')->exists();

        return ($adaDiterima && $bayar->kategori_pembayaran !== 'non-presenter') ? 'Presenter' : 'Peserta Seminar';
    }

    private static function tanda(string $tipe, int $id): string
    {
        return substr(hash_hmac('sha256', 'verifikasi|' . $tipe . '|' . $id, (string) config('app.key')), 0, self::PANJANG_TANDA);
    }
}
