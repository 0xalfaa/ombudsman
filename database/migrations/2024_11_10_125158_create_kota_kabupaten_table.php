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
        Schema::create('kota_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_provinsi')->constrained('provinsi')->onDelete('cascade');
            $table->string('nama_kota_kabupaten', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kota_kabupaten');
    }
};
