<?php
namespace Controllers;

class OrderController
{
    public static function list()
    {
        loadView('admin/orders/list');
    }
}