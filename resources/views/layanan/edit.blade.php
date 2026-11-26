@extends('layouts.app')

@section('title', 'Edit Layanan: ' . $layanan->nama_layanan)

@section('content')
<div class="page-header mb-3">
    <a href="{{ route('layanan.kelola') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
        &larr; Kembali ke Kelola Layanan
    </a>
    <h1 class="page-title fs-4">
        Edit Layanan: {{ $layanan->nama_layanan }}
    </h1>
    <p class="page-subtitle">Ubah informasi layanan dan perbarui harga paket tarif yang terkait secara langsung.</p>
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

<form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="post">
    @csrf
    @method('PUT')

    <div class="row g-4">
        {{-- Data Layanan --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <span>Informasi Pokok Layanan</span>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select" required>
                                <option value="kiloan" @selected($layanan->kategori == 'kiloan')>Kiloan</option>
                                <option value="self service" @selected($layanan->kategori == 'self service')>Self Service</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_layanan" class="form-control"
                                   maxlength="30" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Minimal (Kg) <span class="text-danger">*</span></label>
                            <input type="number" name="minimal_kg" class="form-control"
                                   step="0.01" min="0.01"
                                   value="{{ old('minimal_kg', (float) $layanan->minimal_kg) }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Paket Tarif Terkait --}}
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <span>Daftar Paket Tarif Layanan</span>
                    <a href="{{ route('tarif.index', $layanan->id_layanan) }}" class="btn btn-outline-info btn-sm rounded-pill px-3">
                        + Tambah / Hapus Paket Tarif
                    </a>
                </div>
                <div class="card-body p-4">
                    @if ($layanan->tarifs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-custom table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th style="width: 250px;">Harga (Rp)</th>
                                        <th style="width: 250px;">Estimasi Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($layanan->tarifs as $t)
                                    <tr>
                                        <td>
                                            <input type="text" name="nama_paket[{{ $t->id_tarif }}]"
                                                   class="form-control"
                                                   maxlength="50" value="{{ $t->nama_paket }}" required>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">Rp</span>
                                                <input type="number" name="harga[{{ $t->id_tarif }}]"
                                                       class="form-control"
                                                       min="0" value="{{ $t->harga }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="estimasi_waktu[{{ $t->id_tarif }}]"
                                                   class="form-control"
                                                   maxlength="20" value="{{ $t->estimasi_waktu }}" placeholder="Contoh: 2 Hari" required>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            Layanan ini belum memiliki paket tarif. Klik tombol "Tambah / Hapus Paket Tarif" di atas untuk menambahkan.
                        </div>
                    @endif

                    <div class="d-flex gap-2 pt-3 mt-3 border-top">
                        <button type="submit" class="btn btn-custom-primary">
                            Simpan Seluruh Perubahan
                        </button>
                        <a href="{{ route('layanan.kelola') }}" class="btn btn-custom-secondary px-4">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
