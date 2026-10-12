<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Online</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            max-width: 420px;
            margin: 50px auto;
            padding: 28px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px #00000012;
        }

        h1 {
            color: #2563eb;
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            color: #b91c1c;
            font-size: 14px;
        }

        a {
            color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p>Masuk ke akun untuk mulai berbelanja.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>

        <p>Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a></p>
        <p><a href="{{ route('products.index') }}">Kembali ke toko</a></p>
    </div>
</body>
</html>
