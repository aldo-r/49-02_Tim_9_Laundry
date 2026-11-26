@extends('layouts.app')

@section('title', 'Kelola Tarif: ' . $layanan->nama_layanan)

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <a href="{{ route('layanan.kelola') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
            &larr; Kembali ke Kelola Layanan
        </a>
        <h1 class="page-title fs-4">Tarif Layanan: {{ $layanan->nama_layanan }}</h1>
        <p class="page-subtitle">Kelola variasi paket (Reguler, Kilat, Express) beserta harga dan estimasi waktu selesai.</p>
    </div>
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

<div class="row g-4">
    {{-- Tabel Tarif --}}
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>Daftar Paket Tarif</span>
                <span class="badge bg-light text-muted border rounded-pill px-3 py-1">Kategori: {{ ucfirst($layanan->kategori) }}</span>
            </div>
            <div class="table-responsive">
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Nama Paket</th>
                            <th>Biaya / Harga</th>
                            <th>Estimasi Waktu Pengerjaan</th>
                            @if(auth()->user()->isAdmin())
                                <th class="text-center" style="width: 160px;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($layanan->tarifs as $t)
                        <tr>
                            <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $t->nama_paket }}</td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fs-6">
                                    Rp{{ number_format($t->harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-2 py-1">
                                    {{ $t->estimasi_waktu }}
                                </span>
                            </td>
                            @if(auth()->user()->isAdmin())
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('tarif.edit', $t->id_tarif) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('tarif.destroy', $t->id_tarif) }}" method="post" class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif paket ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-2">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="text-center py-5 text-muted">
                                Layanan ini belum memiliki daftar tarif. Silakan tambahkan paket tarif di bawah.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Form Tambah Tarif (Admin Only) --}}
    @if(auth()->user()->isAdmin())
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>Tambah Paket Tarif Baru</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tarif.store', $layanan->id_layanan) }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nama Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama_paket" class="form-control"
                                   maxlength="50" placeholder="Contoh: Reguler / Kilat 1 Hari / Express 3 Jam"
                                   value="{{ old('nama_paket') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Biaya / Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="harga" class="form-control"
                                       min="0" placeholder="Contoh: 10000" value="{{ old('harga') }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Estimasi Waktu <span class="text-danger">*</span></label>
                            <input type="text" name="estimasi_waktu" class="form-control"
                                   maxlength="20" placeholder="Contoh: 2 Hari"
                                   value="{{ old('estimasi_waktu') }}" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-custom-primary w-100">
                                Simpan Tarif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
