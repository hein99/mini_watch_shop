<?php
include('common.inc.php');
/**
 * ----------------------------------------------
 * The following routes will use in this website
 * ----------------------------------------------
 * In general, URL Patterns is /resource/action/id
 * But for admin's access page, /admin/ is added befor /resourse/action/id
 * 
 * /home
 * /products
 * /products/detail/id
 * /orders/add
 * /orders/create
 * /orders/edit/id
 * /orders/update
 * /orders/track?code=SOMETHINGS
 * 
 * /admin/orders/
 * /admin/orders/detail/id
 * /admin/orders/edit/id
 * /admin/orders/update
 * /admin/products/
 * /admin/products/detail/id
 * /admin/products/add
 * /admin/products/create
 * /admin/products/edit/id
 * /admin/products/update
 * /admin/banners/
 * /admin/baneers/add
 * /admin/baneers/delete/id
 * 
 */

// Prepare url string
$route_string = '/' . $_GET['first-query'];

// if second, third and fourth queries have in url, add them to $route_string
if(isset($_GET['second-query']) and $_GET['second-query']) {
    $route_string .= '/' . $_GET['second-query'];

    if(isset($_GET['third-query']) and $_GET['third-query']) {
        $route_string .= '/' . $_GET['third-query'];

        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            $route_string .= '/' . $_GET['fourth-query'];
        }
    }
}

$routes = [ 
    '/home' => 'Controllers\Home::home',
];

// if $route_string is in $routes, call respective controller's respective function
if(array_key_exists($route_string, $routes)) {
   $routes[$route_string]();
} else {
    echo 'Oh, no!';
}


