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
    <!-- Google Fonts: Playfair Display + Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:       #0a2342;   /* biru tua PPKD */
            --primary-mid:   #153a6b;
            --primary-light: #1e5099;
            --gold:          #c9a227;   /* emas logo */
            --gold-light:    #e0b93a;
            --gold-dim:      rgba(201,162,39,.18);
            --surface:       #f0f4f8;
            --surface-2:     #e6ecf4;
            --card-bg:       #ffffff;
            --text-main:     #0f1f33;
            --text-muted:    #5a6e85;
            --border:        #d3dce8;
            --success:       #1a7a4a;
            --danger:        #b52b2b;
            --warning:       #a06b00;
            --info:          #1766a8;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            background: var(--surface);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar-ppkd {
            background: var(--primary);
            border-bottom: 3px solid var(--gold);
            padding: .6rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 24px rgba(10,35,66,.22);
        }

        .navbar-ppkd .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.15rem;
            color: #fff !important;
            letter-spacing: .3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-logo-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            overflow: hidden;
            flex-shrink: 0;
        }

        .brand-logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-divider {
            width: 1px;
            height: 28px;
            background: rgba(255,255,255,.2);
            margin: 0 6px;
        }

        .navbar-ppkd .nav-link {
            color: rgba(255,255,255,.78) !important;
            font-size: .875rem;
            font-weight: 500;
            padding: .45rem .9rem !important;
            border-radius: 6px;
            transition: all .18s;
        }

        .navbar-ppkd .nav-link:hover,
        .navbar-ppkd .nav-link.active {
            color: var(--gold) !important;
            background: rgba(255,255,255,.06);
        }

        /* ── CARDS ── */
        .card {
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(10,35,66,.07);
            background: var(--card-bg);
            overflow: hidden;
        }

        .card-header-ppkd {
            background: linear-gradient(120deg, var(--primary) 0%, var(--primary-mid) 100%);
            color: #fff;
            padding: 1.1rem 1.5rem;
            border-bottom: 3px solid var(--gold);
            font-family: 'Playfair Display', serif;
        }

        /* ── SECTION TITLES ── */
        .section-title {
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            border-bottom: 2px solid var(--gold);
            padding-bottom: .45rem;
            margin-bottom: 1.2rem;
        }

        /* ── BUTTONS ── */
        .btn-ppkd-primary {
            background: var(--primary);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .875rem;
            border-radius: 8px;
            padding: .55rem 1.25rem;
            letter-spacing: .3px;
            transition: all .18s;
            box-shadow: 0 2px 8px rgba(10,35,66,.18);
        }
        .btn-ppkd-primary:hover {
            background: var(--primary-mid);
            color: #fff;
            box-shadow: 0 4px 14px rgba(10,35,66,.28);
            transform: translateY(-1px);
        }
        .btn-ppkd-gold {
            background: var(--gold);
            border: none;
            color: var(--primary);
            font-weight: 700;
            font-size: .875rem;
            border-radius: 8px;
            padding: .55rem 1.25rem;
            transition: all .18s;
        }
        .btn-ppkd-gold:hover {
            background: var(--gold-light);
            color: var(--primary);
            transform: translateY(-1px);
        }

        /* Legacy alias */
        .btn-primary-hotel { @extend .btn-ppkd-primary; background: var(--primary); border-color: var(--primary); color: #fff; font-weight: 600; border-radius: 8px; }
        .btn-primary-hotel:hover { background: var(--primary-mid); border-color: var(--primary-mid); color: #fff; }

        /* ── FORM CONTROLS ── */
        .form-label {
            font-weight: 600;
            font-size: .83rem;
            color: var(--text-main);
            margin-bottom: .35rem;
        }

        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: .9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: .5rem .9rem;
            color: var(--text-main);
            transition: border-color .18s, box-shadow .18s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(30,80,153,.14);
            outline: none;
        }

        /* ── TABLE ── */
        .table thead th {
            background: var(--primary);
            color: #fff;
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: .8rem 1rem;
            border: none;
        }

        .table thead th:first-child { border-radius: 0; }

        .table tbody tr:hover { background: var(--surface); }
        .table tbody td { padding: .75rem 1rem; vertical-align: middle; border-color: var(--border); }

        /* ── BADGES ── */
        .badge-room {
            background: var(--gold);
            color: var(--primary);
            font-weight: 700;
            font-size: .82rem;
            padding: .3em .65em;
            border-radius: 6px;
        }

        .badge-status-menginap {
            background: #d4f0e0; color: var(--success);
            font-weight: 600; border-radius: 6px; font-size: .78rem;
        }
        .badge-status-checkout {
            background: #e8edf2; color: var(--text-muted);
            font-weight: 600; border-radius: 6px; font-size: .78rem;
        }
        .badge-status-upcoming {
            background: #fff3cd; color: var(--warning);
            font-weight: 600; border-radius: 6px; font-size: .78rem;
        }

        /* ── ALERTS ── */
        .alert {
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
        }
        .alert-success {
            background: #eafaf2; border: 1px solid #a3dfc0; color: var(--success);
        }
        .alert-danger {
            background: #fdf0f0; border: 1px solid #f3b7b7; color: var(--danger);
        }

        /* ── PAGINATION (Bootstrap override) ── */
        .pagination .page-link {
            color: var(--primary);
            border-radius: 6px !important;
            margin: 0 2px;
            border-color: var(--border);
            font-size: .85rem;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* ── AVATAR INITIAL ── */
        .user-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--gold); color: var(--primary);
            font-weight: 700; font-size: 14px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--primary);
            color: rgba(255,255,255,.55);
            padding: 1rem 0;
            margin-top: 3rem;
            font-size: .8rem;
            border-top: 3px solid var(--gold);
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--surface-2); }
        ::-webkit-scrollbar-thumb { background: var(--primary-mid); border-radius: 4px; }
    </style>

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-ppkd">
    <div class="container">
        <a class="navbar-brand" href="{{ route('registrations.index') }}">
            <div class="brand-logo-circle">
                <img src="{{ asset('images/Logo-PPKD-JakPus.jpeg') }}" alt="Logo PPKD">
            </div>
            <div class="brand-divider"></div>
            <span>PPKD Hotel <span style="font-style:italic; color:var(--gold)">Jakarta Pusat</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="bi bi-list text-white fs-5"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto gap-1 ms-3">
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

            @auth
            <div class="d-flex align-items-center gap-3 ms-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="d-none d-lg-block lh-sm">
                        <div style="color:#fff;font-size:13px;font-weight:600">{{ Auth::user()->name }}</div>
                        <div style="color:rgba(255,255,255,.45);font-size:11px">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                            class="btn btn-sm d-flex align-items-center gap-1"
                            style="font-size:12px; border:1px solid rgba(255,255,255,.25); color:rgba(255,255,255,.8); background:transparent; border-radius:6px; padding:.35rem .75rem;"
                            onclick="return confirm('Yakin ingin keluar?')">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-md-inline">Keluar</span>
                    </button>
                </form>
            </div>
            @endauth
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
        <small>© {{ date('Y') }} PPKD Hotel Jakarta Pusat — Dinas Tenaga Kerja, Transmigrasi dan Energi</small>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
