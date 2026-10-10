
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        button, .link {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            background: #2563eb;
            color: white;
        }
        .hapus {
            background: #dc2626;
        }
        .pesan {
            color: #b91c1c;
        }
        form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Keranjang Belanja</h1>

    @if (session('error'))
        <p class="pesan">{{ session('error') }}</p>
    @endif

    <a class="link" href="{{ route('tugas2.index') }}">Kembali ke Daftar Barang</a>

    @forelse ($items as $item)
        <div class="card">
            <div class="item">
                <div>
                    <h3>{{ $item['barang']->nama }}</h3>
                    <p>Harga: Rp {{ number_format($item['barang']->harga, 0, ',', '.') }}</p>
                    <p>Jumlah: {{ $item['jumlah'] }}</p>
                    <p>Subtotal: Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                </div>

                <div>
                    <form action="{{ route('keranjang.kurangJumlah', $item['barang']->id) }}" method="POST">
                        @csrf
                        <button type="submit">-</button>
                    </form>

                    <form action="{{ route('keranjang.tambahJumlah', $item['barang']->id) }}" method="POST">
                        @csrf
                        <button type="submit">+</button>
                    </form>

                    <form action="{{ route('keranjang.hapus', $item['barang']->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="hapus">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <p>Keranjang belanja masih kosong.</p>
        </div>
    @endforelse

    <div class="card">
        <h2>Total: Rp {{ number_format($total, 0, ',', '.') }}</h2>

        @if (count($items) > 0)
            <form action="{{ route('keranjang.kosongkan') }}" method="POST">
                @csrf
                <button type="submit" class="hapus">Kosongkan Keranjang</button>
            </form>
        @endif
    </div>
</body>
</html>
