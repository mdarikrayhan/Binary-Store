<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- About -->
        <div>
            <h3 class="text-lg font-semibold mb-4">About Binary Store</h3>
            <p class="text-gray-300 mb-4">
                Binary Store is your one-stop shop for all your shopping needs. We offer a wide range of products at competitive prices.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact Us</a></li>
                <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Products</a></li>
            </ul>
        </div>

        <!-- Categories -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Categories</h3>
            <ul class="space-y-2">
                @php
                    // In a real application, you would fetch categories from the database
                    $categories = \App\Models\Category::where('status', 1)->take(5)->get();
                @endphp
                
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('categories.show', $category->id) }}" class="text-gray-300 hover:text-white">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
            <ul class="space-y-2 text-gray-300">
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>123 Main Street, City, Country</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>info@binarystore.com</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>+1 234 567 890</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-300">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Binary Store') }}. All rights reserved.</p>
    </div>
</div>