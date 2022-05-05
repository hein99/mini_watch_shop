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
        <a href="<?php echo APP_URL ?>">
            <div class="pg-logo">
                <h1><span class="upper">MINI</span><span class="lower">Watch Shop</span></h1>
            </div>
        </a>

        <button class="nav-open-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>

        <button class="nav-close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </button>
        <ul id="nav">
            <?php if($nav_link == 'products') : ?>
                <li>
                    <a href="#" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                            <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V5z"/>
                            <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a5.99 5.99 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A5.99 5.99 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667H5.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
                        </svg>&nbsp;Products
                    </a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?php echo APP_URL ?>products">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                            <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V5z"/>
                            <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a5.99 5.99 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A5.99 5.99 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667H5.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
                        </svg>&nbsp;Products
                    </a>
                </li>
            <?php endif; ?>

            <?php if($nav_link == 'orders') : ?>
                <li>
                    <a href="#" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>&nbsp;Track Order
                    </a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?php echo APP_URL ?>orders/track">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>&nbsp;Track Order
                    </a>
                </li>
            <?php endif; ?>

            <?php if($nav_link == 'contact_us') : ?>
                <li><a href="#" class="active">Contact Us</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>contact_us">Contact Us</a></li>
            <?php endif; ?>

            <?php if($nav_link == 'about_us') : ?>
                <li><a href="#" class="active">About Us</a></li>
            <?php else : ?>
                <li><a href="<?php echo APP_URL ?>about_us">About Us</a></li>
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

    <footer>All rights reserved. &copy;<?php echo date('Y') ?></footer>
        <script>
            var nav_open_btn = document.querySelector('.nav-open-btn');
            var nav_close_btn = document.querySelector('.nav-close-btn');
            var nav_container = document.querySelector('#nav');

            nav_open_btn.addEventListener('click', e => {
                nav_container.style.display = 'block';
                nav_close_btn.style.display = 'block';

                nav_open_btn.style.display = 'none';
            });

            nav_close_btn.addEventListener('click', e => {
                nav_container.style.display = 'none';
                nav_close_btn.style.display = 'none';

                nav_open_btn.style.display = 'block';
            })

        </script>
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
                <a href="<?php echo APP_URL ?>admin">
                    <div class="pg-logo">
                        <h1><span class="upper">MINI</span><span class="lower">Watch Shop</span></h1>
                    </div>
                </a>

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

                    <?php if($nav_link == 'products') : ?>
                        <li><a href="#" class="active">Products</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/products">Products</a></li>
                    <?php endif; ?>
                    
                    <?php if($nav_link == 'admins') : ?>
                        <li><a href="#" class="active">Page&nbsp;Admins</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo APP_URL ?>admin/admins">Page&nbsp;Admins</a></li>
                    <?php endif; ?>

                    <li>
                        <a href="<?php echo APP_URL ?>auth/logout" title="Log Out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                            <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        </a>
                    </li>
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
