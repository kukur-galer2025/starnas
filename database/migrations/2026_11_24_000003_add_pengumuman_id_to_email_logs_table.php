<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Email pengumuman dikirim bertahap lewat antrean. Kaitkan ke pengumumannya agar,
     * bila pengumuman dihapus (mis. salah link Zoom), email yang belum terkirim ikut dibatalkan.
     */
    public function up(): void
    {
        Schema::table('email_logs', function (Blueprint $table) {
            $table->foreignId('pengumuman_id')->nullable()->after('user_id')
                ->constrained('pengumumans')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('email_logs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pengumuman_id');
        });
    }
};
