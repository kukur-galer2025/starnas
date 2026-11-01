<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('email');
            $table->string('subjek');
            // Isi email disimpan agar bisa dikirim ulang dari panel admin
            $table->json('payload');
            $table->enum('status', ['antri', 'terkirim', 'gagal'])->default('antri')->index();
            $table->unsignedTinyInteger('percobaan')->default(0);
            $table->text('error')->nullable();
            $table->timestamp('terkirim_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
