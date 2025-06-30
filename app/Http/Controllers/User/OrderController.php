<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }

        $orders = Order::where('user_id', Auth::id())
            ->with('product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }

        $order = Order::where('user_id', Auth::id())
            ->with('product', 'user')
            ->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }
}
