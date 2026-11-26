@extends('layouts.app')

@section('title', 'Detail Deterjen: ' . $deterjen->merek)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="page-header mb-3">
            <a href="{{ route('deterjens.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Daftar Deterjen
            </a>
            <h1 class="page-title fs-4">Detail Deterjen</h1>
        </div>

        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>Informasi Deterjen</span>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('deterjens.edit', $deterjen->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        Edit Data
                    </a>
                @endif
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-1">{{ $deterjen->merek }}</h4>
                    <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                        {{ $deterjen->jenis }}
                    </span>
                </div>

                <div class="list-group list-group-flush rounded-3 border">
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">Merek</span>
                        <span class="fw-semibold">{{ $deterjen->merek }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">Jenis Produk</span>
                        <span class="fw-semibold">{{ $deterjen->jenis }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">Supplier</span>
                        <span class="fw-semibold">{{ $deterjen->supplier }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">Tanggal Pembelian</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($deterjen->tanggal_pembelian)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-muted">Sisa Stok</span>
                        <span class="badge {{ $deterjen->stok <= 5 ? 'bg-danger' : 'bg-success' }} px-3 py-1 fs-6">
                            {{ $deterjen->stok }} item
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-2 text-center">
                    <a href="{{ route('deterjens.index') }}" class="btn btn-custom-secondary px-4">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
