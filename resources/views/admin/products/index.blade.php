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

            <!-- Add Product Button -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('admin.products.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Product
                </a>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Products</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <div class="group relative">
                        @if($product->image_url)
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                        @else
                            <div
                                class="aspect-square w-full rounded-md bg-gray-200 lg:aspect-auto lg:h-80 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="mt-4 flex justify-center">
                            <a href="{{ route('admin.products.show', $product->id) }}"
                                class="text-sm font-semibold text-gray-900">{{ $product->name }}</a>
                            <span class="sr-only">,</span>
                            <p class="ml-2 text-sm text-gray-500">{{ Str::limit($product->description, 30) }}</p>
                        </div>
                        <div class="mt-2 flex justify-center">
                            <p class="text-sm font-medium text-gray-900">${{ number_format($product->price) }}</p>
                            <span class="ml-2 text-sm text-gray-500">Qty: {{ $product->quantity }}</span>
                        </div>
                        <div class="mt-2 flex justify-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="text-xs bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Update</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500">No products found. <a href="{{ route('admin.products.create') }}"
                            class="text-indigo-600 hover:text-indigo-500">Create your first product</a></p>
                </div>
            @endif
        </div>
    </div>
@endsection