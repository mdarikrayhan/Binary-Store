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
                    </div>

                    <!-- Product Details -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Product Information</h3>
                        <div class="flex gap-4">
                            @if($order->product->image_url)
                                <img src="{{ asset($order->product->image_url) }}" alt="{{ $order->product->name }}"
                                    class="w-20 h-20 object-cover rounded">
                            @endif
                            <div>
                                <p class="text-gray-700 font-medium">{{ $order->product->name }}</p>
                                <p class="text-gray-500">{{ Str::limit($order->product->description, 100) }}</p>
                                <p class="text-gray-700">Price: ${{ number_format($order->product->price) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Details -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Customer Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-700"><span class="font-medium">Name:</span> {{ $order->user->name }}</p>
                                <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $order->user->email }}
                                </p>
                                <p class="text-gray-700"><span class="font-medium">Phone:</span>
                                    {{ $order->user->phone ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700"><span class="font-medium">Shipping Address:</span></p>
                                <p class="text-gray-600">{{ $order->shipping_address }}</p>
                                <p class="text-gray-700 mt-2"><span class="font-medium">Shipping Phone:</span>
                                    {{ $order->shipping_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Quantity:</span>
                                <span>{{ $order->quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Unit Price:</span>
                                <span>${{ number_format($order->product->price) }}</span>
                            </div>
                            <div class="border-t pt-2 flex justify-between font-semibold">
                                <span>Total Cost:</span>
                                <span>${{ number_format($order->cost) }}</span>
                            </div>
                        </div>

                        <div class="mt-4 text-sm text-gray-500">
                            <p>Ordered on: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            @if($order->updated_at != $order->created_at)
                                <p>Last updated: {{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Actions -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center block">
                            Update Order Status
                        </a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this order?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors duration-200">
                                Delete Order
                            </button>
                        </form>
                        <a href="{{ route('admin.orders.index') }}"
                            class="w-full bg-gray-600 text-white py-3 px-6 rounded-md hover:bg-gray-700 transition-colors duration-200 text-center block">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection