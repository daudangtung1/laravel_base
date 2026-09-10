<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập quản trị</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: #f4f5f7; color: #252b42; font-family: Arial, sans-serif; }
        .login-card { width: min(100% - 32px, 400px); padding: 32px; background: #fff; border-radius: 10px; box-shadow: 0 12px 32px rgba(0,0,0,.1); }
        h1 { margin: 0 0 8px; font-size: 24px; } p { margin: 0 0 24px; color: #6c757d; }
        label { display: block; margin: 16px 0 6px; font-weight: 600; } input { width: 100%; padding: 11px 12px; border: 1px solid #ced4da; border-radius: 5px; font-size: 15px; }
        .remember { display: flex; align-items: center; gap: 8px; margin: 18px 0; color: #495057; } .remember input { width: auto; }
        button { width: 100%; border: 0; border-radius: 5px; padding: 12px; background: #5e50f9; color: #fff; font-size: 15px; font-weight: 600; cursor: pointer; }
        .alert { margin: 16px 0; padding: 10px 12px; border-radius: 5px; } .alert-error { color: #842029; background: #f8d7da; } .alert-success { color: #0f5132; background: #d1e7dd; }
    </style>
</head>
<body>
    <main class="login-card">
        <h1>Trang quản trị</h1>
        <p>Đăng nhập để tiếp tục.</p>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif

        <form method="POST" action="{{ route('admin.postLogin') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>

            <label for="password">Mật khẩu</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>

            <label class="remember"><input name="remember" type="checkbox" value="1"> Ghi nhớ đăng nhập</label>
            <button type="submit">Đăng nhập</button>
        </form>
    </main>
</body>
</html>
