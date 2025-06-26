@extends('layouts.app')

@section('title', 'Home')

@section('banner')
<div class="bg-indigo-700 text-white">
    <div class="container mx-auto px-4 py-16 flex flex-col items-center text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Binary Store</h1>
        <p class="text-xl mb-8 max-w-3xl">Your one-stop shop for all your shopping needs. We offer a wide range of products at competitive prices.</p>
        <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-md font-semibold hover:bg-gray-100 transition">
            Shop Now
        </a>
    </div>
</div>
@endsection

@section('content')
    <!-- Featured Categories -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Featured Categories</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform group-hover:scale-105">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold group-hover:text-indigo-600">{{ $category->name }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $category->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Products -->
    <section class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Featured Products</h2>
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800">View All</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('products.show', $product->id) }}" class="block">
                            <h3 class="text-lg font-semibold hover:text-indigo-600">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-bold">${{ number_format($product->price, 2) }}</span>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded-md text-sm hover:bg-indigo-700">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Why Choose Us</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Quality Products</h3>
                <p class="text-gray-600">We ensure that all our products meet the highest quality standards.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Best Prices</h3>
                <p class="text-gray-600">We offer competitive prices on all our products.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">24/7 Support</h3>
                <p class="text-gray-600">Our customer support team is available 24/7 to assist you.</p>
            </div>
        </div>
    </section>
@endsection