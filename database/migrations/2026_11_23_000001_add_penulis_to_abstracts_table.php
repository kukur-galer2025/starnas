<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Nama seluruh penulis naskah (dicantumkan di LoA). Kosong pada data lama:
     * LoA memakai nama pengunggah sebagai gantinya.
     */
    public function up(): void
    {
        Schema::table('abstracts', function (Blueprint $table) {
            $table->text('penulis')->nullable()->after('judul_abstrak');
        });
    }

    public function down(): void
    {
        Schema::table('abstracts', function (Blueprint $table) {
            $table->dropColumn('penulis');
        });
    }
};
