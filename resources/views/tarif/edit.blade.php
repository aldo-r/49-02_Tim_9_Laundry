@extends('layouts.app')

@section('title', 'Edit Paket Tarif: ' . $tarif->nama_paket)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header mb-3">
            <a href="{{ route('tarif.index', $tarif->id_layanan) }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Daftar Tarif
            </a>
            <h1 class="page-title fs-4">Edit Paket Tarif</h1>
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
                    Perbarui Paket: <strong>{{ $tarif->nama_paket }}</strong>
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tarif.update', $tarif->id_tarif) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" name="nama_paket" class="form-control"
                               maxlength="50" value="{{ old('nama_paket', $tarif->nama_paket) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Biaya / Harga (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Rp</span>
                            <input type="number" name="harga" class="form-control"
                                   min="0" value="{{ old('harga', $tarif->harga) }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Estimasi Waktu Pengerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="estimasi_waktu" class="form-control"
                               maxlength="20" placeholder="Contoh: 2 Hari"
                               value="{{ old('estimasi_waktu', $tarif->estimasi_waktu) }}" required>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-custom-primary flex-fill">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('tarif.index', $tarif->id_layanan) }}" class="btn btn-custom-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
