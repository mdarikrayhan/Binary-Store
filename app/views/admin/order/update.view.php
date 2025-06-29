<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
// Get order data
global $db;
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /admin/order");
    exit;
}

$query = "SELECT * FROM orders WHERE id = :id";
$params = [':id' => $id];
$order = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header("Location: /admin/order");
    exit;
}

// Get product details
$query = "SELECT * FROM products WHERE id = :id";
$params = [':id' => $order['product_id']];
$product = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);

// Get user details
$query = "SELECT * FROM users WHERE id = :id";
$params = [':id' => $order['user_id']];
$user = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Update Order Status</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Order #<?= htmlspecialchars($order['id']) ?></h3>
            <p class="text-gray-700">Product: <?= htmlspecialchars($product['name'] ?? 'Unknown Product') ?></p>
            <p class="text-gray-700">Customer: <?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></p>
            <p class="text-gray-700">Current Status: <?= htmlspecialchars($order['order_status']) ?></p>
            <p class="text-gray-700">Total Cost: $<?= number_format($order['cost'], 2) ?></p>
            <p class="text-gray-700">Shipping Address: <?= htmlspecialchars($order['shipping_address']) ?></p>
            <p class="text-gray-700">Shipping Phone: <?= htmlspecialchars($order['shipping_phone']) ?></p>
            <p class="text-gray-700">Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
            <p class="text-gray-500 text-sm mt-2">Ordered on: <?= date('Y-m-d H:i:s', strtotime($order['created_at'])) ?></p>
        </div>

        <form class="space-y-6" action="/admin/order?action=update&id=<?= $order['id'] ?>" method="POST">
            <div>
                <label for="order_status" class="block text-sm/6 font-medium text-gray-900">Order Status</label>
                <div class="mt-2">
                    <select name="order_status" id="order_status" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="pending" <?= $order['order_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="processing" <?= $order['order_status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                        <option value="shipped" <?= $order['order_status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                        <option value="delivered" <?= $order['order_status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                        <option value="cancelled" <?= $order['order_status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Order Status</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require('app/views/partials/footer.php') ?>