<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management Test</title>
</head>
<body>
    <h1>Pengujian Role Management</h1>

    <p>Target: dzia02</p>
    <p>Role saat ini: customer</p>


    <form action="{{ route('admin.users.role.update', ['user' => 'USRPZGBQ5XPEADU']) }}"
        method="POST">
        @csrf
        @method('PATCH')

        <label for="role">Role baru:</label>
        <select name="role" id="role">
            <option value="customer">Customer</option>
            <option value="staff">Staff</option>
        </select>

        <button type="submit">Ubah Role</button>
    </form>


    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>