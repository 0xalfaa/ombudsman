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
        Schema::create('data_pelapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_provinsi')->constrained('provinsi')->onDelete('restrict');
            $table->foreignId('id_kota_kabupaten')->constrained('kota_kabupaten')->onDelete('restrict');
            $table->foreignId('id_kecamatan')->constrained('kecamatan')->onDelete('restrict');
            $table->string('nama_pelapor', 100);
            $table->string('warga_negara', 50);
            $table->string('jenis_identitas', 50);
            $table->string('nomor_identitas', 16);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('status_perkawinan', 50);
            $table->string('pekerjaan', 100);
            $table->string('pendidikan_terakhir', 50);
            $table->text('alamat_lengkap');
            $table->string('nomor_telepon', 20);
            $table->string('email', 100);
            $table->enum('rahasia_data', ['Ya', 'Tidak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelapor');
    }
};
