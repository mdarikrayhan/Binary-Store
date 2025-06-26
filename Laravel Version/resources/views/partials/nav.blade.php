<nav class="container mx-auto px-4 py-2 flex items-center justify-between">
    <!-- Logo -->
    <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
            {{ config('app.name', 'Binary Store') }}
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex space-x-6">
        <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Home</a>
        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-indigo-600">Categories</a>
        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600">Products</a>
        <a href="{{ route('about') }}" class="text-gray-700 hover:text-indigo-600">About</a>
        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-indigo-600">Contact</a>
    </div>

    <!-- User Menu -->
    <div class="flex items-center space-x-4">
        <!-- Cart -->
        <a href="{{ route('checkout.cart') }}" class="text-gray-700 hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </a>

        @guest
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Register</a>
        @else
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-gray-700 hover:text-indigo-600">
                    {{ Auth::user()->first_name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Profile</a>
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">My Orders</a>
                    
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Admin Dashboard</a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>

<!-- Mobile Menu Button (only visible on small screens) -->
<div class="md:hidden px-4 py-2 border-t">
    <button id="mobile-menu-button" class="text-gray-700 hover:text-indigo-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Mobile Menu (hidden by default) -->
<div id="mobile-menu" class="hidden md:hidden px-4 py-2 bg-white border-t">
    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Home</a>
    <a href="{{ route('categories.index') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Categories</a>
    <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Products</a>
    <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-indigo-600">About</a>
    <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
</div>

<!-- Alpine.js for dropdown -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Mobile Menu Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>