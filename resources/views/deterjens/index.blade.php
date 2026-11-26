@extends('layouts.app')

@section('title', 'Data Deterjen')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <h1 class="page-title">Data Deterjen & Bahan</h1>
        <p class="page-subtitle">Kelola inventaris deterjen, pelembut, pewangi, dan bahan pembersih laundry.</p>
    </div>
    @if(auth()->user()->isAdmin())
        <div>
            <a class="btn btn-custom-primary" href="{{ route('deterjens.create') }}">
                + Tambah Deterjen
            </a>
        </div>
    @endif
</div>

<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-custom table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th>Merek</th>
                    <th>Jenis</th>
                    <th>Supplier</th>
                    <th>Tgl Pembelian</th>
                    <th>Stok</th>
                    <th class="text-center" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deterjens as $deterjen)
                    <tr>
                        <td class="text-center fw-semibold text-muted">{{ $loop->iteration + ($deterjens->currentPage() - 1) * $deterjens->perPage() }}</td>
                        <td class="fw-bold text-dark">{{ $deterjen->merek }}</td>
                        <td>
                            <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                                {{ $deterjen->jenis }}
                            </span>
                        </td>
                        <td>{{ $deterjen->supplier }}</td>
                        <td>{{ \Carbon\Carbon::parse($deterjen->tanggal_pembelian)->format('d M Y') }}</td>
                        <td>
                            @if($deterjen->stok <= 5)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1">
                                    {{ $deterjen->stok }} sisa
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">
                                    {{ $deterjen->stok }} stok
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-2"
                                        data-bs-toggle="modal" data-bs-target="#detailDeterjen{{ $deterjen->id }}">
                                    Detail
                                </button>

                                @if(auth()->user()->isAdmin())
                                    <a class="btn btn-outline-primary btn-sm rounded-pill px-2" href="{{ route('deterjens.edit', $deterjen->id) }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('deterjens.destroy', $deterjen->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data deterjen ini?')">
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

                    {{-- Modal Detail Deterjen --}}
                    <div class="modal fade" id="detailDeterjen{{ $deterjen->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $deterjen->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-sm">
                                <div class="modal-header modal-header-custom">
                                    <h5 class="modal-title fs-6 fw-bold" id="modalLabel{{ $deterjen->id }}">
                                        Detail Deterjen
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="text-center mb-3">
                                        <h5 class="fw-bold mb-1">{{ $deterjen->merek }}</h5>
                                        <span class="text-muted small">{{ $deterjen->jenis }}</span>
                                    </div>

                                    <ul class="list-group list-group-flush rounded-3 border">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                            <span class="text-muted small">Merek</span>
                                            <span class="fw-semibold">{{ $deterjen->merek }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                            <span class="text-muted small">Jenis Produk</span>
                                            <span class="fw-semibold">{{ $deterjen->jenis }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                            <span class="text-muted small">Supplier</span>
                                            <span class="fw-semibold">{{ $deterjen->supplier }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                            <span class="text-muted small">Tgl Pembelian</span>
                                            <span class="fw-semibold">{{ \Carbon\Carbon::parse($deterjen->tanggal_pembelian)->translatedFormat('d F Y') }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                            <span class="text-muted small">Sisa Stok</span>
                                            <span class="badge {{ $deterjen->stok <= 5 ? 'bg-danger' : 'bg-success' }} px-3 py-1">
                                                {{ $deterjen->stok }} item
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer bg-light border-0 py-2">
                                    <button type="button" class="btn btn-custom-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('deterjens.edit', $deterjen->id) }}" class="btn btn-custom-primary btn-sm">
                                            Edit Data
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Belum ada data deterjen yang tersimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($deterjens->hasPages())
        <div class="p-3 border-top">
            {{ $deterjens->links() }}
        </div>
    @endif
</div>
@endsection
