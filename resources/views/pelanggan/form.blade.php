@extends('layouts.app')

@section('title', isset($pelanggan) ? 'Edit Pelanggan' : 'Tambah Pelanggan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header mb-3">
            <a href="{{ route('pelanggan.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Data Pelanggan
            </a>
            <h1 class="page-title fs-4">
                {{ isset($pelanggan) ? 'Edit Data Pelanggan' : 'Tambah Pelanggan Baru' }}
            </h1>
        </div>

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <div class="fw-bold mb-1">Terjadi kesalahan input:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>
                    {{ isset($pelanggan) ? 'Perbarui Data Pelanggan: ' . $pelanggan->nama : 'Formulir Pelanggan Baru' }}
                </span>
            </div>
            <div class="card-body p-4">
                <form method="POST"
                      action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id_pelanggan) : route('pelanggan.store') }}">
                    @csrf
                    @isset($pelanggan)
                        @method('PUT')
                    @endisset

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Budi Santoso"
                               value="{{ old('nama', $pelanggan->nama ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="notelp" class="form-control" placeholder="Contoh: 081234567890"
                               value="{{ old('notelp', $pelanggan->notelp ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap pelanggan..." required>{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Catatan Khusus <span class="text-muted fw-normal small">(Opsional)</span></label>
                        <input type="text" name="catatan" class="form-control" placeholder="Contoh: Pisahkan pakaian putih"
                               value="{{ old('catatan', $pelanggan->catatan ?? '') }}">
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-custom-primary flex-fill">
                            {{ isset($pelanggan) ? 'Perbarui Data' : 'Simpan Data' }}
                        </button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-custom-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
