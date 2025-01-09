<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kronologi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')
                  ->constrained('pengaduan') // Menghubungkan ke tabel pengaduan
                  ->onDelete('cascade'); // Menghapus kronologi jika pengaduan dihapus
            $table->text('deskripsi_kronologi'); // Deskripsi kronologi kejadian
            $table->date('tanggal_kronologi'); // Tanggal kejadian
            $table->text('catatan_bukti'); // Catatan bukti terkait kejadian
            $table->timestamps(); // Untuk menyimpan created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kronologi');
    }
};
