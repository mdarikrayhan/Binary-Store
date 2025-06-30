<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="{{ asset('uploads/images/logo.svg') }}" alt="Binary Store">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}"
                            class="{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>

                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.categories.index') }}"
                                    class="{{ request()->is('admin/categories*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                                <a href="{{ route('admin.products.index') }}"
                                    class="{{ request()->is('admin/products*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                                <a href="{{ route('admin.orders.index') }}"
                                    class="{{ request()->is('admin/orders*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Orders</a>
                            @else
                                <a href="{{ route('user.categories.index') }}"
                                    class="{{ request()->is('user/categories*') || request()->is('category*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                                <a href="{{ route('user.products.index') }}"
                                    class="{{ request()->is('user/products*') || request()->is('product*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                                <a href="{{ route('user.orders.index') }}"
                                    class="{{ request()->is('user/orders*') || request()->is('order*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My
                                    Orders</a>
                            @endif
                        @else
                            <a href="{{ route('user.categories.index') }}"
                                class="{{ request()->is('user/categories*') || request()->is('category*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                            <a href="{{ route('user.products.index') }}"
                                class="{{ request()->is('user/products*') || request()->is('product*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="flex items-center justify-center relative ml-3">
                <a href="{{ auth()->check() ? route('auth.profile') : route('auth.signin') }}">
                    <button type="button"
                        class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        @php
                            $email = auth()->user()->email ?? '';
                            $default = "mp";
                            $size = 40;
                            $grav_url = "https://www.gravatar.com/avatar/" . hash("sha256", strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                        @endphp
                        <img class="h-8 w-8 rounded-full" src="{{ $grav_url }}" alt="">
                    </button>
                </a>
                <!-- Show Name Beside profile picture -->
                <div class="hidden md:block ml-2 text-white">
                    @auth
                        <a href="{{ auth()->check() ? '/profile' : '/signin' }}"
                            class="{{ request()->is('profile') || request()->is('signin') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">{{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}</a>
                    @else
                        <a href="/signin"
                            class="{{ request()->is('signin') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Sign
                            In</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>