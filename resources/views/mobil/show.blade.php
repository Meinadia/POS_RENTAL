@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Mobil</th>
                        <td>{{ $mobil->nama_mobil }}</td>
                    </tr>
                    <tr>
                        <th>Foto Mobil</th>
                        <td>
                            @if($mobil->photo_mobil)
                                <img src="{{ asset('images/mobil/'.$mobil->photo_mobil) }}" width="200">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis Bahan Bakar</th>
                        <td>{{ $mobil->jenis_bahan_bakar }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas Mobil</th>
                        <td>{{ $mobil->kapasitas_mobil }} orang</td>
                    </tr>
                    <tr>
                        <th>Tarif Sewa per Hari</th>
                        <td>Rp {{ number_format($mobil->tarif_sewa_per_hari, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($mobil->status) }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tersedia</th>
                        <td>{{ $mobil->jumlah_tersedia }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('mobil.edit', $mobil->mobil_id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('mobil.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </div>
</div>
@endsection
