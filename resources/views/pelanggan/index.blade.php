@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <h1 class="page-title">Data Pelanggan</h1>
        <p class="page-subtitle">Kelola informasi kontak, alamat penjemputan/pengantaran, dan preferensi pelanggan laundry.</p>
    </div>
    @if(auth()->user()->isAdmin())
        <div>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-custom-primary">
                + Tambah Pelanggan
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
                    <th>Nama Pelanggan</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Catatan Khusus</th>
                    <th class="text-center" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($pelanggan as $p)
                <tr>
                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                    <td class="fw-bold text-dark">{{ $p->nama }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->notelp) }}" target="_blank" class="text-decoration-none text-primary">
                            {{ $p->notelp }}
                        </a>
                    </td>
                    <td>{{ Str::limit($p->alamat, 45) }}</td>
                    <td>
                        @if($p->catatan)
                            <span class="text-muted small">{{ Str::limit($p->catatan, 40) }}</span>
                        @else
                            <span class="text-muted fst-italic small">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-2"
                                    data-bs-toggle="modal" data-bs-target="#detailPelanggan{{ $p->id_pelanggan }}">
                                Detail
                            </button>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2">
                                    Edit
                                </a>
                                <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">
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

                {{-- Modal Detail Pelanggan --}}
                <div class="modal fade" id="detailPelanggan{{ $p->id_pelanggan }}" tabindex="-1" aria-labelledby="modalPelangganLabel{{ $p->id_pelanggan }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-sm">
                            <div class="modal-header modal-header-custom">
                                <h5 class="modal-title fs-6 fw-bold" id="modalPelangganLabel{{ $p->id_pelanggan }}">
                                    Detail Pelanggan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold mb-1">{{ $p->nama }}</h5>
                                    <span class="text-muted small">{{ $p->notelp }}</span>
                                </div>

                                <ul class="list-group list-group-flush rounded-3 border">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">Nama Lengkap</span>
                                        <span class="fw-semibold">{{ $p->nama }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">No. Telepon</span>
                                        <span class="fw-semibold">{{ $p->notelp }}</span>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <div class="text-muted small mb-1">Alamat Lengkap</div>
                                        <div class="fw-medium text-dark">{{ $p->alamat }}</div>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <div class="text-muted small mb-1">Catatan Khusus</div>
                                        <div class="text-dark">{{ $p->catatan ?: 'Tidak ada catatan.' }}</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer bg-light border-0 py-2">
                                <button type="button" class="btn btn-custom-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-custom-primary btn-sm">
                                        Edit Data
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        Belum ada data pelanggan yang terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
