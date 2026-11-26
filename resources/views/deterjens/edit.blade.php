@extends('layouts.app')

@section('title', 'Edit Data Deterjen')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header mb-3">
            <a href="{{ route('deterjens.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Daftar Deterjen
            </a>
            <h1 class="page-title fs-4">Edit Data Deterjen</h1>
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
                <span>Perbarui Data Deterjen: <strong>{{ $deterjen->merek }}</strong></span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('deterjens.update', $deterjen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Merek Produk <span class="text-danger">*</span></label>
                        <input type="text" name="merek" value="{{ old('merek', $deterjen->merek) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Bahan <span class="text-danger">*</span></label>
                        <input type="text" name="jenis" value="{{ old('jenis', $deterjen->jenis) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Supplier <span class="text-danger">*</span></label>
                        <input type="text" name="supplier" value="{{ old('supplier', $deterjen->supplier) }}" class="form-control" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_pembelian" value="{{ old('tanggal_pembelian', $deterjen->tanggal_pembelian) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok', $deterjen->stok) }}" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-custom-primary flex-fill">
                            Perbarui Data
                        </button>
                        <a href="{{ route('deterjens.index') }}" class="btn btn-custom-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
