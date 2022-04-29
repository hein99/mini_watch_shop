<?php
include('config.php');

include('controllers/AdminController.class.php');
include('controllers/BannerController.class.php');
include('controllers/HomeController.class.php');
include('controllers/OrderController.class.php');
include('controllers/ProductController.class.php');


include('models/DataObject.class.php');
include('models/Admin.class.php');
include('models/Banner.class.php');
include('models/Category.class.php');
include('models/Product.class.php');


/**
 * ---------------------------------------------------------------------------
 * Validate field function to output 'class="error"' in required field of form
 * ---------------------------------------------------------------------------
 * 
 */

function validateField($field_name, $missing_fields) {
    if(in_array($field_name, $missing_fields)) echo ' class="error"';
}

function setChecked(Models\DataObject $obj, $field_name, $field_value) {
    if($obj->getValue($field_name) == $field_value) echo ' checked="checked"';
}

function setSelected(Models\DataObject $obj, $field_name, $field_value) {
    if($obj->getValue($field_name) == $field_value) echo ' selected="selected"';
}

/**
 * ---------------------------------------
 * Page Header template for customer view
 * ----------------------------------------
 * 
 */

function displayPageHeader($title, $nav_link)
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title . ' | ' . APP_NAME ?></title>
        <link rel="stylesheet" href="<?php echo APP_URL ?>resources/css/reset.css">
        <link rel="stylesheet" href="<?php echo APP_URL ?>resources/css/style.css">
    </head>
    <header class="pg-header">
        <div class="pg-logo">
            <h1><span class="upper">MINI</span><span class="lower">Watch Shop</span></h1>
        </div>

        <ul>
            <?php if($nav_link == 'products') : ?>
                <li><a href="#" class="active">Products</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>products">Products</a></li>
            <?php endif; ?>

            <?php if($nav_link == 'orders') : ?>
                <li><a href="#" class="active">Track Order</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>/orders/track">Track Order</a></li>
            <?php endif; ?>

            <?php if($nav_link == 'contact_us') : ?>
                <li><a href="#" class="active">Contact Us</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>/contact_us">Contact Us</a></li>
            <?php endif; ?>

            <?php if($nav_link == 'about_us') : ?>
                <li><a href="#" class="active">About Us</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>/about_us">About Us</a></li>
            <?php endif; ?>
        </ul>
    </header>

    <body>
<?php
}

/**
 * ---------------------------------------
 * Page footer template for customer view
 * ----------------------------------------
 * 
 */


function displayPageFooter()
{ ?>
    </body>
    </html>
<?php
}


/**
 * ---------------------------------------
 * Page Header template for admin view
 * ----------------------------------------
 * 
 */

function displayAdminPageHeader($title, $nav_link)
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title . ' | ' . APP_NAME ?></title>
        <link rel="stylesheet" href="<?php echo APP_URL ?>resources/css/reset.css">
        <link rel="stylesheet" href="<?php echo APP_URL ?>resources/css/admin_style.css">
    </head>
    <body>
        <?php 
        /**
         * if the admin has logged in, the following header will show
         * 
         */
        if(isset($_SESSION['admin']) and $_SESSION['admin']) :
        ?>
            <header class="pg-header">
                <div class="pg-logo">
                    <h1><span class="upper">MINI</span><span class="lower">Watch Shop</span></h1>
                </div>

                <ul>
                    <?php if($nav_link == 'orders') : ?>
                        <li><a href="#" class="active">Orders</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/orders">Orders</a></li>
                    <?php endif; ?>

                    <?php if($nav_link == 'banners') : ?>
                        <li><a href="#" class="active">Banners</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/banners">Banners</a></li>
                    <?php endif; ?>

                    <?php if($nav_link == 'watches') : ?>
                        <li><a href="#" class="active">Products</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/products">Products</a></li>
                    <?php endif; ?>
                    
                    <?php if($nav_link == 'admins') : ?>
                        <li><a href="#" class="active">Page&nbsp;Admins</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/admins">Page&nbsp;Admins</a></li>
                    <?php endif; ?>

                    <li><a href="<?php echo APP_URL ?>auth/logout">Logout</a></li>
                </ul>
            </header>
        <?php endif; ?>
<?php
}

/**
 * ---------------------------------------
 * Page Footer template for adimin view
 * ----------------------------------------
 * 
 */


function displayAdminPageFooter()
{ ?>
    </body>
    </html>
<?php
}

/**
 * ----------------------------
 * Loading view file function
 * ----------------------------
 * This function is called from controllers
 * 
 */

function loadView($template, Array $data = [])
{
    $view_file = 'resources/views/' . $template . '.php';

    if(file_exists($view_file) and !is_dir($view_file)) {
        include($view_file);
    } else {
        die('View not found');
    }
}


/**
 * ---------------------------------------------------------------
 * Checking Login function
 * ----------------------------------------------------------------
 * it execute everytime when user access admin's area
 * When authentication failed, redirect to login page
 */

 function checkLogin()
 {
    session_start();
    if(!$_SESSION['admin'] or !$_SESSION['admin'] == Models\Admin::getAdmin($_SESSION['admin']->getValue('id'))) {
        $_SESSION['admin'] = null;
        header('location: ' . APP_URL . 'auth/login');
        exit();
    }
    
    return true;
 }
