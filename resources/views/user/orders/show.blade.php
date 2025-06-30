@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Order Details -->
                <div class="md:w-2/3">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Order #{{ $order->id }}</h1>

                    <!-- Order Status -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Status</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800
                @elseif($order->order_status === 'shipped') bg-purple-100 text-purple-800
                @elseif($order->order_status === 'delivered') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                @endif">
                            {{ ucfirst($order->order_status) }}
                        </span>

                        @if($order->order_status === 'pending')
                            <p class="text-sm text-gray-600 mt-2">Your order is being processed.</p>
                        @elseif($order->order_status === 'processing')
                            <p class="text-sm text-gray-600 mt-2">Your order is being prepared for shipment.</p>
                        @elseif($order->order_status === 'shipped')
                            <p class="text-sm text-gray-600 mt-2">Your order has been shipped and is on its way.</p>
                        @elseif($order->order_status === 'delivered')
                            <p class="text-sm text-green-600 mt-2">Your order has been delivered!</p>
                        @else
                            <p class="text-sm text-red-600 mt-2">Your order has been cancelled.</p>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Product Information</h3>
                        <div class="flex gap-4">
                            @if($order->product->image_url)
                                <img src="{{ asset($order->product->image_url) }}" alt="{{ $order->product->name }}"
                                    class="w-24 h-24 object-cover rounded">
                            @endif
                            <div class="flex-1">
                                <p class="text-gray-700 font-medium text-lg">{{ $order->product->name }}</p>
                                <p class="text-gray-500 mt-1">{{ $order->product->description }}</p>
                                <p class="text-gray-700 mt-2">Unit Price: ${{ number_format($order->product->price) }}</p>
                                <p class="text-gray-700">Category: {{ $order->product->category->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Shipping Information</h3>
                        <div class="space-y-2">
                            <p class="text-gray-700"><span class="font-medium">Address:</span></p>
                            <p class="text-gray-600 pl-4">{{ $order->shipping_address }}</p>
                            <p class="text-gray-700"><span class="font-medium">Phone:</span> {{ $order->shipping_phone }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Quantity:</span>
                                <span class="font-medium">{{ $order->quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Unit Price:</span>
                                <span class="font-medium">${{ number_format($order->product->price) }}</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between">
                                <span class="text-gray-800 font-semibold">Total Cost:</span>
                                <span class="text-gray-900 font-semibold text-lg">${{ number_format($order->cost) }}</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t text-sm text-gray-500">
                            <p><span class="font-medium">Order Date:</span> {{ $order->created_at->format('Y-m-d H:i:s') }}
                            </p>
                            @if($order->updated_at != $order->created_at)
                                <p class="mt-1"><span class="font-medium">Last Updated:</span>
                                    {{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6">
                        <a href="{{ route('user.orders.index') }}"
                            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center block">
                            Back to My Orders
                        </a>
                    </div>

                    @if($order->order_status === 'delivered')
                        <div class="mt-4">
                            <a href="{{ route('user.products.show', $order->product->id) }}"
                                class="w-full bg-green-600 text-white py-3 px-6 rounded-md hover:bg-green-700 transition-colors duration-200 text-center block">
                                Buy Again
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection