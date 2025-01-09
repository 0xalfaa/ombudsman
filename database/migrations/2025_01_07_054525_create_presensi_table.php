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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 36);
            $table->date('tanggal'); // Tanggal Presensi
            $table->time('waktu_masuk')->nullable(); // Waktu Masuk
            $table->time('waktu_keluar')->nullable(); // Waktu Keluar
            $table->text('keterangan')->nullable(); // Keterangan
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
