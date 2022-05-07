<?php
namespace Controllers;

use Models\Order;

class OrderController
{
    public static function list()
    {
        loadView('admin/orders/list');
    }

    public static function add()
    {
        $required_fields = ['customer_name', 'customer_phone', 'customer_address', 'watch_id'];
        $missing_fields = [];
        $error_messages = [];

        $order = new Order([
            'customer_name' => isset($_POST['customer_name']) ? preg_replace('/[^ \w]/', '', $_POST['customer_name']) : '',
            'customer_phone' => isset($_POST['customer_phone']) ? preg_replace('/[^\d]/', '', $_POST['customer_phone']) : '',
            'customer_address' => isset($_POST['customer_address']) ? preg_replace('/[^ \w]/', '', $_POST['customer_address']) : '',
            'watch_id' => isset($_POST['watch_id']) ? preg_replace('/[^0-9]/', '', $_POST['watch_id']) : '',
        ]);

        foreach($required_fields as $required_field) {
            if($order->getValue($required_field) === '') $missing_fields[] = $required_field;
        }

        if($missing_fields) {
            $error_messages[] = 'There were some missing field in the form you have submitted. 
            Please make sure and click Order again.';
        }

        if($error_messages) {
            echo json_encode([
                'status' => 'failed',
                'missing_field' => $missing_fields,
                'error_messages' => $error_messages
            ]);
        } else {
            $new_order = new Order([
                'customer_name' => $order->getValue('customer_name'),
                'customer_phone' => $order->getValue('customer_phone'),
                'customer_address' => $order->getValue('customer_address'),
                'watch_id' => $order->getValue('watch_id'),
                'tracking_code' => md5($order->getValue('customer_name').time()),
            ]);

            $new_order->insert();

            echo json_encode([
                'status' => 'success',
                'tracking_code' => $new_order->getValue('tracking_code')
            ]);
        }
    }
}