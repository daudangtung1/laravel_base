<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Đăng nhập quản trị Author">
    <title>Đăng nhập – Author Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #6366f1;
            --primary-dark:  #4f46e5;
            --primary-light: #e0e7ff;
            --danger:        #ef4444;
            --danger-bg:     #fef2f2;
            --success:       #10b981;
            --success-bg:    #ecfdf5;
            --text:          #111827;
            --muted:         #6b7280;
            --border:        #d1d5db;
            --bg:            #f3f4f6;
            --card:          #ffffff;
            --radius:        12px;
            --shadow:        0 20px 60px rgba(0,0,0,.12);
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text);
        }

        /* Decorative gradient blobs */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
            z-index: 0;
        }
        body::before {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #a5b4fc, #818cf8);
            top: -120px; left: -120px;
        }
        body::after {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #c7d2fe, #a78bfa);
            bottom: -100px; right: -100px;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: min(100% - 32px, 420px);
        }

        /* Brand header */
        .brand {
            text-align: center;
            margin-bottom: 28px;
        }
        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px; height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            margin-bottom: 14px;
            box-shadow: 0 8px 20px rgba(99,102,241,.4);
        }
        .brand-icon svg { width: 28px; height: 28px; fill: #fff; }
        .brand h1 { font-size: 22px; font-weight: 700; letter-spacing: -.3px; }
        .brand p  { margin-top: 4px; font-size: 14px; color: var(--muted); }

        /* Card */
        .login-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 36px 32px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255,255,255,.6);
        }

        /* Alerts */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .alert-error   { background: var(--danger-bg);  color: #b91c1c; border: 1px solid #fca5a5; }
        .alert-success { background: var(--success-bg); color: #065f46; border: 1px solid #6ee7b7; }
        .alert svg { flex-shrink: 0; width: 18px; height: 18px; margin-top: 1px; }

        /* Form */
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 7px;
        }

        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }
        .input-icon svg { width: 17px; height: 17px; }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 14.5px;
            font-family: inherit;
            color: var(--text);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            background: #fafafa;
        }
        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
            background: #fff;
        }
        input.is-invalid { border-color: var(--danger); }
        input.is-invalid:focus { box-shadow: 0 0 0 3px var(--danger-bg); }

        .toggle-password {
            position: absolute;
            right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: var(--muted);
            padding: 0; line-height: 1;
            transition: color .15s;
        }
        .toggle-password:hover { color: var(--primary); }
        .toggle-password svg { width: 18px; height: 18px; }

        /* Remember row */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: var(--muted);
            cursor: pointer;
        }
        input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: opacity .2s, transform .15s;
            box-shadow: 0 4px 14px rgba(99,102,241,.4);
        }
        .btn-login:hover  { opacity: .92; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        /* Ripple */
        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,.15);
            opacity: 0;
            transition: opacity .3s;
        }
        .btn-login:hover::after { opacity: 1; }

        /* Footer note */
        .login-footer {
            text-align: center;
            margin-top: 22px;
            font-size: 12.5px;
            color: var(--muted);
        }
    </style>
</head>
<body>
<div class="login-wrapper">

    <!-- Brand -->
    <div class="brand">
        <div class="brand-icon">
            <!-- Pen/author icon -->
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zm17.71-10.21a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
            </svg>
        </div>
        <h1>Author Admin</h1>
        <p>Đăng nhập để quản lý tác giả</p>
    </div>

    <!-- Card -->
    <div class="login-card">

        {{-- Success flash --}}
        @if(session('success'))
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5l-4-4 1.41-1.41L10 13.67l6.59-6.59L18 8.5l-8 8z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form id="login-form" method="POST" action="{{ route('author.login.post') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="admin@example.com"
                           autocomplete="email"
                           autofocus
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           required>
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </span>
                    <input id="password"
                           type="password"
                           name="password"
                           placeholder="••••••••"
                           autocomplete="current-password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           required>
                    <button type="button" class="toggle-password" id="toggle-pwd" aria-label="Hiện/ẩn mật khẩu">
                        <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Remember --}}
            <div class="remember-row">
                <label class="remember-label" for="remember">
                    <input id="remember" type="checkbox" name="remember" value="1">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            <button type="submit" class="btn-login" id="submit-btn">
                Đăng nhập
            </button>
        </form>
    </div>

    <div class="login-footer">
        &copy; {{ date('Y') }} Author Admin Panel
    </div>
</div>

<script>
    // Toggle password visibility
    const pwdInput = document.getElementById('password');
    const eyeIcon  = document.getElementById('eye-icon');
    document.getElementById('toggle-pwd').addEventListener('click', function() {
        const isHidden = pwdInput.type === 'password';
        pwdInput.type = isHidden ? 'text' : 'password';
        eyeIcon.innerHTML = isHidden
            ? '<line x1="1" y1="1" x2="23" y2="23"/><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>'
            : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    });

    // Disable button while submitting to prevent double submit
    document.getElementById('login-form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.textContent = 'Đang đăng nhập...';
    });
</script>
</body>
</html>
