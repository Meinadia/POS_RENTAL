<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_daftar_mobil')->insert([
            [
                'nama_mobil' => 'Toyota Avanza',
                'photo_mobil' => 'foto-mobil/avanza.jpg',
                'jenis_bahan_bakar' => 'Bensin',
                'kapasitas_mobil' => 7,
                'tarif_sewa_per_hari' => 400000,
                'status' => 'Tersedia',
                'jumlah_tersedia' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_mobil' => 'Daihatsu Xenia',
                'photo_mobil' => 'foto-mobil/xenia.jpg',
                'jenis_bahan_bakar' => 'Bensin',
                'kapasitas_mobil' => 7,
                'tarif_sewa_per_hari' => 380000,
                'status' => 'Tersedia',
                'jumlah_tersedia' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_mobil' => 'Hyundai Ioniq 5',
                'photo_mobil' => 'foto-mobil/ioniq.jpg',
                'jenis_bahan_bakar' => 'Listrik',
                'kapasitas_mobil' => 5,
                'tarif_sewa_per_hari' => 700000,
                'status' => 'Tersedia',
                'jumlah_tersedia' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
