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
        Schema::create('data_terlapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelapor')->nullable()->constrained('data_pelapor')->onDelete('cascade');
            $table->string('nama_terlapor', 100);
            $table->string('jabatan_terlapor', 100);
            $table->string('instansi_terlapor', 100);
            $table->string('alamat_lengkap', 250);
            $table->foreignId('id_provinsi')->nullable()->constrained('provinsi')->onDelete('restrict');
            $table->foreignId('id_kota_kabupaten')->nullable()->constrained('kota_kabupaten')->onDelete('restrict');
            $table->foreignId('id_kecamatan')->nullable()->constrained('kecamatan')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_terlapor');
    }
};
