<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';

    protected $fillable = ['admin_id', 'judul', 'isi', 'target', 'tautan', 'teks_tautan', 'kirim_email', 'jumlah_penerima'];

    protected function casts(): array
    {
        return ['kirim_email' => 'boolean'];
    }

    /** Kelompok penerima yang bisa dipilih admin: key => label. */
    public const TARGET = [
        'semua' => 'Semua peserta',
        'terverifikasi' => 'Peserta dengan pembayaran terverifikasi',
        'onsite' => 'Pemakalah onsite (pembayaran terverifikasi)',
        'online' => 'Pemakalah online (pembayaran terverifikasi)',
        'non_presenter' => 'Non Presenter (pembayaran terverifikasi)',
        'presenter' => 'Presenter (abstrak diterima)',
        'belum_bayar' => 'Peserta yang belum membayar',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /** Isi pengumuman sebagai HTML aman: teks di-escape, baris baru dipertahankan, URL bisa diklik. */
    public function isiHtml(): HtmlString
    {
        $aman = e($this->isi);
        $aman = preg_replace(
            '~(https?://[^\s<]+)~i',
            '<a href="$1" target="_blank" rel="noopener" class="text-emerald-700 font-semibold underline break-all">$1</a>',
            $aman
        );

        return new HtmlString(nl2br($aman));
    }

    public function labelTarget(): string
    {
        return self::TARGET[$this->target] ?? $this->target;
    }

    /** Query peserta yang termasuk dalam target tertentu. */
    public static function queryPenerima(string $target): Builder
    {
        $peserta = User::query()->where('role', 'peserta');
        $bayarVerified = fn ($q) => $q->where('status', 'verified');

        return match ($target) {
            'terverifikasi' => $peserta->whereHas('pembayarans', $bayarVerified),
            'onsite' => $peserta->whereHas('pembayarans', fn ($q) => $q->where('status', 'verified')
                ->where('kategori_pembayaran', 'like', '%\_onsite')),
            'online' => $peserta->whereHas('pembayarans', fn ($q) => $q->where('status', 'verified')
                ->where('kategori_pembayaran', 'like', '%\_online')),
            'non_presenter' => $peserta->whereHas('pembayarans', fn ($q) => $q->where('status', 'verified')
                ->where('kategori_pembayaran', 'non-presenter')),
            'presenter' => $peserta->whereHas('abstraks', fn ($q) => $q->where('status_abstrak', 'diterima')),
            'belum_bayar' => $peserta->whereDoesntHave('pembayarans', $bayarVerified),
            default => $peserta,
        };
    }
}
