<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the checkout page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get cart from session
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty. Please add some products first.');
        }
        
        // Get product details for cart items
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $id => $quantity) {
            $product = Product::findOrFail($id);
            
            // Skip if product is not active or not in stock
            if (!$product->status || $product->stock < $quantity) {
                continue;
            }
            
            $subtotal = $product->price * $quantity;
            $total += $subtotal;
            
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }
        
        // Get user data for pre-filling the form
        $user = Auth::user();
        
        return view('checkout', compact('cartItems', 'total', 'user'));
    }

    /**
     * Process the checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        // Validate the request
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_division' => 'required|string|max:255',
            'shipping_district' => 'required|string|max:255',
            'shipping_upazila' => 'required|string|max:255',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash_on_delivery,bank_transfer,credit_card',
            'notes' => 'nullable|string',
        ]);
        
        // Get cart from session
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty. Please add some products first.');
        }
        
        // Calculate total and validate products
        $total = 0;
        $orderItems = [];
        
        foreach ($cart as $id => $quantity) {
            $product = Product::findOrFail($id);
            
            // Skip if product is not active or not in stock
            if (!$product->status || $product->stock < $quantity) {
                return redirect()->route('checkout.index')
                    ->with('error', 'Some products in your cart are no longer available or have insufficient stock.');
            }
            
            $subtotal = $product->price * $quantity;
            $total += $subtotal;
            
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'total' => $subtotal
            ];
        }
        
        // Create order using a transaction
        DB::beginTransaction();
        
        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_division' => $request->shipping_division,
                'shipping_district' => $request->shipping_district,
                'shipping_upazila' => $request->shipping_upazila,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes,
            ]);
            
            // Create order items
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total']
                ]);
                
                // Update product stock
                $product = Product::find($item['product_id']);
                $product->update([
                    'stock' => $product->stock - $item['quantity']
                ]);
            }
            
            // Clear the cart
            Session::forget('cart');
            
            DB::commit();
            
            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Your order has been placed successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('checkout.index')
                ->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $productId = $request->product_id;
        $quantity = $request->quantity;
        
        // Get the product
        $product = Product::findOrFail($productId);
        
        // Check if product is active and in stock
        if (!$product->status || $product->stock < $quantity) {
            return redirect()->back()
                ->with('error', 'This product is not available or has insufficient stock.');
        }
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Add or update product in cart
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        
        // Save cart back to session
        Session::put('cart', $cart);
        
        return redirect()->back()
            ->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:0',
        ]);
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Update quantities
        foreach ($request->quantities as $id => $quantity) {
            if ($quantity > 0) {
                // Check product availability
                $product = Product::findOrFail($id);
                
                if ($product->status && $product->stock >= $quantity) {
                    $cart[$id] = $quantity;
                }
            } else {
                // Remove item if quantity is 0
                unset($cart[$id]);
            }
        }
        
        // Save cart back to session
        Session::put('cart', $cart);
        
        return redirect()->back()
            ->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove an item from the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $productId = $request->product_id;
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Remove item
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        
        // Save cart back to session
        Session::put('cart', $cart);
        
        return redirect()->back()
            ->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Display the cart page.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCart()
    {
        // Get cart from session
        $cart = Session::get('cart', []);
        
        // Get product details for cart items
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $id => $quantity) {
            $product = Product::findOrFail($id);
            
            // Skip if product is not active or not in stock
            if (!$product->status || $product->stock < $quantity) {
                continue;
            }
            
            $subtotal = $product->price * $quantity;
            $total += $subtotal;
            
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }
        
        return view('cart', compact('cartItems', 'total'));
    }

    /**
     * Clear the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        Session::forget('cart');
        
        return redirect()->route('checkout.cart')
            ->with('success', 'Cart cleared successfully!');
    }
}