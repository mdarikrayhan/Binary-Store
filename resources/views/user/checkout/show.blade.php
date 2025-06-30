@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h2>

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

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.checkout.process') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">

                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h3>
                    <div class="flex gap-4">
                        @if($product->image_url)
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                                class="w-32 h-32 object-cover rounded-lg shadow-sm">
                        @endif
                        <div class="flex-1">
                            <p class="text-gray-700 font-medium">Product: {{ $product->name }}</p>
                            <p class="text-gray-700">Unit Price: ${{ number_format($product->price) }}</p>
                            <p class="text-gray-700">Quantity: {{ $quantity }}</p>
                            <p class="text-gray-700 font-semibold text-lg">Total: ${{ number_format($totalPrice) }}</p>
                            <p class="text-gray-500 text-sm mt-2">{{ Str::limit($product->description, 100) }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping
                        Address</label>
                    <textarea autocomplete="street-address" id="shipping_address" name="shipping_address" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your complete shipping address..."
                        required>{{ old('shipping_address') }}</textarea>
                    <span class="text-sm text-gray-500">Please provide your complete address including city, state/division,
                        and postal code</span>
                </div>

                <div>
                    <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">Shipping Phone</label>
                    <input type="tel" id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="e.g. +880 1XXXXXXXXX" required>
                    <span class="text-sm text-gray-500">Phone number for delivery contact</span>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                        Place Order - ${{ number_format($totalPrice) }}
                    </button>
                    <a href="{{ route('user.products.show', $product->id) }}"
                        class="flex-1 bg-gray-300 text-gray-700 py-3 px-6 rounded-md hover:bg-gray-400 transition-colors duration-200 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection