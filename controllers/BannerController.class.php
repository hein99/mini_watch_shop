<?php

namespace Controllers;

use Models\Banner;

class BannerController
{
    public static function list()
    {
        $banners = Banner::getAll();

        loadView('admin/banners/list', [
            'banners' => $banners,
        ]);
    }

    public static function create()
    {
        if(isset($_FILES['photo']) and $_FILES['photo']) {
            $name = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];
            $type = $_FILES['photo']['type'];

            if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                $destination_file = 'resources/images/banners/'.time();

                switch($type) {
                    case 'image/jpeg' :
                        $destination_file .= '.jpg';
                        break;

                    case 'image/png' :
                        $destination_file .= '.png';
                        break;

                    case 'image/gif' :
                        $destination_file .= '.gif';
                        break;
                }
                $banner = new Banner([
                    'photo_name' => $destination_file,
                ]);

                move_uploaded_file($tmp, $destination_file);
                $banner->insert(); 
            }
        }

        header('location: ' . APP_URL . 'admin/banners');
    }

    public static function delete()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            $banner = new Banner([
                'id' => preg_replace('/[^0-9]/', '', $_GET['fourth-query']),
            ]);
            $banner->delete();
        }
        
        header('location: ' . APP_URL . 'admin/banners');
    }
}