<?php

$heading = "Checkout";
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])&& $_POST['checkout'] === 'checkout') {
    // Handle form submission
    $productId = $_POST['id'];
    $productPrice = $_POST['price'];
    $orderQuantity = $_POST['quantity'];
    $userId = $_POST['user_id'];
    $shipping_address = $_POST['shipping_address'] ?? '';
    $shipping_phone = $_POST['shipping_phone'] ?? '';

    //print for debugging
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // Calculate total price
    $totalPrice = $productPrice * $orderQuantity;

    $order = (new Order)->createOrder($productId, $userId, 'pending', $totalPrice, $shipping_address, $shipping_phone, $orderQuantity);
    echo "<p class='text-green-500'>Order placed successfully!</p>";
    if ($order) {
        // Redirect to order confirmation page or show success message
        header("Location: /order");
        exit;
    } else {
        // Handle order creation failure
        $error = "Failed to create order. Please try again.";
    }

} 

require "app/views/user/checkout.view.php";