@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-lg">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Update Order Status</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-lg">
            <!-- Order Details -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Order #{{ $order->id }}</h3>
                <div class="space-y-2">
                    <p class="text-gray-700"><span class="font-medium">Product:</span> {{ $order->product->name }}</p>
                    <p class="text-gray-700"><span class="font-medium">Customer:</span> {{ $order->user->name }}</p>
                    <p class="text-gray-700"><span class="font-medium">Current Status:</span>
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
                    <p class="text-gray-700"><span class="font-medium">Total Cost:</span> ${{ number_format($order->cost) }}
                    </p>
                    <p class="text-gray-700"><span class="font-medium">Quantity:</span> {{ $order->quantity }}</p>
                    <p class="text-gray-700"><span class="font-medium">Shipping Address:</span>
                        {{ $order->shipping_address }}</p>
                    <p class="text-gray-700"><span class="font-medium">Shipping Phone:</span> {{ $order->shipping_phone }}
                    </p>
                    <p class="text-gray-500 text-sm mt-2">Ordered on: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label for="order_status" class="block text-sm/6 font-medium text-gray-900">Order Status</label>
                    <div class="mt-2">
                        <select name="order_status" id="order_status" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="pending" {{ old('order_status', $order->order_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ old('order_status', $order->order_status) === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ old('order_status', $order->order_status) === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ old('order_status', $order->order_status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ old('order_status', $order->order_status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update Order Status
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center space-x-4">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-500">View
                    Order Details</a>
                <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-500">Back to Orders</a>
            </div>
        </div>
    </div>
@endsection