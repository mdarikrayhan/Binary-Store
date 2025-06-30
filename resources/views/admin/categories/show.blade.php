@extends('layouts.app')

@section('title', 'Category Details - Admin')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Category Image -->
                <div class="md:w-1/2">
                    @if($category->image_url)
                        <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}"
                            class="w-full object-cover rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                            <span class="text-gray-500">No image available</span>
                        </div>
                    @endif
                </div>

                <!-- Category Details -->
                <div class="md:w-1/2 space-y-6">
                    <!-- Category Name -->
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $category->name }}
                    </h1>

                    <!-- Description -->
                    <div class="text-gray-600">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <p>{{ $category->description ?: 'No description available.' }}</p>
                    </div>

                    <!-- Category Metadata -->
                    <div class="text-sm text-gray-500 space-y-1">
                        <p><strong>Created:</strong> {{ $category->created_at->format('M d, Y') }}</p>
                        <p><strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y') }}</p>
                        @if($category->user)
                            <p><strong>Created by:</strong> {{ $category->user->name }}</p>
                        @endif
                    </div>

                    <!-- Admin Actions -->
                    <div class="pt-4 flex space-x-4">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                            class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center">
                            Update Category
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="flex: 1;"
                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors duration-200">
                                Delete Category
                            </button>
                        </form>
                    </div>

                    <!-- Back to Categories -->
                    <div class="pt-4">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            ← Back to Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection