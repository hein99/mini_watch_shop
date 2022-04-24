<?php
namespace Controllers;

use \Models\Banner;

class Home
{
    public static function home()
    {   
        echo "Hello From Home Controller";
        $banner = new Banner(['a', 'b']);
        echo $banner->greet();
    }
}