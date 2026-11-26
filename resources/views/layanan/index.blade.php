@extends('layouts.app')

@section('title', 'Katalog Layanan & Tarif')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
    <div>
        <h1 class="page-title">Layanan & Tarif Laundry</h1>
        <p class="page-subtitle">Daftar paket cucian kiloan dan mesin mandiri (self service) beserta estimasi pengerjaan.</p>
    </div>
    @if(auth()->user()->isAdmin())
        <div>
            <a href="{{ route('layanan.kelola') }}" class="btn btn-custom-primary">
                Kelola Layanan & Tarif
            </a>
        </div>
    @endif
</div>

<div class="row g-4">
    {{-- Layanan Kiloan --}}
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom bg-light">
                <span>Paket Cucian Kiloan</span>
                <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1">
                    {{ $kiloan->count() }} Layanan
                </span>
            </div>
            <div class="card-body p-0">
                @include('layanan._tabel', ['daftar' => $kiloan])
            </div>
        </div>
    </div>

    {{-- Layanan Self Service --}}
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header card-header-custom bg-light">
                <span>Self Service (Cuci / Kering Mandiri)</span>
                <span class="badge bg-info-subtle text-info-emphasis border rounded-pill px-3 py-1">
                    {{ $selfService->count() }} Layanan
                </span>
            </div>
            <div class="card-body p-0">
                @include('layanan._tabel', ['daftar' => $selfService])
            </div>
        </div>
    </div>
</div>
@endsection
