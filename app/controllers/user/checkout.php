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
        // Send order confirmation email
        sendOrderConfirmationEmail($userId, $productId, $orderQuantity, $totalPrice, $shipping_address, $shipping_phone);

        // Redirect to order confirmation page or show success message
        header("Location: /order");
        exit;
    } else {
        // Handle order creation failure
        $error = "Failed to create order. Please try again.";
    }

} 

// Function to send order confirmation email
function sendOrderConfirmationEmail($userId, $productId, $quantity, $totalPrice, $shipping_address, $shipping_phone) {
    // Get user data
    $user = (new User)->getUserDataByID($userId);
    if (!$user) {
        return false;
    }

    // Get product data
    $product = (new Product)->getProductById($productId);
    if (!$product) {
        return false;
    }

    // Email configuration
    $to_email = $user['email'];
    $subject = "Order Confirmation - Binary Store";

    // Prepare email body
    $body = "Hello " . $user['first_name'] . " " . $user['last_name'] . ",\n\n";
    $body .= "Thank you for your order from Binary Store!\n\n";
    $body .= "Order Details:\n";
    $body .= "Product: " . $product['name'] . "\n";
    $body .= "Quantity: " . $quantity . "\n";
    $body .= "Total Price: $" . number_format($totalPrice, 2) . "\n\n";
    $body .= "Shipping Information:\n";
    $body .= "Address: " . $shipping_address . "\n";
    $body .= "Phone: " . $shipping_phone . "\n\n";
    $body .= "Your order is being processed and will be shipped soon.\n\n";
    $body .= "Thank you for shopping with us!\n";
    $body .= "Binary Store Team";

    $from_email = "mdarikrayhan@gmail.com"; // Use the email from config
    $app_password = "aeezmayolqnnzvyc"; // Use the app password from config

    // Connect via SSL
    $hostname = 'ssl://smtp.gmail.com';
    $port = 465;
    $timeout = 30;

    $socket = @stream_socket_client("$hostname:$port", $errno, $errstr, $timeout);
    if (!$socket) {
        return false;
    }

    // Helper function to send commands to SMTP server
    function send_smtp_cmd($socket, $cmd) {
        fwrite($socket, $cmd . "\r\n");
        $response = '';
        while ($line = fgets($socket, 512)) {
            $response .= $line;
            if (preg_match('/^\d{3} /', $line))
                break;
        }
        return $response;
    }

    // Read server greeting
    fgets($socket);

    // Say EHLO
    send_smtp_cmd($socket, "EHLO localhost");

    // Authenticate
    send_smtp_cmd($socket, "AUTH LOGIN");
    send_smtp_cmd($socket, base64_encode($from_email));
    send_smtp_cmd($socket, base64_encode($app_password));

    // Send mail
    send_smtp_cmd($socket, "MAIL FROM:<$from_email>");
    send_smtp_cmd($socket, "RCPT TO:<$to_email>");
    send_smtp_cmd($socket, "DATA");

    // Construct message
    $message = "To: $to_email\r\n";
    $message .= "From: Binary Store <$from_email>\r\n";
    $message .= "Subject: $subject\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "\r\n";
    $message .= $body;

    // End message with a dot on a line
    send_smtp_cmd($socket, $message . "\r\n.");

    // Quit
    send_smtp_cmd($socket, "QUIT");

    fclose($socket);

    return true;
}

require "app/views/user/checkout.view.php";
