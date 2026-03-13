<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPKD Hotel - Formulir Pendaftaran')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --hotel-primary: #1a3a5c;
            --hotel-accent:  #c8a94a;
            --hotel-light:   #f5f7fa;
        }

        body {
            background-color: var(--hotel-light);
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-hotel {
            background: linear-gradient(135deg, var(--hotel-primary) 0%, #2d5986 100%);
            border-bottom: 3px solid var(--hotel-accent);
        }

        .navbar-hotel .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            color: #fff !important;
        }

        .navbar-hotel .nav-link {
            color: rgba(255,255,255,.85) !important;
        }

        .navbar-hotel .nav-link:hover,
        .navbar-hotel .nav-link.active {
            color: var(--hotel-accent) !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            border-radius: 10px;
        }

        .card-header-hotel {
            background: linear-gradient(135deg, var(--hotel-primary) 0%, #2d5986 100%);
            color: #fff;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
        }

        .section-title {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--hotel-primary);
            border-bottom: 2px solid var(--hotel-accent);
            padding-bottom: .4rem;
            margin-bottom: 1.2rem;
        }

        .form-label {
            font-weight: 600;
            font-size: .875rem;
            color: #344054;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border-color: #d0d5dd;
            font-size: .9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--hotel-primary);
            box-shadow: 0 0 0 3px rgba(26,58,92,.15);
        }

        .btn-primary-hotel {
            background: var(--hotel-primary);
            border-color: var(--hotel-primary);
            color: #fff;
            font-weight: 600;
        }

        .btn-primary-hotel:hover {
            background: #15304d;
            border-color: #15304d;
            color: #fff;
        }

        .btn-accent {
            background: var(--hotel-accent);
            border-color: var(--hotel-accent);
            color: #1a1a1a;
            font-weight: 600;
        }

        .btn-accent:hover {
            background: #b8943e;
            border-color: #b8943e;
            color: #fff;
        }

        .badge-room {
            background: var(--hotel-accent);
            color: #1a1a1a;
            font-weight: 700;
            font-size: .85rem;
            padding: .35em .7em;
        }

        .table thead th {
            background: var(--hotel-primary);
            color: #fff;
            font-size: .82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .alert { border-radius: 8px; }

        footer {
            background: var(--hotel-primary);
            color: rgba(255,255,255,.7);
            padding: 1rem 0;
            margin-top: 3rem;
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-hotel">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('registrations.index') }}">
            <i class="bi bi-building fs-5"></i>
            PPKD Hotel Jakarta Pusat
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('registrations.index') ? 'active' : '' }}"
                       href="{{ route('registrations.index') }}">
                        <i class="bi bi-list-ul me-1"></i> Daftar Tamu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('registrations.create') ? 'active' : '' }}"
                       href="{{ route('registrations.create') }}">
                        <i class="bi bi-plus-circle me-1"></i> Registrasi Baru
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="container my-4">
    @yield('content')
</main>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <small>© {{ date('Y') }} PPKD Hotel Jakarta Pusat &mdash; Sistem Registrasi Tamu</small>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
