@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('mobil.update', $mobil->mobil_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_mobil">Nama Mobil</label>
                <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror" id="nama_mobil" name="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
                @error('nama_mobil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="photo_mobil">Foto Mobil</label>
                <input type="file" class="form-control-file @error('photo_mobil') is-invalid @enderror" id="photo_mobil" name="photo_mobil">
                <small class="form-text text-muted">Format yang diperbolehkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                @if($mobil->photo_mobil)
                    <img src="{{ asset('images/mobil/'.$mobil->photo_mobil) }}" width="100" class="mt-2">
                @endif
                @error('photo_mobil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis_bahan_bakar">Jenis Bahan Bakar</label>
                <input type="text" class="form-control @error('jenis_bahan_bakar') is-invalid @enderror" id="jenis_bahan_bakar" name="jenis_bahan_bakar" value="{{ old('jenis_bahan_bakar', $mobil->jenis_bahan_bakar) }}" required>
                @error('jenis_bahan_bakar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kapasitas_mobil">Kapasitas Mobil (orang)</label>
                <input type="number" class="form-control @error('kapasitas_mobil') is-invalid @enderror" id="kapasitas_mobil" name="kapasitas_mobil" value="{{ old('kapasitas_mobil', $mobil->kapasitas_mobil) }}" min="1" max="20" required>
                <small class="form-text text-muted">Masukkan angka 1-20.</small>
                @error('kapasitas_mobil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tarif_sewa_per_hari">Tarif Sewa per Hari (Rp)</label>
                <input type="number" class="form-control @error('tarif_sewa_per_hari') is-invalid @enderror" id="tarif_sewa_per_hari" name="tarif_sewa_per_hari" value="{{ old('tarif_sewa_per_hari', $mobil->tarif_sewa_per_hari) }}" min="50000" required>
                <small class="form-text text-muted">Minimal Rp 50.000.</small>
                @error('tarif_sewa_per_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="tersedia" {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }} class="bg-success text-green">Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $mobil->status) == 'tidak tersedia' ? 'selected' : '' }} class="bg-danger text-red">Tidak Tersedia</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah_tersedia">Jumlah Tersedia</label>
                <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror" id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia', $mobil->jumlah_tersedia) }}" min="0" required>
                <small class="form-text text-muted">Masukkan angka minimal 0.</small>
                @error('jumlah_tersedia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('mobil.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection