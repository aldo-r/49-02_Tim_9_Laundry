@extends('layouts.app')

@section('title', 'Tambah Deterjen Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header mb-3">
            <a href="{{ route('deterjens.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Daftar Deterjen
            </a>
            <h1 class="page-title fs-4">Tambah Deterjen Baru</h1>
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
                <span>Formulir Data Deterjen</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('deterjens.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Merek Produk <span class="text-danger">*</span></label>
                        <input type="text" name="merek" class="form-control" placeholder="Contoh: Rinso Matic" value="{{ old('merek') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Bahan <span class="text-danger">*</span></label>
                        <input type="text" name="jenis" class="form-control" placeholder="Contoh: Deterjen Cair / Pelembut / Pewangi" value="{{ old('jenis') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Supplier <span class="text-danger">*</span></label>
                        <input type="text" name="supplier" class="form-control" placeholder="Contoh: PT Unilever Indonesia" value="{{ old('supplier') }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal_pembelian', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control" placeholder="0" min="0" value="{{ old('stok', 0) }}" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-custom-primary flex-fill">
                            Simpan Deterjen
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
