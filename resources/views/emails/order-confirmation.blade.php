<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Order Confirmation - Binary Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .order-details {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
            border-left: 4px solid #4f46e5;
        }

        .footer {
            background-color: #f3f4f6;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
            color: #666;
        }

        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Order Confirmation</h1>
    </div>

    <div class="content">
        <h2>Hello {{ $order->user->name }},</h2>
        <p>Thank you for your order from Binary Store!</p>

        <div class="order-details">
            <h3>Order Details</h3>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Product:</strong> {{ $order->product->name }}</p>
            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($order->cost) }}</p>
        </div>

        <div class="order-details">
            <h3>Shipping Information</h3>
            <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
        </div>

        <p>Your order is being processed and will be shipped soon.</p>

        <a href="{{ route('user.orders.show', $order->id) }}" class="button">View Order Details</a>
    </div>

    <div class="footer">
        <p>Thank you for shopping with us!<br>
            <strong>Binary Store Team</strong>
        </p>
    </div>
</body>

</html>