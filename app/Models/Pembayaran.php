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
        'bukti_path',
        'status',
        'catatan_admin',
         // == TAMBAHKAN 3 BARIS INI ==
        'kategori_pembayaran',
        'nominal',
        'nomor_anggota_asasi',
        // ============================
    ];

    /**
     * Relasi: Pembayaran ini dimiliki oleh satu User (Peserta).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}