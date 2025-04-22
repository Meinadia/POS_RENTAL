<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SewaMobilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_sewa_mobil')->insert([
            [
                'mobil_id' => 1,
                'nama_penyewa' => 'Rizky Maulana',
                'no_ktp' => '3517001234567890',
                'alamat' => 'Jl. Soekarno Hatta No. 12, Malang',
                'no_telepon' => '081234567890',
                'tanggal_sewa' => '2025-04-15',
                'tanggal_kembali' => '2025-04-17',
                'total_hari' => 3,
                'total_biaya' => 1200000,
                'status_pembayaran' => 'Lunas',
                'status_sewa' => 'Selesai',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'mobil_id' => 2,
                'nama_penyewa' => 'Andi Wijaya',
                'no_ktp' => '3517009876543210',
                'alamat' => 'Jl. Ciliwung No. 8, Surabaya',
                'no_telepon' => '082345678901',
                'tanggal_sewa' => '2025-04-18',
                'tanggal_kembali' => '2025-04-19',
                'total_hari' => 2,
                'total_biaya' => 760000,
                'status_pembayaran' => 'Belum Lunas',
                'status_sewa' => 'Berlangsung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
