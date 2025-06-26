<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
global $db;

// Parse category ID from URL
$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/product\/category\/(\d+)$/', $uri, $matches)) {
    $categoryId = $matches[1];
    $products = (new Product())->getProductsByCategoryId($categoryId);
} else {
    $products = (new Product())->getAllProducts();
}

?>

<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Products</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php foreach ($products as $product): ?>
                            <div class="group relative">
                                <img src="/<?= htmlspecialchars($product['image_url']) ?>"
                                    alt="<?= htmlspecialchars($product['name']) ?>"
                                    class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                                <div class="mt-4 flex justify-center">
                                    <a href="/product/single/<?= $product['id'] ?>" class="text-sm font-semibold text-gray-900">
                                        <?= htmlspecialchars($product['name']) ?>
                                    </a>
                                    <span class="sr-only">,</span>
                                    <p class="ml-2 text-sm text-gray-500"><?= htmlspecialchars($product['description']) ?></p>
                                </div>
                            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require('app/views/partials/footer.php') ?>