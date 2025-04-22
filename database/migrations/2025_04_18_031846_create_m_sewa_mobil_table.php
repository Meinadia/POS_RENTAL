<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_sewa_mobil', function (Blueprint $table) {
            $table->id('sewa_id');
            $table->unsignedBigInteger('mobil_id');
            $table->string('nama_penyewa', 100);
            $table->string('no_ktp', 20);
            $table->string('alamat', 255);
            $table->string('no_telepon', 15);
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_hari');
            $table->decimal('total_biaya', 10, 2);
            $table->string('status_pembayaran')->nullable();
            $table->string('status_sewa')->nullable();
            $table->timestamps();

            $table->foreign('mobil_id')->references('mobil_id')->on('m_daftar_mobil');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_sewa_mobil');
    }
};