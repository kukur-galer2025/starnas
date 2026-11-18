<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne; // <-- Import Relasi HasOne
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'pekerjaan',
        'jenis_kelamin',
        'nomor_handphone',
        'provinsi',
        'institusi',
        'role',
        'google_id',
        // Kolom abstrak Dihapus karena dipindah ke Model Abstrak
    ];

    /**
     * Kolom profil yang wajib dilengkapi peserta setelah mendaftar.
     */
    public const PROFIL_WAJIB = ['nomor_handphone', 'jenis_kelamin', 'pekerjaan', 'institusi', 'provinsi'];

    public function profilLengkap(): bool
    {
        foreach (self::PROFIL_WAJIB as $kolom) {
            if (blank($this->{$kolom})) {
                return false;
            }
        }

        return true;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // ==========================================================
    // == RELASI BARU: One-to-One ke Tabel Abstracts ==
    // ==========================================================
    
    /**
     * Definisikan relasi one-to-one ke Model Abstrak.
     */
    public function abstrak(): HasOne
    {
        // Hubungan satu pengguna memiliki satu abstrak
        return $this->hasOne(Abstrak::class);
    }

    /**
     * Relasi one-to-many ke Model Abstrak (multi-abstrak, maks 3).
     */
    public function abstraks(): HasMany
    {
        return $this->hasMany(Abstrak::class);
    }
}