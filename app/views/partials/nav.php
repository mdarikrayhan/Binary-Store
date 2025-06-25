<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="../../data/uploads/images/logo.svg" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="/"
                            class="<?= urlIs('/') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>

                        <!-- Showing admin links -->
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
                            <a href="/admin/category"
                                class="<?= urlIs('/admin/category') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Category</a>
                            <a href="/admin/product"
                                class="<?= urlIs('/admin/product') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Product</a>
                            <a href="/admin/order"
                                class="<?= urlIs('/admin/order') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Order</a>
                        
                        <?php else: ?>
                            <a href="/category"
                                class="<?= urlIs('/category') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Category</a>
                            <a href="/product"
                                class="<?= urlIs('/product') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Product</a>
                            <a href="/order"
                                class="<?= urlIs('/order') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Order</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="flex items-center justify-center relative ml-3">
                <a href="<?= isset($_SESSION['user_id']) ? '/profile' : '/signin' ?>">
                    <button type="button"
                        class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <?php
                        $email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
                        $default = "mp"; // Default gravatar image
                        $size = 40;
                        $grav_url = "https://www.gravatar.com/avatar/" . hash("sha256", strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                        ?>
                        <img class="h-8 w-8 rounded-full" src="<?= $grav_url ?>" alt="">
                    </button>
                </a>
                <!-- Show Name Beside profile picture -->
                <div class="hidden md:block ml-2 text-white">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= isset($_SESSION['user_id']) ? '/profile' : '/signin' ?>"
                            class="<?= urlIs('/profile') || urlIs('/signin') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"><?php echo htmlspecialchars($_SESSION['user_first_name']) . ' ' . htmlspecialchars($_SESSION['user_last_name']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>