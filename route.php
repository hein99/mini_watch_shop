<?php
include('common.inc.php');
/**
 * ----------------------------------------------
 * The following routes will use in this website
 * ----------------------------------------------
 * In general, URL Patterns is /resource/action/id
 * But for admin's access page, /admin/ is added befor /resourse/action/id
 * 
 * /home #
 * /products
 * /products/detail/id
 * /orders/add
 * /orders/create
 * /orders/edit/id
 * /orders/update
 * /orders/track?code=SOMETHINGS
 * 
 * /admin #
 * /admin/orders
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
 * /admin/banners/add
 * /admin/banners/delete/id
 * /admin/admins/ #
 * /admin/admins/create #
 * /admin/admins/edit/id #
 * /admin/admins/delete/id #
 * 
 * /auth #
 * /auth/login #
 * /auth/logout #
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

// for id in url('/admin/admins/edit/3)
$fourth_query = isset($_GET['fourth-query']) ? $_GET['fourth-query'] : '';

$routes = [ 
    '/home' => 'Controllers\HomeController::home',
    '/auth' => 'Controllers\AdminController::login',
    '/auth/login' => 'Controllers\AdminController::login',
    '/auth/logout' => 'Controllers\AdminController::logout',
    '/admin/admins' => 'Controllers\AdminController::list',
    '/admin/admins/create' => 'Controllers\AdminController::create',
    '/admin/admins/edit/' . $fourth_query => 'Controllers\AdminController::edit',
    '/admin/admins/delete/' . $fourth_query => 'Controllers\AdminController::delete',
    '/admin' => 'Controllers\OrderController::show',
];

// if $route_string is in $routes, call respective controller's respective function
if(array_key_exists($route_string, $routes)) {

    // if $route_string is begin with '/admin' check login 
    if(preg_match("/^\/admin/", $route_string)) {
       checkLogin();
    }
   $routes[$route_string]();
} else {
    die('404');
}

