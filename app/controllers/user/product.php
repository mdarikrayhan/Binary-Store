<?php

$uri = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/product\/single\/(\d+)$/', $uri, $matches)) {
    // Single product view
    $productId = $matches[1];
    require "app/views/user/single.product.view.php";
} elseif (preg_match('/^\/product\/category\/(\d+)$/', $uri, $matches)) {
    // Category view
    $categoryId = $matches[1];

    require "app/views/user/product.view.php";
} else {
    // Default product listing view
    require "app/views/user/product.view.php";
}
