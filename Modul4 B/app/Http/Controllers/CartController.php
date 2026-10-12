<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id_barang', array_keys($cart))->get();

        $total = 0;

        foreach ($products as $product) {
            $total += $product->harga * ($cart[$product->id_barang] ?? 0);
        }

        return view('cart.index', compact('cart', 'products', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:products,id_barang',
            'jumlah' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->id_barang);
        $cart = session()->get('cart', []);
        $jumlah = (int) $request->input('jumlah', 1);
        $jumlah += $cart[$product->id_barang] ?? 0;

        if ($product->stok < 1 || $jumlah > $product->stok) {
            return back()->withErrors([
                'cart' => 'Jumlah pembelian melebihi stok yang tersedia.',
            ]);
        }

        $cart[$product->id_barang] = $jumlah;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $id_barang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id_barang);
        $cart = session()->get('cart', []);
        $jumlah = (int) $request->jumlah;

        if (!isset($cart[$id_barang])) {
            return redirect()->route('cart.index');
        }

        if ($jumlah > $product->stok) {
            return back()->withErrors([
                'cart' => 'Jumlah pembelian melebihi stok yang tersedia.',
            ]);
        }

        $cart[$id_barang] = $jumlah;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove(string $id_barang)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id_barang]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
