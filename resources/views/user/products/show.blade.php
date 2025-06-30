@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Product Image -->
                <div class="md:w-1/2">
                    @if($product->image_url)
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                            class="w-full object-cover rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 space-y-6">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $product->name }}
                    </h1>

                    <div class="text-2xl font-semibold text-gray-900">
                        ${{ number_format($product->price) }}
                    </div>

                    <div class="text-lg text-gray-600">
                        In Stock: {{ $product->quantity }} units
                    </div>

                    <div class="text-lg text-gray-600">
                        Category: <span class="font-medium">{{ $product->category->name }}</span>
                    </div>

                    <div class="text-gray-600">
                        <p>{{ $product->description }}</p>
                    </div>

                    @auth
                        <form class="pt-4" action="{{ route('user.checkout.show') }}" method="POST">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-lg font-medium text-gray-700">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}"
                                    value="1"
                                    class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <!-- Space between quantity and button -->
                            <div class="mt-4"></div>
                            <!-- Checkout Button -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            @if($product->quantity > 0)
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                    Checkout Now
                                </button>
                            @else
                                <button type="button" disabled
                                    class="w-full bg-gray-400 text-white py-3 px-6 rounded-md cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </form>
                    @else
                        <div class="pt-4">
                            <a href="{{ route('auth.signin') }}"
                                class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center block">
                                Sign In to Purchase
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Related Products</h2>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="group relative">
                                @if($relatedProduct->image_url)
                                    <img src="{{ asset($relatedProduct->image_url) }}" alt="{{ $relatedProduct->name }}"
                                        class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                                @else
                                    <div
                                        class="aspect-square w-full rounded-md bg-gray-200 lg:aspect-auto lg:h-80 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div class="mt-4 flex justify-center">
                                    <a href="{{ route('user.products.show', $relatedProduct->id) }}"
                                        class="text-sm font-semibold text-gray-900">
                                        {{ $relatedProduct->name }}
                                    </a>
                                    <span class="sr-only">,</span>
                                    <p class="ml-2 text-sm text-gray-500">{{ Str::limit($relatedProduct->description, 30) }}</p>
                                </div>
                                <div class="mt-2 flex justify-center">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($relatedProduct->price) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection