<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Mobil',
            'list'  => ['Home', 'Mobil']
        ];
    
        $page = (object) [
            'title' => 'Daftar mobil yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'mobil';
    
        return view('mobil.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
{
    $mobils = Mobil::select('mobil_id', 'nama_mobil', 'photo_mobil', 'jenis_bahan_bakar', 'kapasitas_mobil', 'tarif_sewa_per_hari', 'status', 'jumlah_tersedia');

    return DataTables::of($mobils)
        ->addIndexColumn()
        ->addColumn('foto', function ($mobil) {
            if ($mobil->photo_mobil) {
                $path = str_contains($mobil->photo_mobil, 'http') ? 
                    $mobil->photo_mobil : 
                    asset('images/mobil/' . $mobil->photo_mobil);
                return '<img src="'.$path.'" class="img-thumbnail" width="80" alt="Foto Mobil">';
            }
            return '<span class="text-muted">Tidak ada foto</span>';
        })
        ->addColumn('aksi', function ($mobil) {
            $btn = '<a href="' . url('/mobil/' . $mobil->mobil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/mobil/' . $mobil->mobil_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/mobil/' . $mobil->mobil_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['foto', 'aksi'])
        ->make(true);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Mobil',
            'list'  => ['Home', 'Mobil', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah mobil baru'
        ];

        $activeMenu = 'mobil';

        return view('mobil.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'photo_mobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenis_bahan_bakar' => 'required|string',
            'kapasitas_mobil' => 'required|integer',
            'tarif_sewa_per_hari' => 'required|numeric',
            'status' => 'required|string',
            'jumlah_tersedia' => 'required|integer'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('photo_mobil')) {
            $imageName = time().'.'.$request->photo_mobil->extension();  
            $request->photo_mobil->move(public_path('images/mobil'), $imageName);
            $data['photo_mobil'] = $imageName;
        }

        Mobil::create($data);

        return redirect('/mobil')->with('success', 'Data mobil berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mobil = Mobil::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Mobil',
            'list'  => ['Home', 'Mobil', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail mobil'
        ];

        $activeMenu = 'mobil';

        return view('mobil.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'mobil' => $mobil]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Mobil::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Mobil',
            'list'  => ['Home', 'Mobil', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit mobil'
        ];

        $activeMenu = 'mobil';

        return view('mobil.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'mobil' => $mobil]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'photo_mobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenis_bahan_bakar' => 'required|string',
            'kapasitas_mobil' => 'required|integer',
            'tarif_sewa_per_hari' => 'required|numeric',
            'status' => 'required|string',
            'jumlah_tersedia' => 'required|integer'
        ]);

        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('photo_mobil')) {
            $imageName = time().'.'.$request->photo_mobil->extension();  
            $request->photo_mobil->move(public_path('images/mobil'), $imageName);
            $data['photo_mobil'] = $imageName;
        }

        Mobil::where('mobil_id', $id)->update($data);

        return redirect('/mobil')->with('success', 'Data mobil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Mobil::find($id);

        if (!$check) {
            return redirect('/mobil')->with('error', 'Data mobil tidak ditemukan');
        }

        try {
            Mobil::destroy($id);

            return redirect('/mobil')->with('success', 'Data mobil berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/mobil')->with('error', 'Data mobil gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}