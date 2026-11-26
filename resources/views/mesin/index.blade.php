@extends('layouts.app')

@section('title', 'Data Mesin Laundry')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <h1 class="page-title">Data Mesin Laundry</h1>
        <p class="page-subtitle">Pantau kondisi operasional, spesifikasi, dan kapasitas mesin cuci serta pengering.</p>
    </div>
    @if(auth()->user()->isAdmin())
        <div>
            <a href="{{ route('mesin.create') }}" class="btn btn-custom-primary">
                + Tambah Mesin
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
                    <th>Nama Mesin</th>
                    <th>Merek</th>
                    <th>Kapasitas</th>
                    <th>Status Kondisi</th>
                    <th class="text-center" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($mesin as $m)
                <tr>
                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                    <td class="fw-bold text-dark">{{ $m->nama }}</td>
                    <td>{{ $m->merek }}</td>
                    <td>
                        <span class="badge bg-light text-dark border rounded-pill px-2 py-1">
                            {{ $m->kapasitas }}
                        </span>
                    </td>
                    <td>
                        @php
                            $statusLower = strtolower($m->status);
                        @endphp
                        @if(str_contains($statusLower, 'rusak') || str_contains($statusLower, 'error') || str_contains($statusLower, 'mati'))
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                                {{ $m->status }}
                            </span>
                        @elseif(str_contains($statusLower, 'servis') || str_contains($statusLower, 'perbaikan') || str_contains($statusLower, 'maintenance'))
                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">
                                {{ $m->status }}
                            </span>
                        @else
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                {{ $m->status }}
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-2"
                                    data-bs-toggle="modal" data-bs-target="#detailMesin{{ $m->id }}">
                                Detail
                            </button>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('mesin.edit', $m->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2">
                                    Edit
                                </a>
                                <form action="{{ route('mesin.destroy', $m->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mesin ini?')">
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

                {{-- Modal Detail Mesin --}}
                <div class="modal fade" id="detailMesin{{ $m->id }}" tabindex="-1" aria-labelledby="modalMesinLabel{{ $m->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-sm">
                            <div class="modal-header modal-header-custom">
                                <h5 class="modal-title fs-6 fw-bold" id="modalMesinLabel{{ $m->id }}">
                                    Detail Mesin Laundry
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold mb-1">{{ $m->nama }}</h5>
                                    <span class="text-muted small">Merek: {{ $m->merek }}</span>
                                </div>

                                <ul class="list-group list-group-flush rounded-3 border">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">Nama Mesin</span>
                                        <span class="fw-semibold">{{ $m->nama }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">Merek Pabrikan</span>
                                        <span class="fw-semibold">{{ $m->merek }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">Kapasitas Beban</span>
                                        <span class="fw-semibold">{{ $m->kapasitas }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                        <span class="text-muted small">Kondisi Operasional</span>
                                        <span class="fw-semibold">{{ $m->status }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer bg-light border-0 py-2">
                                <button type="button" class="btn btn-custom-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('mesin.edit', $m->id) }}" class="btn btn-custom-primary btn-sm">
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
                        Belum ada data mesin laundry yang tersimpan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
