<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistem Manajemen') - Laundry Farm</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 0;
        }

        .navbar-brand-custom {
            font-weight: 700;
            color: #1e3a8a !important;
            font-size: 1.2rem;
            letter-spacing: -0.01em;
        }

        .nav-link-custom {
            color: #64748b;
            font-weight: 500;
            padding: 0.5rem 0.9rem !important;
            border-radius: 6px;
            font-size: 0.925rem;
            transition: all 0.15s ease;
        }

        .nav-link-custom:hover {
            color: #1e3a8a;
            background-color: #f1f5f9;
        }

        .nav-link-custom.active {
            color: #1e3a8a !important;
            background-color: #e0f2fe;
            font-weight: 600;
        }

        /* Card Simple */
        .card-custom {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 1.25rem;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.2rem;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        /* Table Simple */
        .table-custom {
            margin-bottom: 0;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.775rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .table-custom td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Buttons Simple */
        .btn-custom-primary {
            background-color: #1e40af;
            color: #ffffff;
            border: 1px solid #1e40af;
            font-weight: 500;
            padding: 0.45rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.15s ease;
        }

        .btn-custom-primary:hover {
            background-color: #1e3a8a;
            border-color: #1e3a8a;
            color: #ffffff;
        }

        .btn-custom-secondary {
            background-color: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
            font-weight: 500;
            padding: 0.45rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn-custom-secondary:hover {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        /* Modal Header Simple */
        .modal-header-custom {
            background-color: #1e40af;
            color: #ffffff;
        }

        .modal-header-custom .btn-close {
            filter: brightness(0) invert(1);
        }

        footer {
            margin-top: auto;
            border-top: 1px solid #e2e8f0;
            background-color: #ffffff;
            padding: 1rem 0;
            color: #94a3b8;
            font-size: 0.85rem;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
                Laundry Farm
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                @auth
                <ul class="navbar-nav me-auto ps-lg-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('deterjens.*') ? 'active' : '' }}"
                           href="{{ route('deterjens.index') }}">
                            Deterjen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('mesin.*') ? 'active' : '' }}"
                           href="{{ route('mesin.index') }}">
                            Mesin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}"
                           href="{{ route('pelanggan.index') }}">
                            Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('layanan.*') || request()->routeIs('tarif.*') ? 'active' : '' }}"
                           href="{{ route('layanan.index') }}">
                            Layanan & Tarif
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3 pt-3 pt-lg-0 border-top border-lg-0">
                    <div class="text-end d-none d-sm-block">
                        <span class="fw-semibold text-dark small me-1">{{ auth()->user()->name }}</span>
                        <span class="badge {{ auth()->user()->isAdmin() ? 'bg-primary' : 'bg-secondary' }} rounded-pill small">
                            {{ auth()->user()->role }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth

                @guest
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-custom-primary btn-sm rounded-pill px-3" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4 flex-grow-1">
        {{-- Flash Notification Alerts --}}
        @php
            $successMsg = session('success') ?? session('sukses');
            $errorMsg = session('error');
        @endphp

        @if($successMsg)
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4" role="alert">
                <span>{{ $successMsg }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errorMsg)
            <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 mb-4" role="alert">
                <span>{{ $errorMsg }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <span>&copy; {{ date('Y') }} Laundry Farm &bull; Kelompok WAD 9</span>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
