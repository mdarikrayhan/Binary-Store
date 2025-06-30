@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">All Orders</h2>

            @if($orders->isEmpty())
                <p class="text-gray-700 mt-4">No orders found.</p>
            @else
                <div class="space-y-6 mt-6">
                    @foreach($orders as $order)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Order #{{ $order->id }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-700"><span class="font-medium">Customer:</span> {{ $order->user->name }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Product:</span> {{ $order->product->name }}
                                    </p>
                                    <p class="text-gray-700"><span class="font-medium">Status:</span>
                                        <span class="px-2 py-1 rounded text-sm 
                                            @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->order_status === 'shipped') bg-purple-100 text-purple-800
                                            @elseif($order->order_status === 'delivered') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-700"><span class="font-medium">Total Cost:</span>
                                        ${{ number_format($order->cost) }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Quantity:</span> {{ $order->quantity }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Shipping Address:</span>
                                        {{ $order->shipping_address }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Shipping Phone:</span>
                                        {{ $order->shipping_phone }}</p>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-4">Ordered on: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm">View Details</a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                    class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">Update Status</a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection