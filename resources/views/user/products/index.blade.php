@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
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
                            <a href="{{ route('user.products.show', $product->id) }}"
                                class="text-sm font-semibold text-gray-900">
                                {{ $product->name }}
                            </a>
                            <span class="sr-only">,</span>
                            <p class="ml-2 text-sm text-gray-500">{{ Str::limit($product->description, 30) }}</p>
                        </div>
                        <div class="mt-2 flex justify-center">
                            <p class="text-sm font-medium text-gray-900">${{ number_format($product->price) }}</p>
                            <span class="ml-2 text-sm text-gray-500">{{ $product->category->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500">No products available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
@endsection