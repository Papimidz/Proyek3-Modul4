<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        .login-box {
            width: 350px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            cursor: pointer;
        }

        .error {
            background: #ffdede;
            color: #b00020;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1>Login</h1>
    <p>Masuk untuk membuka dashboard</p>

    @error('username')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="/login">
        @csrf

        <label>Username</label>
        <input
            type="text"
            name="username"
            value="{{ old('username') }}"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>