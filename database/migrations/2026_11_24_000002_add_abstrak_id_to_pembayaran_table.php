<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pembayaran pemakalah kini per abstrak (peserta bisa punya hingga 3 abstrak,
     * masing-masing dibayar terpisah). Non Presenter tetap tanpa abstrak.
     */
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreignId('abstrak_id')->nullable()->after('user_id')
                ->constrained('abstracts')->nullOnDelete();
        });

        // Data lama (1 pembayaran per peserta): kaitkan ke abstrak yang paling awal diterima,
        // atau abstrak paling awal bila belum ada yang diterima.
        DB::table('pembayaran')
            ->whereNull('abstrak_id')
            ->where('kategori_pembayaran', '!=', 'non-presenter')
            ->orderBy('id')
            ->get(['id', 'user_id'])
            ->each(function ($bayar) {
                $sudahDipakai = DB::table('pembayaran')->whereNotNull('abstrak_id')->pluck('abstrak_id');

                $abstrakId = DB::table('abstracts')
                    ->where('user_id', $bayar->user_id)
                    ->whereNotIn('id', $sudahDipakai)
                    ->orderByRaw("case when status_abstrak = 'diterima' then 0 else 1 end")
                    ->orderBy('id')
                    ->value('id');

                if ($abstrakId) {
                    DB::table('pembayaran')->where('id', $bayar->id)->update(['abstrak_id' => $abstrakId]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropConstrainedForeignId('abstrak_id');
        });
    }
};
