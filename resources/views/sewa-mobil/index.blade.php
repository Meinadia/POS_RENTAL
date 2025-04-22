@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('sewa-mobil.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Sewa
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
        
        <div class="form-group row">
            <label class="col-1 control-label col-form-label">Filter:</label>
            <div class="col-3">
                <select class="form-control" id="mobil_id" name="mobil_id">
                    <option value="">- Semua Mobil -</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->mobil_id }}">{{ $mobil->nama_mobil }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_sewa">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nama Penyewa</th>
                        <th>No. KTP</th>
                        <th>Alamat</th>
                        <th>Mobil</th>
                        <th class="text-center">Tanggal Sewa</th>
                        <th class="text-center">Tanggal Kembali</th>
                        <th class="text-center">Total Biaya</th>
                        <th class="text-center">Status Pembayaran</th>
                        <th class="text-center">Status Sewa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
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
    </style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataSewa = $('#table_sewa').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('sewa-mobil.list') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.mobil_id = $('#mobil_id').val();
                }
            },
            columns: [
                {
                    data: "sewa_id",
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: "nama_penyewa" },
                { data: "no_ktp" },
                { 
                    data: "alamat",
                    render: function(data) {
                        return data.length > 30 ? data.substring(0, 30) + '...' : data;
                    }
                },
                { data: "mobil.nama_mobil" },
                { 
                    data: "tanggal_sewa",
                    className: "text-center",
                    render: function(data) {
                        return new Date(data).toLocaleDateString('id-ID');
                    }
                },
                { 
                    data: "tanggal_kembali",
                    className: "text-center",
                    render: function(data) {
                        return new Date(data).toLocaleDateString('id-ID');
                    }
                },
                {
                    data: "total_biaya",
                    className: "text-right",
                    render: function(data) {
                        return 'Rp ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                },
                {
                    data: "status_pembayaran",
                    className: "text-center",
                    render: function(data) {
                        var badge = data === 'lunas' ? 'badge-success' : 'badge-warning';
                        return '<span class="badge ' + badge + '">' + data + '</span>';
                    }
                },
                {
                    data: "status_sewa",
                    className: "text-center",
                    render: function(data) {
                        var badge = data === 'selesai' ? 'badge-success' : 
                                  (data === 'berlangsung' ? 'badge-primary' : 'badge-secondary');
                        return '<span class="badge ' + badge + '">' + data + '</span>';
                    }
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="sewa-mobil/${row.sewa_id}" class="btn btn-sm btn-info">
                                <span>Detail</span>
                            </a>
                            <a href="sewa-mobil/${row.sewa_id}/edit" class="btn btn-sm btn-warning">
                                <span>Edit</span>
                            </a>
                            <form action="sewa-mobil/${row.sewa_id}" method="POST" style="display:inline">
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

        $('#mobil_id').on('change', function() {
            dataSewa.ajax.reload();
        });
    });
</script>
@endpush