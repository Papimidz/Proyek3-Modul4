<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Keranjang belanja masih kosong.']);
        }

        $products = Product::whereIn('id_barang', array_keys($cart))->get();
        $total = 0;

        foreach ($products as $product) {
            $total += $product->harga * ($cart[$product->id_barang] ?? 0);
        }

        return view('checkout.index', compact('cart', 'products', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Keranjang belanja masih kosong.']);
        }

        $orderId = DB::transaction(function () use ($cart, $request) {
            $products = Product::whereIn('id_barang', array_keys($cart))
                ->lockForUpdate()
                ->get();

            if ($products->count() !== count($cart)) {
                throw ValidationException::withMessages([
                    'cart' => 'Ada produk yang sudah tidak tersedia.',
                ]);
            }

            $total = 0;

            foreach ($products as $product) {
                $jumlah = (int) ($cart[$product->id_barang] ?? 0);

                if ($jumlah < 1 || $jumlah > $product->stok) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok ' . $product->nama_barang . ' tidak mencukupi.',
                    ]);
                }

                $total += $product->harga * $jumlah;
            }

            $order = Order::create([
                'id_order' => 'ORD' . Str::upper(Str::random(12)),
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            foreach ($products as $product) {
                $jumlah = (int) $cart[$product->id_barang];

                OrderDetail::create([
                    'id_order' => $order->id_order,
                    'id_barang' => $product->id_barang,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => $jumlah,
                ]);

                $product->decrement('stok', $jumlah);
            }

            return $order->id_order;
        });

        session()->forget('cart');

        return redirect()->route('products.index')
            ->with('success', 'Checkout berhasil! Nomor pesanan: ' . $orderId);
    }
}
