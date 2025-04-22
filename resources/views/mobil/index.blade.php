@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('mobil.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Mobil
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_mobil">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Foto Mobil</th>
                        <th>Nama Mobil</th>
                        <th>Jenis Bahan Bakar</th>
                        <th class="text-center">Kapasitas</th>
                        <th class="text-center">Tarif Sewa</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tersedia</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan diisi oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('css')
    <!-- Tambahan CSS jika diperlukan -->
    <style>
        .table th {
            vertical-align: middle;
        }
        .img-thumbnail {
            width: 50px; /* Atur lebar gambar sesuai kebutuhan */
            height: auto; /* Menjaga proporsi gambar */
        }
    </style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataMobil = $('#table_mobil').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('mobil.list') }}",
                type: "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                {
                    data: "mobil_id",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "photo_mobil", // Mengambil data foto mobil
                    className: "text-center",
                    render: function(data) {
                        return `<img src="{{ asset('images/mobil') }}/${data}" class="img-thumbnail" alt="Foto Mobil">`; // Menampilkan gambar dari public/images/mobil/
                    }
                },
                { data: "nama_mobil" },
                { data: "jenis_bahan_bakar" },
                {
                    data: "kapasitas_mobil",
                    className: "text-center",
                    render: function(data) {
                        return data + ' orang';
                    }
                },
                {
                    data: "tarif_sewa_per_hari",
                    className: "text-right",
                    render: function(data) {
                        return 'Rp ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                },
                {
                    data: "status",
                    className: "text-center",
                    render: function(data) {
                    var badge = data === 'tersedia' ? 'badge-danger' : 'badge-success';
                        return '<span class="badge ' + badge + ' p-2 text-uppercase">' + data + '</span>';
                    }
                },
                {
                    data: "jumlah_tersedia",
                    className: "text-center"
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="mobil/${row.mobil_id}" class="btn btn-sm btn-info">
                                <span>Detail</span>
                            </a>
                            <a href="mobil/${row.mobil_id}/edit" class="btn btn-sm btn-warning">
                                <span>Edit</span>
                            </a>
                            <form action="mobil/${row.mobil_id}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                    <span>Hapus</span>
                                </button>
                            </form>
                        `;
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush