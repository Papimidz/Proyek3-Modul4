<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        .dashboard-box {
            width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="dashboard-box">
    <div class="topbar">
        <h1>Dashboard</h1>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <hr>

    <h2>Selamat datang, {{ auth()->user()->nama_lengkap }}!</h2>

    <p>Halaman ini hanya bisa dibuka setelah login.</p>

    <p>
        Username:
        <strong>{{ auth()->user()->username }}</strong>
    </p>
</div>

</body>
</html>