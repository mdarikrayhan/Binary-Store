<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Categories</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php
            $categories = (new Category())->getAllCategories();
            foreach ($categories as $category): ?>
                <div class="group relative">
                    <img src="/<?= htmlspecialchars($category['image_url']) ?>"
                        alt="<?= htmlspecialchars($category['name']) ?>"
                        class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                    <div class="mt-4 flex justify-center">
                        <a href="/product/category/<?= $category['id'] ?>"
                            class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($category['name']) ?></a>
                        <span class="sr-only">,</span>
                        <p class="ml-2 text-sm text-gray-500"><?= htmlspecialchars($category['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>