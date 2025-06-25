<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>



<div class="bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex flex-col md:flex-row gap-8">
      <!-- Product Image -->
      <div class="md:w-1/2">
        <img src="" alt="Product Image" class="w-full object-cover rounded-lg shadow-lg">
      </div>

      <!-- Product Details -->
      <div class="md:w-1/2 space-y-6">
        <!-- Product Name -->
        <h1 class="text-3xl font-bold text-gray-900">
          Basic Tee 6-Pack
        </h1>

        <!-- Price -->
        <div class="text-2xl font-semibold text-gray-900">
          $192.00
        </div>

        <!-- Stock -->
        <div class="text-lg text-gray-600">
          In Stock: 15 units
        </div>

        <!-- Description -->
        <div class="text-gray-600">
          <p>The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options.
            Perfect for everyday wear.</p>
        </div>

        <!-- Add to Cart Button -->
        <form class="pt-4">
          <button type="submit"
            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
            Add to Cart
          </button>
        </form>
      </div>
    </div>

  </div>
</div>



<?php require('app/views/partials/footer.php') ?>

<script>
  <?php
  global $db;
  $id = $_GET['id'] ?? null;

  if (isset($_GET['id'])) {
    $query = "SELECT * FROM products WHERE id = :id";
    $params = [':id' => $id];
    $product = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
      echo "console.error('Product not found');";
      return;
    }
  } else {
    echo "console.error('No product ID provided');";
    return;
  }
  // Output product data as a JavaScript object
  echo "const product = " . json_encode($product) . ";";
  echo "console.log(product);"; // For debugging purposes
  ?>

  document.addEventListener('DOMContentLoaded', function () {
    // Product exists in the scope from PHP-generated code above
    if (product) {
      // Update image
      const productImage = document.querySelector('.md\\:w-1\\/2 img');
      productImage.src = '../' + product.image_url || 'https://via.placeholder.com/400';
      productImage.alt = product.name;

      // Update product name
      document.querySelector('.text-3xl.font-bold').textContent = product.name;

      // Update price
      document.querySelector('.text-2xl.font-semibold').textContent =
        '$' + Number(product.price).toFixed(2);

      // Update stock
      document.querySelector('.text-lg.text-gray-600').textContent =
        'In Stock: ' + product.quantity + ' units';

      // Update description
      document.querySelector('.text-gray-600 p').textContent = product.description;
    }
  });
</script>