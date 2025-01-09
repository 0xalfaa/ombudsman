<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255); // Kolom untuk judul berita
            $table->string('deskripsi', 255); // Kolom untuk konten berita
            $table->string('penulis', 100)->nullable(); // Kolom untuk nama penulis
            $table->string('gambar')->nullable(); // Kolom untuk menyimpan URL atau path gambar
            $table->timestamp('tanggal')->nullable(); // Kolom untuk tanggal terbit berita
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita');
    }
};
