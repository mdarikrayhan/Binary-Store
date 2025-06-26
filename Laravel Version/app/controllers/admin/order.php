
<?php

$heading = "Order Management";

// Handle update action
if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // If form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_status = $_POST['order_status'];

        // Update the order
        $order = new Order();
        $order->updateOrderStatus($id, $order_status);

        // Redirect back to the order view
        header("Location: /admin/order");
        exit;
    }

    // Display the update form
    require "app/views/admin/order/update.view.php";
    return;
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $order = new Order();
    $order->deleteOrder($id);
    header("Location: /admin/order");
    exit;
}

require "app/views/admin/order/view.view.php";
