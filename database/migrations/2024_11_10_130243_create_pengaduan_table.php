<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->enum('sudah_lapor', ['Ya', 'Belum'])->nullable();
            $table->foreignId('id_pelapor')->nullable()->constrained('data_pelapor')->onDelete('cascade'); // Relasi ke tabel pelapor.
            $table->foreignId('id_terlapor')->nullable()->constrained('data_terlapor')->onDelete('cascade');
            $table->foreignId('id_kategori_pelapor')->nullable()->constrained('kategori_pelapor')->onDelete('restrict'); // Foreign key ke jenis_pelapor.
            $table->foreignId('id_jenis_pelapor')->nullable()->constrained('jenis_pelapor')->onDelete('restrict'); // Foreign key ke jenis_pelapor.
            $table->string('file_identitas')->nullable(); // Path file identitas.
            $table->string('file_bukti')->nullable();     // Path file bukti.
            $table->string('file_uraian')->nullable();    // Path file uraian.
            $table->date('tanggal_upaya')->nullable();    // Tanggal upaya terakhir.
            $table->enum('bukti_upaya', ['Ada', 'Tidak Ada'])->nullable();
            $table->string('perihal', 255)->nullable();   // Perihal pengaduan.
            $table->text('harapan_pelapor')->nullable();  // Harapan pelapor.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
