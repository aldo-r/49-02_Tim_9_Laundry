@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <a href="{{ route('layanan.index') }}" class="text-decoration-none text-muted small d-inline-block mb-2">
            &larr; Kembali ke Katalog Layanan
        </a>
        <h1 class="page-title fs-4">Kelola Layanan Laundry</h1>
        <p class="page-subtitle">Tambah layanan baru, konfigurasi batas minimal berat, dan atur paket tarif.</p>
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
    {{-- Tabel Layanan --}}
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>Daftar Semua Layanan</span>
                <span class="badge bg-light text-muted border rounded-pill px-3 py-1">Total: {{ $semua->count() }}</span>
            </div>
            <div class="table-responsive">
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Kategori</th>
                            <th>Nama Layanan</th>
                            <th>Minimal Order</th>
                            <th class="text-center" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($semua as $row)
                        <tr>
                            <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                @if(strtolower($row->kategori) == 'kiloan')
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1">
                                        Kiloan
                                    </span>
                                @else
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3 py-1">
                                        Self Service
                                    </span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $row->nama_layanan }}</td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-2 py-1">
                                    {{ (float) $row->minimal_kg }} Kg
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('tarif.index', $row->id_layanan) }}" class="btn btn-outline-info btn-sm rounded-pill px-2">
                                        Tarif ({{ $row->tarifs->count() }})
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('layanan.edit', $row->id_layanan) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('layanan.destroy', $row->id_layanan) }}" method="post" class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini beserta seluruh tarifnya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-2">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada data layanan yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Form Tambah Layanan (Admin Only) --}}
    @if(auth()->user()->isAdmin())
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <span>Tambah Layanan Baru</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('layanan.store') }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select" required>
                                <option value="kiloan" @selected(old('kategori') == 'kiloan')>Kiloan</option>
                                <option value="self service" @selected(old('kategori') == 'self service')>Self Service</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_layanan" class="form-control"
                                   placeholder="Contoh: Cuci Komplit Reguler"
                                   maxlength="30" value="{{ old('nama_layanan') }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Minimal (Kg) <span class="text-danger">*</span></label>
                            <input type="number" name="minimal_kg" class="form-control"
                                   step="0.01" min="0.01" placeholder="1.00" value="{{ old('minimal_kg', '1.00') }}" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-custom-primary w-100">
                                Simpan
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
