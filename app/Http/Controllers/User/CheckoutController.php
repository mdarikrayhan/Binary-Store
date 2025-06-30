<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        // Check if enough stock is available
        if ($quantity > $product->quantity) {
            return redirect()->route('user.products.show', $product->id)
                ->with('error', 'Not enough stock available');
        }

        $totalPrice = $product->price * $quantity;

        return view('user.checkout.show', compact('product', 'quantity', 'totalPrice'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        }
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string|max:500',
            'shipping_phone' => 'required|string|max:20'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        // Check if enough stock is available
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        $totalPrice = $product->price * $quantity;

        // Create the order
        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'order_status' => 'pending',
            'cost' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'shipping_phone' => $request->shipping_phone,
            'quantity' => $quantity
        ]);

        // Update product quantity
        $product->decrement('quantity', $quantity);

        // Send order confirmation email
        $this->sendOrderConfirmationEmail($order);

        return redirect()->route('user.orders.index')->with('success', 'Order placed successfully!');
    }

    private function sendOrderConfirmationEmail($order)
    {
        try {
            Mail::to($order->user->email)->send(new OrderConfirmation($order));
        } catch (\Exception $e) {
            // Log the error but don't fail the order
            \Log::error('Failed to send order confirmation email: ' . $e->getMessage());
        }
    }
}
