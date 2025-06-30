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

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Your Orders</h2>

            @if($orders->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-700">You have no orders yet.</p>
                    <a href="{{ route('user.products.index') }}"
                        class="mt-4 inline-block text-indigo-600 hover:text-indigo-500">Start Shopping</a>
                </div>
            @else
                <div class="space-y-6 mt-6">
                    @foreach($orders as $order)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-gray-800">Order #{{ $order->id }}</h3>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->order_status === 'shipped') bg-purple-100 text-purple-800
                                    @elseif($order->order_status === 'delivered') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex gap-4">
                                    @if($order->product->image_url)
                                        <img src="{{ asset($order->product->image_url) }}" alt="{{ $order->product->name }}"
                                            class="w-20 h-20 object-cover rounded">
                                    @endif
                                    <div>
                                        <p class="text-gray-700 font-medium">{{ $order->product->name }}</p>
                                        <p class="text-gray-500 text-sm">{{ Str::limit($order->product->description, 50) }}</p>
                                        <p class="text-gray-700">Quantity: {{ $order->quantity }}</p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-gray-700"><span class="font-medium">Total Cost:</span>
                                        ${{ number_format($order->cost) }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Shipping Address:</span></p>
                                    <p class="text-gray-600 text-sm">{{ $order->shipping_address }}</p>
                                    <p class="text-gray-700 mt-1"><span class="font-medium">Phone:</span>
                                        {{ $order->shipping_phone }}</p>
                                </div>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <p class="text-gray-500 text-sm">Ordered on: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                                <a href="{{ route('user.orders.show', $order->id) }}"
                                    class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection