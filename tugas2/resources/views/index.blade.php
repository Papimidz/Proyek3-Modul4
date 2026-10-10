
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .link-keranjang {
            background: white;
            color: #2563eb;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .daftar-barang {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
        }

        .barang {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px #00000012;
        }

        .gambar {
            background: #eff6ff;
            text-align: center;
            padding: 25px;
            font-size: 48px;
            border-radius: 8px;
        }

        .barang h3 {
            margin-bottom: 8px;
        }

        .harga {
            color: #2563eb;
            font-weight: bold;
            font-size: 18px;
        }

        .stok {
            color: #666;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        button:disabled {
            background: #999;
            cursor: not-allowed;
        }

        .kosong {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Toko Alat Tulis</h1>

        <a href="{{ route('keranjang') }}" class="link-keranjang">
            Keranjang ({{ collect(session('keranjang', []))->sum() }})
        </a>
    </header>

    <main>
        <h2>Daftar Barang</h2>
        <p>Pilih barang yang ingin kamu masukkan ke keranjang.</p>

        <div class="daftar-barang">
            @forelse ($barangs as $barang)
                <div class="barang">
                    <div class="gambar">🛍️</div>

                    <h3>{{ $barang->nama }}</h3>

                    <p class="harga">
                        Rp {{ number_format($barang->harga, 0, ',', '.') }}
                    </p>

                    <p class="stok">
                        Stok tersedia: {{ $barang->stok }}
                    </p>

                    <form
                        action="{{ route('keranjang.tambah', $barang->id) }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            {{ $barang->stok < 1 ? 'disabled' : '' }}
                        >
                            {{ $barang->stok < 1
                                ? 'Stok Habis'
                                : 'Masukkan ke Keranjang' }}
                        </button>
                    </form>
                </div>
            @empty
                <p class="kosong">
                    Belum ada barang yang tersedia.
                </p>
            @endforelse
        </div>
    </main>

</body>
</html>
