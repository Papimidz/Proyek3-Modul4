<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('details.product')
            ->where('id_user', Auth::user()->id_user)
            ->orderByDesc('tanggal_order')
            ->get();

        return view('orders.index', compact('orders'));
    }
}
