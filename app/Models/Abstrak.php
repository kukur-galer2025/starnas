<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstrak extends Model
{
    use HasFactory;
    
    // Nama tabel di database
    protected $table = 'abstracts';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'user_id',
        'judul_abstrak',
        'penulis',
        'file_abstrak_path',
        'file_abstrak_original_name',
        'status_abstrak', // pending, diterima, ditolak
        'catatan_reviewer_abstrak',
    ];

    // Relasi one-to-one ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Setiap abstrak yang dipresentasikan dibayar terpisah
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'abstrak_id');
    }

    /** Pembayaran terbaru untuk abstrak ini (status bayar yang berlaku). */
    public function pembayaranTerakhir()
    {
        return $this->hasOne(Pembayaran::class, 'abstrak_id')->latestOfMany();
    }
}