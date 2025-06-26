<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'app/controllers/index.php',
    '/admin/category' => 'app/controllers/admin/category.php',
    '/admin/product' => 'app/controllers/admin/product.php',
    '/admin/order' => 'app/controllers/admin/order.php',

    '/category' => 'app/controllers/user/category.php',

    '/product' => 'app/controllers/user/product.php',
    '/product/single' => 'app/controllers/user/product.php',
    '/product/category' => 'app/controllers/user/product.php',

    '/order' => 'app/controllers/user/order.php',

    '/user' => 'app/controllers/auth.php',
    '/user/checkout' => 'app/controllers/user/checkout.php',
    '/user/cart' => 'app/controllers/user/cart.php',
    '/signin' => 'app/controllers/auth.php',
    '/signup' => 'app/controllers/auth.php',
    '/logout' => 'app/controllers/auth.php',
    '/profile' => 'app/controllers/auth.php',
];

function routeToController($uri, $routes)
{
    // Check for exact route match
    if (isset($routes[$uri])) {
        require $routes[$uri];
        return;
    }

    // Try to match a parent route
    $uriParts = explode('/', $uri);
    if (count($uriParts) > 1) {
        $lastPart = array_pop($uriParts);
        $parentUri = implode('/', $uriParts);
        if (isset($routes[$parentUri])) {
            require $routes[$parentUri];
            return;
        }
    }

    // No route found, abort with 404
    abort(404);
}

function abort($code = 404)
{
    http_response_code($code);

    // Check if the view file exists
    $errorView = "app/views/{$code}.php";
    if (file_exists($errorView)) {
        require $errorView;
    } else {
        // Fallback for missing error view
        echo "<h1>Error {$code}</h1>";
        echo "<p>The page you requested could not be found.</p>";
        echo "<p><a href='/'>Return to home page</a></p>";
    }

    die();
}

routeToController($uri, $routes);
