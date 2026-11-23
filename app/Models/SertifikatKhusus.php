<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatKhusus extends Model
{
    protected $table = 'sertifikat_khusus';

    protected $fillable = ['nama', 'peran', 'institusi', 'admin_id'];

    /** Peran yang bisa dipilih admin (peserta biasa memakai sertifikat otomatis). */
    public const PERAN = ['Panitia', 'Pembicara', 'Moderator', 'Reviewer', 'Web Developer'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /** Nomor seri dibedakan dari sertifikat peserta dengan huruf K. */
    public function nomor(): string
    {
        return 'ASASI01122026-K' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }
}
