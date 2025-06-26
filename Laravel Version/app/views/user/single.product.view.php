<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
// Extract product ID from URL
$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/product\/single\/(\d+)$/', $uri, $matches)) {
  $id = (int) $matches[1];
  $product = (new Product())->getProductById($id);

  if (!$product) {
    // Product not found
    http_response_code(404);
    echo "<h1>Product not found.</h1>";
    require('app/views/partials/footer.php');
    exit;
  }
} else {
  http_response_code(400);
  echo "<h1>Invalid product URL.</h1>";
  require('app/views/partials/footer.php');
  exit;
}
?>

<div class="bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Product Image -->
      <div class="md:w-1/2">
        <img src="/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
          class="w-full object-cover rounded-lg shadow-lg">
      </div>

      <!-- Product Details -->
      <div class="md:w-1/2 space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">
          <?= htmlspecialchars($product['name']) ?>
        </h1>

        <div class="text-2xl font-semibold text-gray-900">
          $<?= number_format($product['price'], 2) ?>
        </div>

        <div class="text-lg text-gray-600">
          In Stock: <?= htmlspecialchars($product['quantity']) ?> units
        </div>

        <div class="text-gray-600">
          <p><?= htmlspecialchars($product['description']) ?></p>
        </div>

        <form class="pt-4" action="/user/checkout" method="POST">
          <div class="flex items-center space-x-4">
            <label for="quantity" class="text-lg font-medium text-gray-700">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1"
              max="<?= htmlspecialchars($product['quantity']) ?>" value="1"
              class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>
          <!-- Space between quantity and button -->
          <div class="mt-4"></div>
          <!-- Checkout Button -->
          <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
          <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
          <input type="hidden" name="image" value="<?= htmlspecialchars($product['image_url']) ?>">
          <input type="hidden" name="action" value="checkout">
          <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">

          <button type="submit"
            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
            Checkout Now
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require('app/views/partials/footer.php') ?>