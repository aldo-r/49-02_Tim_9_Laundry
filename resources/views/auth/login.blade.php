<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Laundry Farm</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .auth-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 400px;
        }

        .btn-custom-primary {
            background-color: #1e40af;
            color: #ffffff;
            border: 1px solid #1e40af;
            font-weight: 500;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.15s ease;
        }

        .btn-custom-primary:hover {
            background-color: #1e3a8a;
            border-color: #1e3a8a;
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="auth-card p-4 p-sm-4">
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Laundry Farm</h4>
        <p class="text-muted small">Silakan masuk ke akun Anda</p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 small py-2 px-3 mb-4" role="alert">
            <span>{{ $errors->first() }}</span>
            <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold small">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-control" placeholder="nama@email.com">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold small">Password</label>
            <input type="password" id="password" name="password" required
                   class="form-control" placeholder="Password">
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label for="remember" class="form-check-label text-muted small">Ingat saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-custom-primary w-100 mb-3">
            Masuk
        </button>
    </form>

    <div class="text-center mt-3 pt-3 border-top">
        <span class="text-muted small">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="fw-semibold text-primary small text-decoration-none ms-1">
            Daftar
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
