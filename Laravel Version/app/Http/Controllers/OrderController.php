<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
     * Display a listing of the user's orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('orders.show', compact('order'));
    }

    /**
     * Cancel the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($id);
            
        // Only allow cancellation if order is pending
        if ($order->status !== 'pending') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Only pending orders can be cancelled.');
        }
        
        $order->update([
            'status' => 'cancelled'
        ]);
        
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order has been cancelled successfully.');
    }

    /**
     * Filter orders by status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');
        
        $query = Order::where('user_id', Auth::id());
        
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        
        $orders = $query->latest()->paginate(10);
        
        return view('orders.index', compact('orders', 'status'));
    }

    /**
     * Generate invoice for the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $order = Order::with(['items.product', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('orders.invoice', compact('order'));
    }

    /**
     * Download invoice for the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadInvoice($id)
    {
        $order = Order::with(['items.product', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        // Here you would typically generate a PDF
        // For example using a package like barryvdh/laravel-dompdf
        
        // $pdf = PDF::loadView('orders.invoice_pdf', compact('order'));
        // return $pdf->download('invoice-' . $order->id . '.pdf');
        
        // For now, just redirect back with a message
        return redirect()->route('orders.show', $order->id)
            ->with('info', 'PDF generation would be implemented here.');
    }
}