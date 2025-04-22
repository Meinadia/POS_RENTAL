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
                        <th>Nama Penyewa</th>
                        <td>{{ $sewa->nama_penyewa }}</td>
                    </tr>
                    <tr>
                        <th>No. KTP</th>
                        <td>{{ $sewa->no_ktp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $sewa->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $sewa->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Mobil</th>
                        <td>{{ $sewa->mobil->nama_mobil }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Sewa</th>
                        <td>{{ $sewa->tanggal_sewa }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ $sewa->tanggal_kembali }}</td>
                    </tr>
                    <tr>
                        <th>Total Hari</th>
                        <td>{{ $sewa->total_hari }} hari</td>
                    </tr>
                    <tr>
                        <th>Total Biaya</th>
                        <td>Rp {{ number_format($sewa->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>{{ ucfirst(str_replace('_', ' ', $sewa->status_pembayaran)) }}</td>
                    </tr>
                    <tr>
                        <th>Status Sewa</th>
                        <td>{{ ucfirst($sewa->status_sewa) }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('sewa-mobil.edit', $sewa->sewa_id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('sewa-mobil.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </div>
</div>
@endsection