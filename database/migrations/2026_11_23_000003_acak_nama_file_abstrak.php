<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * File abstrak lama bernama "abstrak/abstrak_<waktu>_<id-peserta>.<ext>" di disk publik,
     * sehingga URL-nya mudah ditebak. Ganti nama menjadi acak (seperti bukti pembayaran)
     * lalu perbarui path di database. Aman dijalankan ulang: hanya menyentuh pola lama.
     */
    public function up(): void
    {
        $disk = Storage::disk('public');

        // Pola dicocokkan di PHP (REGEXP tidak tersedia di semua database, mis. SQLite untuk test)
        DB::table('abstracts')
            ->where('file_abstrak_path', 'like', 'abstrak/abstrak_%')
            ->orderBy('id')
            ->each(function ($row) use ($disk) {
                $lama = $row->file_abstrak_path;
                if (!preg_match('#^abstrak/abstrak_[0-9]+_[0-9]+\.[A-Za-z0-9]+$#', $lama)) {
                    return;
                }
                $ext = strtolower(pathinfo($lama, PATHINFO_EXTENSION));
                $baru = 'abstrak/abstrak_' . $row->user_id . '_' . Str::random(32) . '.' . $ext;

                if ($disk->exists($lama)) {
                    $disk->move($lama, $baru);
                } elseif (!$disk->exists($baru)) {
                    // File fisik tidak ada (mis. data lokal); biarkan path lama apa adanya.
                    return;
                }

                DB::table('abstracts')->where('id', $row->id)->update(['file_abstrak_path' => $baru]);
            });
    }

    public function down(): void
    {
        // Tidak dikembalikan: nama acak tetap valid dan lebih aman.
    }
};
