@extends('layouts.app')

@section('title', 'Create Category - Admin')

@section('content')
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Create New Category</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form class="space-y-6" action="{{ route('admin.categories.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                    <div class="mt-2">
                        <textarea id="description" name="description" rows="3"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm"></textarea>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm/6 font-medium text-gray-900">Category Image</label>
                    <div class="mt-2">
                        <input id="image" name="image" type="file" accept="image/*" required
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                        Category</button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('admin.categories.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Back
                    to Categories</a>
            </div>
        </div>
    </div>
@endsection