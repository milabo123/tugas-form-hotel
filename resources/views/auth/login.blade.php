<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — PPKD Hotel Jakarta Pusat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:      #0a2342;
            --primary-mid:  #153a6b;
            --primary-light:#1e5099;
            --gold:         #c9a227;
            --gold-light:   #e0b93a;
            --gold-dim:     rgba(201,162,39,.15);
            --surface:      #f0f4f8;
            --text:         #0f1f33;
            --text-muted:   #5a6e85;
            --border:       #d3dce8;
            --error:        #c0392b;
        }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
            background: var(--surface);
            color: var(--text);
        }

        /* ── Background decorative pattern ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(10,35,66,.07) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(201,162,39,.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Center wrapper ── */
        .page-wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* ── Brand header above card ── */
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo-wrap {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 3px solid var(--gold);
            overflow: hidden;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 20px rgba(201,162,39,.25);
        }

        .brand-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: .3px;
        }

        .brand-name em {
            color: var(--gold);
            font-style: italic;
        }

        .brand-subtitle {
            font-size: .78rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: .3rem;
        }

        /* ── Card ── */
        .login-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 40px rgba(10,35,66,.12), 0 1px 4px rgba(10,35,66,.06);
            overflow: hidden;
        }

        .login-card-header {
            background: linear-gradient(120deg, var(--primary) 0%, var(--primary-mid) 100%);
            padding: 1.5rem 2rem;
            border-bottom: 3px solid var(--gold);
            text-align: center;
        }

        .login-card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: .2rem;
        }

        .login-card-header p {
            color: rgba(255,255,255,.6);
            font-size: .82rem;
            letter-spacing: .5px;
        }

        .login-card-body {
            padding: 2rem;
        }

        /* ── Alert error ── */
        .alert-error {
            background: #fdf0f0;
            border: 1px solid #f3b7b7;
            border-left: 3px solid var(--error);
            padding: .75rem 1rem;
            border-radius: 8px;
            font-size: .85rem;
            color: var(--error);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        /* ── Form fields ── */
        .field-group {
            margin-bottom: 1.25rem;
        }

        .field-label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: .45rem;
            letter-spacing: .3px;
        }

        .field-wrap {
            position: relative;
        }

        .field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 15px;
            pointer-events: none;
            transition: color .18s;
        }

        .field-input {
            width: 100%;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: .7rem 2.8rem .7rem 2.8rem;
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .9rem;
            outline: none;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .field-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(30,80,153,.13);
            background: #fff;
        }

        .field-input.is-invalid {
            border-color: var(--error);
        }

        .field-wrap:focus-within .field-icon {
            color: var(--primary-light);
        }

        .field-error {
            font-size: .78rem;
            color: var(--error);
            margin-top: .4rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 15px;
            padding: 0;
            line-height: 1;
            transition: color .18s;
            z-index: 2;
        }
        .toggle-pw:hover { color: var(--primary); }

        /* ── Submit button ── */
        .btn-login {
            width: 100%;
            padding: .8rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            border: none;
            border-radius: 9px;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            letter-spacing: .5px;
            cursor: pointer;
            transition: all .18s;
            margin-top: .5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            box-shadow: 0 4px 16px rgba(10,35,66,.22);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-mid) 0%, var(--primary-light) 100%);
            box-shadow: 0 6px 20px rgba(10,35,66,.3);
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }

        /* ── Divider gold ── */
        .gold-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border: none;
            margin: 1.5rem 0;
        }

        /* ── Footer text ── */
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: .76rem;
            color: var(--text-muted);
        }

        .login-footer span {
            display: inline-block;
            background: var(--gold-dim);
            color: var(--primary);
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 4px;
            font-size: .72rem;
            letter-spacing: .5px;
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    {{-- Brand Header --}}
    <div class="brand-header">
        <div class="brand-logo-wrap">
            <img src="{{ asset('images/Logo-PPKD-JakPus.jpeg') }}" alt="Logo PPKD Jakarta Pusat">
        </div>
        <div class="brand-name">PPKD <em>Hotel</em></div>
        <div class="brand-subtitle">Dinas Tenaga Kerja, Transmigrasi dan Energi</div>
    </div>

    {{-- Login Card --}}
    <div class="login-card">
        <div class="login-card-header">
            <h2>Selamat Datang</h2>
            <p>Masuk untuk mengakses sistem registrasi tamu</p>
        </div>
        <div class="login-card-body">

            {{-- Error global --}}
            @if($errors->any())
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="email">Alamat Email</label>
                    <div class="field-wrap">
                        <i class="bi bi-envelope field-icon"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="field-input @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="nama@domain.com"
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="field-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-wrap">
                        <i class="bi bi-lock field-icon"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-pw" onclick="togglePassword()" title="Tampilkan password">
                            <i class="bi bi-eye" id="pw-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</div>
                    @enderror
                </div>

                <hr class="gold-divider">

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk ke Sistem
                </button>
            </form>
        </div>
    </div>

    {{-- Footer --}}
    <div class="login-footer">
        <p>© {{ date('Y') }} PPKD Hotel Jakarta Pusat &nbsp;·&nbsp; <span>Sistem Manajemen Hotel</span></p>
    </div>

</div>

<script>
function togglePassword() {
    const input  = document.getElementById('password');
    const icon   = document.getElementById('pw-icon');
    const isHide = input.type === 'password';
    input.type   = isHide ? 'text' : 'password';
    icon.className = isHide ? 'bi bi-eye-slash' : 'bi bi-eye';
}
</script>
</body>
</html>
