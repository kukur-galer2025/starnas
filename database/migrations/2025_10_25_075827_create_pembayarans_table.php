<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            // Kolom untuk menghubungkan ke tabel user (Peserta)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kolom untuk menyimpan nama file/path bukti pembayaran yang diupload
            $table->string('bukti_path'); 
            
            // Kolom Status Verifikasi oleh Admin: 
            // 'pending' (default), 'verified', 'rejected'
            $table->string('status')->default('pending');
            
            // Kolom Catatan Admin jika ada penolakan atau informasi lain
            $table->text('catatan_admin')->nullable();

            // Timestamp (created_at dan updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};