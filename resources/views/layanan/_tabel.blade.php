{{-- Partial: tabel layanan. Dipakai untuk Kiloan dan Self Service --}}
<div class="table-responsive">
    <table class="table table-custom table-hover mb-0">
        <thead>
            <tr>
                <th class="text-center" style="width: 60px;">No</th>
                <th>Nama Layanan</th>
                <th>Minimal Order</th>
                <th>Paket Tarif & Biaya</th>
                <th>Estimasi Waktu</th>
                @if(auth()->user()->isAdmin())
                    <th class="text-center" style="width: 120px;">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @forelse ($daftar as $layanan)
            <tr>
                <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                <td class="fw-bold text-dark fs-6">{{ $layanan->nama_layanan }}</td>
                <td>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-1">
                        {{ (float) $layanan->minimal_kg }} Kg
                    </span>
                </td>
                <td>
                    @forelse ($layanan->tarifs as $t)
                        <div class="d-inline-block me-2 mb-1">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                <span class="fw-bold">Rp{{ number_format($t->harga, 0, ',', '.') }}</span>
                                <span class="text-muted small ms-1">({{ $t->nama_paket }})</span>
                            </span>
                        </div>
                    @empty
                        <span class="text-muted fst-italic small">Belum ada paket tarif</span>
                    @endforelse
                </td>
                <td>
                    @forelse ($layanan->tarifs as $t)
                        <div class="mb-1">
                            <span class="badge bg-light text-secondary border rounded-pill px-2 py-1 small">
                                {{ $t->nama_paket }}: <strong>{{ $t->estimasi_waktu }}</strong>
                            </span>
                        </div>
                    @empty
                        <span class="text-muted fst-italic small">-</span>
                    @endforelse
                </td>
                @if(auth()->user()->isAdmin())
                    <td class="text-center">
                        <a href="{{ route('layanan.edit', $layanan->id_layanan) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                            Edit
                        </a>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="text-center py-4 text-muted">
                    Belum ada data layanan untuk kategori ini.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
