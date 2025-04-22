<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\SewaMobil;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $mobilDisewa = SewaMobil::whereDate('tanggal_sewa', today())->count();
        $penyewaAktif = SewaMobil::distinct('nama_penyewa')->count('nama_penyewa');
        $pendapatanBulanIni = SewaMobil::whereMonth('tanggal_sewa', date('m'))
                                     ->sum('total_biaya');

        $recentRentals = SewaMobil::with('mobil')
                                ->orderBy('sewa_id', 'desc')
                                ->take(5)
                                ->get();

        return view('welcome', compact(
            'totalMobil',
            'mobilDisewa',
            'penyewaAktif',
            'pendapatanBulanIni',
            'recentRentals'
        ));
    }
}