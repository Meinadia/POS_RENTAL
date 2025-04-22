<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaMobil extends Model
{
    use HasFactory;

    protected $table = 'm_sewa_mobil';
    protected $primaryKey = 'sewa_id';

    protected $fillable = [
        'mobil_id',
        'nama_penyewa',
        'no_ktp',
        'alamat',
        'no_telepon',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_hari',
        'total_biaya',
        'status_pembayaran',
        'status_sewa',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}