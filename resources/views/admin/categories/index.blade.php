@extends('layouts.app')

@section('title', 'Categories - Admin')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <!-- add category -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('admin.categories.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Category
                </a>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Categories</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
                id="categoryContainer">
                @foreach($categories as $category)
                    <div class="group relative">
                        <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}"
                            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                        <div class="mt-4 flex justify-center">
                            <a href="{{ route('admin.categories.show', $category->id) }}"
                                class="text-sm font-semibold text-gray-900">{{ $category->name }}</a>
                            <span class="sr-only">,</span>
                            <p class="ml-2 text-sm text-gray-500">{{ $category->description }}</p>
                        </div>
                        <div class="mt-2 flex justify-center space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="text-xs bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Update</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')"
                                    class="text-xs bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection