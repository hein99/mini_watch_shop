<?php
namespace Controllers;

use Models\Order;
use Models\Product;
use Models\Category;

class OrderController
{
    public static function list()
    {   
        $start = isset( $_GET['start'] ) ? (int)$_GET['start'] : 0;
        $status = isset( $_GET['status'] ) ? preg_replace( '/[^a-z]/', '', $_GET['status'] ) : null;
        if($status == 'all') $status = null;

        list($orders, $total_rows) = Order::getOrders($start, NUMBER_OF_ROWS, $status);
        loadView('admin/orders/list', [
            'orders' => $orders,
            'total_rows' => $total_rows,
            'start' => $start,
            'status' => $status
        ]);
    }

    public static function edit()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            if(isset($_POST['action']) and $_POST['action'] == 'Edit') {
                $required_fields = ['id', 'customer_name', 'customer_phone', 'customer_address', 'watch_id', 'status'];
                $missing_fields = [];
                $error_messages = [];

                $order = new Order([
                    'id' => isset($_POST['id']) ? preg_replace('/[^\d]/', '', $_POST['id']) : '',
                    'customer_name' => isset($_POST['customer_name']) ? preg_replace('/[^ \w]/', '', $_POST['customer_name']) : '',
                    'customer_phone' => isset($_POST['customer_phone']) ? preg_replace('/[^\d]/', '', $_POST['customer_phone']) : '',
                    'customer_address' => isset($_POST['customer_address']) ? preg_replace('/[^, \-\w]/', '', $_POST['customer_address']) : '',
                    'watch_id' => isset($_POST['watch_id']) ? preg_replace('/[^\d]/', '', $_POST['watch_id']) : '',
                    'status' => isset($_POST['status']) ? preg_replace('/[^a-z]/', '', $_POST['status']) : '',
                ]);

                foreach($required_fields as $required_field) {
                    if($order->getValue($required_field) == '') $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'There were some missing fields in the form you have submitted. Please make sure and click edit again.';
                }

                if($error_messages) {
                    $order = Order::getOrder($_GET['fourth-query']);
                    $product = Product::getProduct($order->getValue('watch_id'));
                    $category = Category::getCategory($product->getValue('category_id'));
                    loadView('admin/orders/edit', [
                        'product' => $product,
                        'order' => $order,
                        'category' => $category,
                        'missing_fields' => $missing_fields,
                        'error_messages' => $error_messages,
                    ]);
                } else {
                    $order->update();
                    header('location: ' . APP_URL . 'admin/orders/edit/' . $order->getValue('id') . '?info=Success%20Edit');
                }

            } else {
                $order = Order::getOrder($_GET['fourth-query']);
                $product = Product::getProduct($order->getValue('watch_id'));
                $category = Category::getCategory($product->getValue('category_id'));
                loadView('admin/orders/edit', [
                    'product' => $product,
                    'order' => $order,
                    'category' => $category,
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            }
        } else {
            header('location: ' . APP_URL . 'admin/orders');
        }
    }

    public static function add()
    {
        $required_fields = ['customer_name', 'customer_phone', 'customer_address', 'watch_id'];
        $missing_fields = [];

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
            echo json_encode([
                'status' => 'failed',
                'missing_fields' => $missing_fields
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

    public static function track()
    {
        if(isset($_GET['action']) and $_GET['action'] == 'Track') {
            $tracking_code = isset($_GET['tracking_code']) ? preg_replace('/[^0-9a-z]/', '', $_GET['tracking_code']) : '';

            if($tracking_code) {
                $order = Order::getOrderByTrackingCode($tracking_code);
                $product = Product::getProduct($order->getValue('watch_id'));
                $category = Category::getCategory($product->getValue('category_id'));
                loadView('orders/detail', [
                    'order' => $order,
                    'product' => $product,
                    'category' => $category
                ]);

            } else {
                loadView('orders/tracking_order_form',[
                    'error_messages' => ['Tracking code field missing. Please make sure and click track again'],
                ]);
            }
        } else {
            loadView('orders/tracking_order_form', [
                'error_messages' => [],
            ]);
        }
    }
}