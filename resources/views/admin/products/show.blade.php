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
                    <!-- Product Name -->
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="text-2xl font-semibold text-gray-900">
                        ${{ number_format($product->price) }}
                    </div>

                    <!-- Stock -->
                    <div class="text-lg text-gray-600">
                        In Stock: {{ $product->quantity }} units
                    </div>

                    <!-- Category -->
                    <div class="text-lg text-gray-600">
                        Category: <span class="font-medium">{{ $product->category->name }}</span>
                    </div>

                    <!-- Created by -->
                    <div class="text-sm text-gray-500">
                        Created by: {{ $product->user->name }}
                    </div>

                    <!-- Description -->
                    <div class="text-gray-600">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Admin Actions -->
                    <div class="pt-4 flex space-x-4">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center">
                            Update Product
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors duration-200">
                                Delete Product
                            </button>
                        </form>
                    </div>

                    <!-- Back to Products -->
                    <div class="pt-2">
                        <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-500">
                            ← Back to Products
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection