<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Online</title>
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
            max-width: 800px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 24px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0000000d;
        }

        h1 {
            color: #2563eb;
        }

        .product {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            min-height: 110px;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font: inherit;
            resize: vertical;
        }

        button, a {
            display: inline-block;
            padding: 12px 16px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
        }

        .total {
            color: #2563eb;
            font-size: 22px;
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
        <h1>Checkout</h1>

        <div class="card">
            <h2>Ringkasan Pesanan</h2>

            @foreach ($products as $product)
                <div class="product">
                    <div>
                        <strong>{{ $product->nama_barang }}</strong>
                        <p>Jumlah: {{ $cart[$product->id_barang] }}</p>
                    </div>
                    <div>
                        Rp{{ number_format($product->harga * $cart[$product->id_barang], 0, ',', '.') }}
                    </div>
                </div>
            @endforeach

            <p>Biaya pengiriman: Rp0</p>
            <h2 class="total">Total: Rp{{ number_format($total, 0, ',', '.') }}</h2>
        </div>

        <div class="card">
            <h2>Alamat Pengiriman</h2>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <label for="alamat_pengiriman">Alamat Lengkap</label>
                <textarea id="alamat_pengiriman" name="alamat_pengiriman" required>{{ old('alamat_pengiriman', Auth::user()->alamat) }}</textarea>

                <p>
                    <a href="{{ route('cart.index') }}">Kembali ke Keranjang</a>
                    <button type="submit">Buat Pesanan</button>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
