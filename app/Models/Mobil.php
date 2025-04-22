<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'm_daftar_mobil';
    protected $primaryKey = 'mobil_id';

    protected $fillable = [
        'nama_mobil',
        'photo_mobil',
        'jenis_bahan_bakar',
        'kapasitas_mobil',
        'tarif_sewa_per_hari',
        'status',
        'jumlah_tersedia',
    ];

    public function sewa()
    {
        return $this->hasMany(SewaMobil::class, 'mobil_id');
    }
}
