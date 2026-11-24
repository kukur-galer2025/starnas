<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel secara eksplisit karena berbeda dari konvensi plural Laravel.
     */
    protected $table = 'pembayaran'; // <<< TAMBAHKAN BARIS INI

    protected $fillable = [
        'user_id',
        'abstrak_id',
        'bukti_path',
        'status',
        'catatan_admin',
         // == TAMBAHKAN 3 BARIS INI ==
        'kategori_pembayaran',
        'nominal',
        'nomor_anggota_asasi',
        // ============================
    ];

    public const KATEGORI = [
        'asasi_onsite' => 'Anggota ASASI - Onsite',
        'umum_onsite' => 'Umum - Onsite',
        'mahasiswa_onsite' => 'Mahasiswa - Onsite',
        'asasi_online' => 'Anggota ASASI - Online',
        'umum_online' => 'Umum - Online',
        'mahasiswa_online' => 'Mahasiswa - Online',
        'non-presenter' => 'Non Presenter',
    ];

    public const STATUS = [
        'pending' => 'Menunggu',
        'verified' => 'Terverifikasi',
        'rejected' => 'Ditolak',
    ];

    public function labelKategori(): string
    {
        return self::KATEGORI[$this->kategori_pembayaran] ?? ucfirst((string) $this->kategori_pembayaran);
    }

    public function labelStatus(): string
    {
        return self::STATUS[$this->status] ?? ucfirst((string) $this->status);
    }

    /** Status yang masih "memakai" slot pembayaran (tidak boleh upload lagi). */
    public const STATUS_AKTIF = ['pending', 'verified'];

    public function isPemakalah(): bool
    {
        return $this->kategori_pembayaran !== 'non-presenter';
    }

    /**
     * Relasi: Pembayaran ini dimiliki oleh satu User (Peserta).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Abstrak yang dibayar (kategori pemakalah). Non Presenter: null. */
    public function abstrak()
    {
        return $this->belongsTo(Abstrak::class, 'abstrak_id');
    }
}