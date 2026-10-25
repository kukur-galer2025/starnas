<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abstracts', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel users
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            
            // Kolom Abstrak yang dipindahkan dari tabel users
            $table->string('judul_abstrak')->nullable();
            $table->string('file_abstrak_path')->nullable();
            $table->string('file_abstrak_original_name')->nullable();
            $table->enum('status_abstrak', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_reviewer_abstrak')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abstracts');
    }
};