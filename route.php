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

    /**
     * -------------------------------------
     * Authentication routes for page admin
     * -------------------------------------
     * login and logout for admin's area
     * 
     */
    '/auth' => 'Controllers\AdminController::login',
    '/auth/login' => 'Controllers\AdminController::login',
    '/auth/logout' => 'Controllers\AdminController::logout',

    /**
     * -------------------------
     * Page Admins' area routes
     * -------------------------
     * Display Page Admins list
     * Only id(1) admin in database can create new admin, edit other admins information and delete other admins
     * 
     */
    '/admin/admins' => 'Controllers\AdminController::list',
    '/admin/admins/create' => 'Controllers\AdminController::create',
    '/admin/admins/edit/' . $fourth_query => 'Controllers\AdminController::edit',
    '/admin/admins/delete/' . $fourth_query => 'Controllers\AdminController::delete',

    /**
     * ---------------------
     * Orders' area routes
     * ---------------------
     * 
     */
    '/admin' => 'Controllers\OrderController::list',
    '/admin/orders' => 'Controllers\OrderController::list',
    // '/admin/orders/detail/' . $fourth_query => 'Controller\OrderController::detail',

    /**
     * ---------------------
     * Products' area routes
     * ---------------------
     * 
     */
    '/admin/products' => 'Controllers\ProductController::list',
    '/admin/products/create_category' => 'Controllers\ProductController::createCategory',
    '/admin/products/edit_category/' . $fourth_query => 'Controllers\ProductController::editCategory',
    '/admin/products/delete_category/' . $fourth_query => 'Controllers\ProductController::deleteCategory',
    '/admin/products/create' => 'Controllers\ProductController::create',
    '/admin/products/edit/' . $fourth_query => 'Controllers\ProductController::edit',
    '/admin/products/add_photo' => 'Controllers\ProductController::addPhoto',
    '/admin/products/delete_photos/' . $fourth_query => 'Controllers\ProductController::deleteAllPhotos',

    /**
     * ---------------------
     * Banners's area route
     * ---------------------
     * 
     */

     '/admin/banners' => 'Controllers\BannerController::list',
     '/admin/banners/create' => 'Controllers\BannerController::create',
     '/admin/banners/delete/' . $fourth_query => 'Controllers\BannerController::delete',

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