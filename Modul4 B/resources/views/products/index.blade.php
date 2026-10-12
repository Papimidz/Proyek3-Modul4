
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #222;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 24px 7%;
        }

        header h1 {
            margin: 0 0 8px;
        }

        main {
            padding: 30px 7%;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 3px 12px #00000012;
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: contain;
            background: #f8fafc;
            border-radius: 8px;
        }

        .card h3 {
            margin-bottom: 8px;
        }

        .price {
            color: #2563eb;
            font-weight: bold;
            font-size: 18px;
        }

        .stock {
            color: #555;
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
        }

        .habis {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <nav style="display:flex; justify-content:flex-end; align-items:center; gap:12px; padding:15px 5%; background:#fff;">
        @auth
            <span>Halo, {{ Auth::user()->nama_lengkap }}</span>
            <a href="{{ route('cart.index') }}">Keranjang</a>
            <a href="{{ route('orders.index') }}">Riwayat Pesanan</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register.form') }}">Daftar</a>
        @endauth
    </nav>
    <header>
        <h1>Toko Online</h1>
        <p>Temukan barang yang kamu butuhkan</p>
    </header>

    <main>
        <h2>Daftar Barang</h2>

        <div class="products">
            @forelse ($products as $product)
                <div class="card">
                    <img
                        src="{{ asset('images/' . $product->gambar) }}"
                        alt="{{ $product->nama_barang }}"
                    >

                    <h3>{{ $product->nama_barang }}</h3>
                    <p>{{ $product->deskripsi }}</p>

                    <p class="price">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>

                    <p class="stock">
                        Stok: {{ $product->stok }}
                    </p>

                    @if ($product->stok > 0)
                        <span class="status">Tersedia</span>
                    @else
                        <span class="status habis">Stok Habis</span>
                    @endif

                    @if ($product->stok > 0)
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_barang" value="{{ $product->id_barang }}">
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit">Tambah ke Keranjang</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login untuk Membeli</a>
                        @endauth
                    @else
                        <button type="button" disabled>Stok Habis</button>
                    @endif
                </div>
            @empty
                <p>Belum ada barang yang tersedia.</p>
            @endforelse
        </div>
    </main>
</body>



</html>
