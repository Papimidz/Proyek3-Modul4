<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
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
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            color: #2563eb;
        }

        .card {
            background: white;
            padding: 22px;
            margin-bottom: 18px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0000000d;
        }

        .item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .item img {
            width: 110px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
        }

        .info {
            flex: 1;
        }

        input {
            width: 85px;
            padding: 9px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        button, .link {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .hapus {
            background: #dc2626;
        }

        .success {
            color: #15803d;
        }

        .error {
            color: #dc2626;
        }

        .total {
            text-align: right;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .item {
                align-items: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Keranjang Belanja</h1>

        <a href="{{ route('products.index') }}" class="link">Kembali ke Toko</a>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        @forelse ($products as $product)
            <div class="card">
                <div class="item">
                    <img src="{{ asset('images/' . $product->gambar) }}" alt="{{ $product->nama_barang }}">

                    <div class="info">
                        <h3>{{ $product->nama_barang }}</h3>
                        <p>Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        <p>Stok: {{ $product->stok }}</p>
                        <p>Subtotal: Rp{{ number_format($product->harga * $cart[$product->id_barang], 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('cart.update', $product->id_barang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="jumlah" value="{{ $cart[$product->id_barang] }}" min="1" max="{{ $product->stok }}" required>
                        <button type="submit">Ubah</button>
                    </form>

                    <form action="{{ route('cart.remove', $product->id_barang) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="hapus">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="card">
                <p>Keranjang lu masih kosong, bro.</p>
            </div>
        @endforelse

        @if (count($products) > 0)
            <div class="card total">
                <h2>Total: Rp{{ number_format($total, 0, ',', '.') }}</h2>
                <p>Biaya pengiriman: Rp0</p>
            </div>
        @endif

        @if (count($products) > 0)
            <a href="{{ route('checkout.index') }}" class="link">Lanjut ke Checkout</a>
        @endif
    </div>
</body>
</html>
