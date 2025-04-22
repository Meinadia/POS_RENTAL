<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_daftar_mobil', function (Blueprint $table) {
            $table->id('mobil_id');
            $table->string('nama_mobil', 100);
            $table->string('photo_mobil')->nullable();
            $table->string('jenis_bahan_bakar', 50);
            $table->integer('kapasitas_mobil');
            $table->integer('tarif_sewa_per_hari');
            $table->string('status')->nullable();
            $table->integer('jumlah_tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_daftar_mobil');
    }
};