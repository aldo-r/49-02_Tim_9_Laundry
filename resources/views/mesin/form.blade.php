@extends('layouts.app')

@section('title', isset($mesin) ? 'Edit Mesin Laundry' : 'Tambah Mesin Laundry')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header mb-3">
            <a href="{{ route('mesin.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
                &larr; Kembali ke Data Mesin
            </a>
            <h1 class="page-title fs-4">
                {{ isset($mesin) ? 'Edit Data Mesin' : 'Tambah Mesin Baru' }}
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
                    {{ isset($mesin) ? 'Perbarui Mesin: ' . $mesin->nama : 'Formulir Mesin Laundry Baru' }}
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($mesin) ? route('mesin.update', $mesin->id) : route('mesin.store') }}" method="POST">
                    @csrf
                    @if (isset($mesin))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama / Identitas Mesin <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Mesin Cuci Front Load 01"
                               value="{{ old('nama', $mesin->nama ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Merek Mesin <span class="text-danger">*</span></label>
                        <input type="text" name="merek" class="form-control" placeholder="Contoh: LG Commercial / Electrolux"
                               value="{{ old('merek', $mesin->merek ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kapasitas Mesin <span class="text-danger">*</span></label>
                        <input type="text" name="kapasitas" class="form-control" placeholder="Contoh: 10 Kg / 15 Kg"
                               value="{{ old('kapasitas', $mesin->kapasitas ?? '') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status / Kondisi Operasional <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            @php
                                $curStatus = old('status', $mesin->status ?? 'Bagus / Siap Pakai');
                            @endphp
                            <option value="Bagus / Siap Pakai" @selected($curStatus == 'Bagus / Siap Pakai' || $curStatus == 'Normal' || $curStatus == 'Bagus')>Bagus / Siap Pakai</option>
                            <option value="Sedang Digunakan" @selected($curStatus == 'Sedang Digunakan' || $curStatus == 'Digunakan')>Sedang Digunakan</option>
                            <option value="Dalam Perbaikan / Maintenance" @selected($curStatus == 'Dalam Perbaikan / Maintenance' || $curStatus == 'Perbaikan' || $curStatus == 'Maintenance')>Dalam Perbaikan / Maintenance</option>
                            <option value="Rusak" @selected($curStatus == 'Rusak')>Rusak</option>
                            @if(!in_array($curStatus, ['Bagus / Siap Pakai', 'Normal', 'Bagus', 'Sedang Digunakan', 'Digunakan', 'Dalam Perbaikan / Maintenance', 'Perbaikan', 'Maintenance', 'Rusak']))
                                <option value="{{ $curStatus }}" selected>{{ $curStatus }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-custom-primary flex-fill">
                            {{ isset($mesin) ? 'Perbarui Mesin' : 'Simpan Mesin' }}
                        </button>
                        <a href="{{ route('mesin.index') }}" class="btn btn-custom-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
