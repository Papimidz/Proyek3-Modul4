
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h1 {
            color: #2563eb;
        }

        .card {
            background: white;
            padding: 24px;
            margin: 20px 0;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0000000d;
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .total {
            color: #2563eb;
            text-align: right;
            font-size: 20px;
        }

        .link {
            display: inline-block;
            padding: 12px 16px;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            text-decoration: none;
        }

        .empty {
            text-align: center;
            padding: 30px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Pesanan</h1>

        <a href="{{ route('products.index') }}" class="link">Kembali ke Toko</a>

        @forelse ($orders as $order)
            <div class="card">
                <h2>Pesanan {{ $order->id_order }}</h2>

                <p>
                    Tanggal:
                    {{ $order->tanggal_order->format('d-m-Y H:i') }}
                </p>

                <p>
                    Alamat Pengiriman:
                    {{ $order->alamat_pengiriman }}
                </p>

                <h3>Barang yang Dibeli</h3>

                @foreach ($order->details as $detail)
                    <div class="item">
                        <div>
                            <strong>{{ $detail->product->nama_barang ?? 'Produk tidak tersedia' }}</strong>
                            <p>Jumlah: {{ $detail->jumlah_beli }}</p>
                        </div>

                        <div>
                            Rp{{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <h3 class="total">
                    Total: Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                </h3>
            </div>
        @empty
            <div class="card empty">
                <p>Lu belum punya riwayat pesanan, bro.</p>
            </div>
        @endforelse
    </div>
</body>
</html>
