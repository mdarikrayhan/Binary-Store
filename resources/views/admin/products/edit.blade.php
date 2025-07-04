@extends('layouts.app')

@section('content')
    @include('partials.banner')

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Update Product</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
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

            <form class="space-y-6" action="{{ route('admin.products.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm/6 font-medium text-gray-900">Product Description</label>
                    <div class="mt-2">
                        <textarea name="description" id="description" rows="3" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm/6 font-medium text-gray-900">Image Upload (Leave empty to keep
                        current image)</label>
                    <div class="mt-2">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @if($product->image_url)
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Current image:</p>
                            <img src="{{ asset($product->image_url) }}" alt="Current product image"
                                class="h-32 object-cover rounded">
                        </div>
                    @endif
                </div>

                <div>
                    <label for="price" class="block text-sm/6 font-medium text-gray-900">Product Price</label>
                    <div class="mt-2">
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                            min="1"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <label for="quantity" class="block text-sm/6 font-medium text-gray-900">Product Quantity</label>
                    <div class="mt-2">
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}"
                            required min="0"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Product Category</label>
                    <div class="mt-2">
                        <select name="category_id" id="category_id" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update Product
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center space-x-4">
                <a href="{{ route('admin.products.show', $product->id) }}"
                    class="text-indigo-600 hover:text-indigo-500">View Product</a>
                <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-500">Back to
                    Products</a>
            </div>
        </div>
    </div>
@endsection