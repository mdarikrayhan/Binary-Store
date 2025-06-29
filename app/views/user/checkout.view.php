<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
// Checkout form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productImage = $_POST['image'];
    $orderQuantity = $_POST['quantity'];
    $userId = $_POST['user_id'];

    //calculate total price
    $totalPrice = $productPrice * $orderQuantity;

}
?>

<div class="bg-white">
    <!-- Show order summary and ask the user for shipping address and shipping phone then submit the order -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h2>
        <form action="/user/checkout" method="POST" class="space-y-6">
            <input type="hidden" name="checkout" value="checkout">
            <input type="hidden" name="id" value="<?= htmlspecialchars($productId) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($productPrice) ?>">
            <input type="hidden" name="quantity" value="<?= htmlspecialchars($orderQuantity) ?>">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h3>
                <p class="text-gray-700">Product: <?= htmlspecialchars($productName) ?></p>
                <p class="text-gray-700">Price: $<?= number_format($totalPrice, 2) ?></p>
                <p class="text-gray-700">Quantity: <?= htmlspecialchars($orderQuantity) ?></p>
                <img src="/<?= htmlspecialchars($productImage) ?>" alt="<?= htmlspecialchars($productName) ?>"
                    class="w-32 h-32 object-cover mt-4 rounded-lg shadow-sm">
            </div>

            <div>
                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping
                    Address</label>
                <textarea autocomplete="street-address" id="shipping_address" name="shipping_address"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required></textarea>
                <span class="text-sm text-gray-500">e.g. 123 Main St, Anytown, USA</span>
            </div>

            <div>
                <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">Shipping Phone</label>
                <input type="tel" id="shipping_phone" name="shipping_phone"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>

                <span class="text-sm text-gray-500">e.g. +1 (555) 123-4567</span>
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                    Place Order
                </button>

            </div>

            <?php require('app/views/partials/footer.php') ?>