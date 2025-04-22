@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('sewa-mobil.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mobil_id">Mobil</label>
                <select class="form-control @error('mobil_id') is-invalid @enderror" id="mobil_id" name="mobil_id" required>
                    <option value="">- Pilih Mobil -</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->mobil_id }}" {{ old('mobil_id') == $mobil->mobil_id ? 'selected' : '' }}>
                            {{ $mobil->nama_mobil }} (Rp {{ number_format($mobil->tarif_sewa_per_hari, 0, ',', '.') }}/hari)
                        </option>
                    @endforeach
                </select>
                @error('mobil_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" class="form-control @error('nama_penyewa') is-invalid @enderror" id="nama_penyewa" name="nama_penyewa" value="{{ old('nama_penyewa') }}" required>
                <small class="form-text text-muted">Masukkan nama lengkap penyewa.</small>
                @error('nama_penyewa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_ktp">No. KTP</label>
                <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" pattern="[0-9]{16}" required>
                <small class="form-text text-muted">Masukkan 16 digit nomor KTP.</small>
                @error('no_ktp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_telepon">No. Telepon</label>
                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" pattern="[0-9]{10,13}" required>
                <small class="form-text text-muted">Format: 08xxxxxxxxxx (10-13 digit).</small>
                @error('no_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_sewa">Tanggal Sewa</label>
                <input type="date" class="form-control @error('tanggal_sewa') is-invalid @enderror" id="tanggal_sewa" name="tanggal_sewa" value="{{ old('tanggal_sewa') ?? date('Y-m-d') }}" required>
                @error('tanggal_sewa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali</label>
                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                @error('tanggal_kembali')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-control @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="belum lunas" {{ old('status_pembayaran') == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status_sewa">Status Sewa</label>
                <select class="form-control @error('status_sewa') is-invalid @enderror" id="status_sewa" name="status_sewa" required>
                    <option value="berlangsung" {{ old('status_sewa') == 'berjalan' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="selesai" {{ old('status_sewa') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status_sewa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('sewa-mobil.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection