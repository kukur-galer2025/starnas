<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sertifikat yang dibuat admin untuk Panitia, Pembicara, Moderator, Reviewer, dll.
     * Tidak perlu akun peserta maupun pembayaran.
     */
    public function up(): void
    {
        Schema::create('sertifikat_khusus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('peran', 50);
            $table->string('institusi')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('peran');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat_khusus');
    }
};
