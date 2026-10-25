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
    Schema::table('pembayaran', function (Blueprint $table) {
        $table->string('kategori_pembayaran')->after('status');
        $table->decimal('nominal', 10, 2)->after('kategori_pembayaran');
        $table->string('nomor_anggota_asasi')->nullable()->after('nominal');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            //
        });
    }
};
