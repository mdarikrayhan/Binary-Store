<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
$userOrders = (new Order())->getAllOrders();
?>
<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Your Orders</h2>
        <?php if (empty($userOrders)): ?>
                        <p class="text-gray-700">You have no orders yet.</p>
        <?php else: ?>
                        <div class="space-y-6">
                            <?php foreach ($userOrders as $order): ?>
                                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Order #<?= htmlspecialchars($order['id']) ?></h3>
                                                <p class="text-gray-700">Product ID: <?= htmlspecialchars($order['product_id']) ?></p>
                                                <p class="text-gray-700">Status: <?= htmlspecialchars($order['order_status']) ?></p>
                                                <p class="text-gray-700">Total Cost: $<?= number_format($order['cost'], 2) ?></p>
                                                <p class="text-gray-700">Shipping Address: <?= htmlspecialchars($order['shipping_address']) ?></p>
                                                <p class="text-gray-700">Shipping Phone: <?= htmlspecialchars($order['shipping_phone']) ?></p>
                                                <p class="text-gray-700">Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                                <p class="text-gray-500 text-sm mt-2">Ordered on:
                                                    <?= date('Y-m-d H:i:s', strtotime($order['created_at'])) ?>
                                                </p>
                                                <div class="mt-4 flex space-x-2">
                                                    <a href="/admin/order?action=update&id=<?= $order['id'] ?>" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">Update Status</a>
                                                    <a href="/admin/order?action=delete&id=<?= $order['id'] ?>" onclick="return confirm('Are you sure you want to delete this order?')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">Delete</a>
                                                </div>
                                            </div>
                            <?php endforeach; ?>
                        </div>
        <?php endif; ?>
    </div>

    <?php require('app/views/partials/footer.php') ?>
