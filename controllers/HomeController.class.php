<?php
namespace Controllers;

use \Models\Banner;
use \Models\Category;

class HomeController
{
    public static function home()
    {
        $banners = Banner::getAll();
        $categories = Category::getAll();
        loadView('home', [
            'banners' => $banners,
            'categories' => $categories,
        ]);
    }

    public static function contact_us()
    {
        loadView('contact-us');
    }

    public static function about_us()
    {
        loadView('about-us');
    }

}