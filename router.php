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
    if (isset($routes[$uri])) {
        require $routes[$uri];
        return;
    }
    //var_dump($uri);
    //remove the last part of the uri
    $uriParts = explode('/', $uri);
    if (count($uriParts) > 1) {
        $lastPart = array_pop($uriParts);
        $uri = implode('/', $uriParts);
        if (isset($routes[$uri])) {
            require $routes[$uri];
            return;
        }
    }
    var_dump($uri);

}

function abort($code = 404)
{
    http_response_code($code);

    require "app/views/{$code}.php";

    die();
}

routeToController($uri, $routes);