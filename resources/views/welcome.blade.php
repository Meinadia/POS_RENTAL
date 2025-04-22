@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMobil }}</h3>
                    <p>Total Mobil Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
                <a href="{{ route('mobil.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $mobilDisewa }}</h3>
                    <p>Mobil Disewa Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <a href="{{ route('sewa-mobil.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $penyewaAktif }}</h3>
                    <p>Penyewa Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                    <p>Pendapatan Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Recent Rentals Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Penyewaan Terbaru</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRentals as $index => $rental)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $rental->sewa_id }}</td>
                                <td>{{ $rental->nama_penyewa }}</td>
                                <td>{{ $rental->mobil->nama_mobil }}</td>
                                <td>{{ $rental->tanggal_sewa }}</td>
                                <td><span class="badge {{ $rental->status_sewa == 'sedang disewa' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($rental->status_sewa) }}</span></td>
                                <td>
                                    <a href="{{ route('sewa-mobil.show', $rental->sewa_id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class ="card-footer clearfix">
                    <a href="{{ route('sewa-mobil.index') }}" class="btn btn-sm btn-secondary float-right">View All</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function() {
        // Initialize any additional scripts if needed
    });
</script>
@endpush

@endsection