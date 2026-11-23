<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pengumuman / broadcast dari admin ke kelompok peserta tertentu
     * (mis. link Zoom untuk peserta online, jadwal sesi untuk presenter).
     */
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('judul');
            $table->text('isi');
            $table->string('target', 40);
            $table->string('tautan')->nullable();
            $table->string('teks_tautan')->nullable();
            $table->boolean('kirim_email')->default(true);
            $table->unsignedInteger('jumlah_penerima')->default(0);
            $table->timestamps();
        });

        Schema::table('notifikasis', function (Blueprint $table) {
            $table->foreignId('pengumuman_id')->nullable()->after('user_id')
                ->constrained('pengumumans')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('notifikasis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pengumuman_id');
        });

        Schema::dropIfExists('pengumumans');
    }
};
