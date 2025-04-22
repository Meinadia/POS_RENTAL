<?php

namespace App\Http\Controllers;

use App\Models\SewaMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SewaMobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Sewa Mobil',
            'list'  => ['Home', 'Sewa Mobil']
        ];

        $page = (object) [
            'title' => 'Daftar sewa mobil yang terdaftar dalam sistem'
        ];

        $activeMenu = 'sewa-mobil';

        $mobils = Mobil::all();

        return view('sewa-mobil.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'mobils' => $mobils
        ]);
    }

    public function list(Request $request)
{
    $sewas = SewaMobil::select('sewa_id', 'mobil_id', 'nama_penyewa', 'no_ktp', 'alamat', 'tanggal_sewa', 'tanggal_kembali', 'total_biaya', 'status_pembayaran', 'status_sewa')
                      ->with('mobil');

    // Filter data sewa berdasarkan mobil_id
    if ($request->mobil_id) {
        $sewas->where('mobil_id', $request->mobil_id);
    }

    return DataTables::of($sewas)
        ->addIndexColumn()
        ->addColumn('aksi', function ($sewa) {
            $btn = '<a href="' . url('/sewa-mobil/' . $sewa->sewa_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/sewa-mobil/' . $sewa->sewa_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/sewa-mobil/' . $sewa->sewa_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Sewa Mobil',
            'list'  => ['Home', 'Sewa Mobil', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah sewa mobil baru'
        ];

        $activeMenu = 'sewa-mobil';

        $mobils = Mobil::all();

        return view('sewa-mobil.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'mobils' => $mobils
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|integer',
            'nama_penyewa' => 'required|string|max:100',
            'no_ktp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'status_pembayaran' => 'required|string',
            'status_sewa' => 'required|string'
        ]);

        // Hitung total hari dan total biaya
        $mobil = Mobil::find($request->mobil_id);
        $tanggal_sewa = new \DateTime($request->tanggal_sewa);
        $tanggal_kembali = new \DateTime($request->tanggal_kembali);
        $total_hari = $tanggal_sewa->diff($tanggal_kembali)->days;
        $total_biaya = $total_hari * $mobil->tarif_sewa_per_hari;

        SewaMobil::create([
            'mobil_id' => $request->mobil_id,
            'nama_penyewa' => $request->nama_penyewa,
            'no_ktp' => $request->no_ktp,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_hari' => $total_hari,
            'total_biaya' => $total_biaya,
            'status_pembayaran' => $request->status_pembayaran,
            'status_sewa' => $request->status_sewa
        ]);

        return redirect('/sewa-mobil')->with('success', 'Data sewa mobil berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sewa = SewaMobil::with('mobil')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Sewa Mobil',
            'list'  => ['Home', 'Sewa Mobil', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail sewa mobil'
        ];

        $activeMenu = 'sewa-mobil';

        return view('sewa-mobil.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'sewa' => $sewa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sewa = SewaMobil::find($id);
        $mobils = Mobil::all();

        $breadcrumb = (object) [
            'title' => 'Edit Sewa Mobil',
            'list'  => ['Home', 'Sewa Mobil', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit sewa mobil'
        ];

        $activeMenu = 'sewa-mobil';

        return view('sewa-mobil.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'sewa' => $sewa,
            'mobils' => $mobils
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mobil_id' => 'required|integer',
            'nama_penyewa' => 'required|string|max:100',
            'no_ktp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'status_pembayaran' => 'required|string',
            'status_sewa' => 'required|string'
        ]);

        // Hitung total hari dan total biaya
        $mobil = Mobil::find($request->mobil_id);
        $tanggal_sewa = new \DateTime($request->tanggal_sewa);
        $tanggal_kembali = new \DateTime($request->tanggal_kembali);
        $total_hari = $tanggal_sewa->diff($tanggal_kembali)->days;
        $total_biaya = $total_hari * $mobil->tarif_sewa_per_hari;

        SewaMobil::where('sewa_id', $id)->update([
            'mobil_id' => $request->mobil_id,
            'nama_penyewa' => $request->nama_penyewa,
            'no_ktp' => $request->no_ktp,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_hari' => $total_hari,
            'total_biaya' => $total_biaya,
            'status_pembayaran' => $request->status_pembayaran,
            'status_sewa' => $request->status_sewa
        ]);

        return redirect('/sewa-mobil')->with('success', 'Data sewa mobil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = SewaMobil::find($id);

        if (!$check) {
            return redirect('/sewa-mobil')->with('error', 'Data sewa mobil tidak ditemukan');
        }

        try {
            SewaMobil::destroy($id);

            return redirect('/sewa-mobil')->with('success', 'Data sewa mobil berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sewa-mobil')->with('error', 'Data sewa mobil gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
