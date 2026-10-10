<?php
namespace App\Http\Controllers;

use App\Models\Barang;

class KeranjangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();

        $keranjang = session()->get('keranjang', []);
        $jumlahItem = array_sum($keranjang);

        return view('index', compact(
            'barangs',
            'jumlahItem'
        ));
    }

    // Menambahkan barang ke keranjang
    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->stok <= 0) {
            return redirect()
                ->route('tugas2.index')
                ->with('error', 'Stok barang habis.');
        }

        $keranjang = session()->get('keranjang', []);

        $jumlah = $keranjang[$id] ?? 0;

        if ($jumlah >= $barang->stok) {
            return redirect()
                ->route('tugas2.index')
                ->with('error', 'Jumlah melebihi stok.');
        }

        $keranjang[$id] = $jumlah + 1;

        session()->put('keranjang', $keranjang);

        return redirect()
            ->route('tugas2.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan halaman keranjang
    public function keranjang()
    {
        $keranjang = session()->get('keranjang', []);

        $barangs = Barang::whereIn(
            'id',
            array_keys($keranjang)
        )->get()->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            $barang = $barangs->get($id);

            if (!$barang) {
                continue;
            }

            $subtotal = $barang->harga * $jumlah;

            $items[] = [
                'barang' => $barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('keranjang', compact(
            'items',
            'total'
        ));
    }

    // Menambah jumlah barang
    public function tambahJumlah($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        $jumlah = $keranjang[$id] ?? 0;

        if ($jumlah >= $barang->stok) {
            return back()->with(
                'error',
                'Jumlah barang sudah mencapai stok.'
            );
        }

        $keranjang[$id] = $jumlah + 1;

        session()->put('keranjang', $keranjang);

        return back();
    }

    // Mengurangi jumlah barang
    public function kurangJumlah($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            if ($keranjang[$id] <= 1) {
                unset($keranjang[$id]);
            } else {
                $keranjang[$id]--;
            }
        }

        session()->put('keranjang', $keranjang);

        return back();
    }

    // Menghapus satu barang
    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        unset($keranjang[$id]);

        session()->put('keranjang', $keranjang);

        return back();
    }

    // Mengosongkan semua barang
    public function kosongkan()
    {
        session()->forget('keranjang');

        return back();
    }

}
