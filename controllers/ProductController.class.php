<?php
namespace Controllers;

use Models\Category;
use Models\Product;

class ProductController
{
    /**
     * ----------------------------------------
     * Display watches group by their category
     * ----------------------------------------
     * 
     */
    public static function list()
    {
        $product_categories = Category::getAll();
        loadView('admin/products/list', [
            'categories' => $product_categories,
        ]);
    }

    /**
     * ---------------------------------------------------------------------------------
     * Display category create form or process creating category when form is submitted
     * ---------------------------------------------------------------------------------
     * 
     * When form is submitted, there are two conditions. One conditions is the form contains both category name and thumbnail data.
     * Another is submitted only with category name. 
     * So, the function have to proccess storing photo in server and storing photo path in database 
     * if the form includes photo.
     * 
     */
    public static function createCategory()
    {
        if(isset($_POST['action']) and $_POST['action'] == 'Create') {
            $required_fields = ['name'];
            $missing_fields = [];
            $error_messages = [];

            $category = '';

            $category = new Category([
                'name' => isset($_POST['name']) ? preg_replace('/[^ a-zA-Z0-9]/', '', $_POST['name']) : '',
            ]);

            foreach($required_fields as $required_field) {
                if(!$category->getValue($required_field)) $missing_fields[] = $required_field;
            }

            if($missing_fields) {
                $error_messages[] = 'There were some missing fields in the form you have submitted.
                Please make sure and click create again.';
            }

            if($error_messages) {
                loadView('admin/products/create_category', [
                    'category' => $category,
                    'missing_fields' => $missing_fields,
                    'error_messages' => $error_messages,
                ]);
            } else {
                if(isset($_FILES['photo']) and $_FILES['photo']) {
                    $name = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];
                    $type = $_FILES['photo']['type'];
                    
                    $destination_file = '';

                    switch($type) {
                        case 'image/jpeg':
                            $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.jpg';
                            break;

                        case 'image/png':
                            $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.png';
                            break;

                        case 'image/gif':
                            $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.gif';
                            break;
                    }

                    if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                        move_uploaded_file($tmp, $destination_file);
                    }

                    $category = new Category([
                        'name' => isset($_POST['name']) ? preg_replace('/[^ a-zA-Z0-9]/', '', $_POST['name']) : '',
                        'photo_name' => $destination_file,
                    ]);
                }
                $category->insert();
                header('location: ' . APP_URL . 'admin/products');
            }
        } else {
            loadView('admin/products/create_category', [
                'category' => new Category([]),
                'missing_fields' => [],
                'error_messages' => [],
            ]);
        }
    }

    /**
     * ------------------------------------------------------------------------------
     * Display category edit form or process editing category when form is submitted
     * ------------------------------------------------------------------------------
     * 
     * When form is submitted, there are two conditions. One conditions it the form contains both category name and thumbnail data.
     * Another is submitted only with category name.
     * If new thumbnail is attached in the form, delete the old photo first and process last processes 
     * those are moving thubmnail into the images/categories and updating the record in database.
     * 
     */
    public static function editCategory()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {        
            if(isset($_POST['action']) and $_POST['action'] == 'Edit') {
                $required_fields = ['id', 'name'];
                $missing_fields = [];
                $error_messages = [];

                $category = '';

                $category = new Category([
                    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
                    'name' => isset($_POST['name']) ? preg_replace('/[^ a-zA-Z0-9]/', '', $_POST['name']) : '',
                ]);

                foreach($required_fields as $required_field) {
                    if(!$category->getValue($required_field)) $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'There were some missing fields in the form you have submitted.
                    Please make sure and click create again.';
                }

                if($error_messages) {
                    $existing_category = Category::getCategory($category->getValue('id'));
                    loadView('admin/products/edit_category', [
                        'category' => $existing_category,
                        'missing_fields' => $missing_fields,
                        'error_messages' => $error_messages,
                    ]);
                } else {
                    if(isset($_FILES['photo']) and $_FILES['photo']) {
                        $existing_category = Category::getCategory($category->getValue('id'));
                        if(file_exists($existing_category->getValue('photo_name')) and !is_dir($existing_category->getValue('photo_name')))
                            unlink($existing_category->getValue('photo_name'));

                        $name = $_FILES['photo']['name'];
                        $tmp = $_FILES['photo']['tmp_name'];
                        $type = $_FILES['photo']['type'];
                        
                        $destination_file = '';

                        switch($type) {
                            case 'image/jpeg':
                                $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.jpg';
                                break;

                            case 'image/png':
                                $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.png';
                                break;

                            case 'image/gif':
                                $destination_file = 'resources/images/categories/' . strtolower(preg_replace('/[^_a-zA-Z0-9]/', '', $category->getValue('name'))) . '.gif';
                                break;
                        }

                        if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                            move_uploaded_file($tmp, $destination_file);
                        }

                        $category = new Category([
                            'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
                            'name' => isset($_POST['name']) ? preg_replace('/[^ a-zA-Z0-9]/', '', $_POST['name']) : '',
                            'photo_name' => $destination_file,
                        ]);
                    }
                    $category->update();
                    header('location: ' . APP_URL . 'admin/products');
                }

            } else {
                $category = Category::getCategory($_GET['fourth-query']);
                loadView('admin/products/edit_category', [
                    'category' => $category,
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            } 
        } else {
            header('location: ' . APP_URL . 'admin/products');
        }
    }


    /**
     * --------------------------------------------------------------------
     * Display confirm form to delete category or process deleting process
     * --------------------------------------------------------------------
     * When category will be deleted, category's thumbnail should be deleted 
     * and category's respective products should be deleted. 
     * So, admin should notice the effect of deleting category and confirm to delete 
     * by typing this text 'I am sure. Delete this category and its respective data.'
     * 
     */
    public static function deleteCategory()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            if(isset($_POST['action']) and $_POST['action'] == 'Delete') {
                $required_fields = ['id'];
                $missing_fields = [];
                $error_messages = [];

                $category = new Category([
                    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '', 
                ]);

                foreach($required_fields as $required_field) {
                    if(!$category->getValue($required_field)) $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'Missing id.';
                }

                if(!$error_messages and isset($_POST['confirm-text']) and $_POST['confirm-text'] === 'I am sure. Delete this category and its respective data.') {
                    $products = Product::getByCategoryID($category->getValue('id'));
                    foreach($products as $product) {
                        for($i=0; $i<$product->getValue('photo_qty'); $i++) {
                            $file = $product->getValue('photo_name') . $i . '.jpg';

                            if(file_exists($file) and !is_dir($file))
                                unlink($file);
                        }
                    }
                    Product::deleteByCategoryID($category->getValue('id'));

                    $existing_category = Category::getCategory($category->getValue('id'));
                    if(file_exists($existing_category->getValue('photo_name')) and !is_dir($existing_category->getValue('photo_name')))
                        unlink($existing_category->getValue('photo_name'));
                    $category->delete();

                    header('location: ' . APP_URL . 'admin/products');
                } else {
                    $error_messages[] = 'Make sure! Please type exactly to confirm.';
                }

                if($error_messages) {
                    loadView('admin/products/delete_category', [
                        'category' => $category,
                        'missing_fields' => [],
                        'error_messages' => $error_messages,
                    ]);
                }
            } else {
                $category = Category::getCategory($_GET['fourth-query']);
                loadView('admin/products/delete_category', [
                    'category' => $category,
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            }
        } else {
            header('location: ' . APP_URL . 'admin/products');
        }
    }

    public static function create()
    {
        if(isset($_POST['action']) and $_POST['action'] == 'Create') {
            $required_fields = ['name', 'description', 'category_id', 'price', 'discount_percentage', 'is_out_of_stock'];
            $missing_fields = [];
            $error_messages = [];

            $product = new Product([
                'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
                'description' => isset($_POST['description']) ? $_POST['description'] : '',
                'category_id' => isset($_POST['category_id']) ? preg_replace('/[^0-9]/', '', $_POST['category_id']) : '',
                'price' => isset($_POST['price']) ? preg_replace('/[^0-9]/', '', $_POST['price']) : '',
                'discount_percentage' => isset($_POST['discount_percentage']) ? preg_replace('/[^0-9]/', '', $_POST['discount_percentage']) : '',
                'is_out_of_stock' => isset($_POST['is_out_of_stock']) ? ($_POST['is_out_of_stock']) : '',
            ]);

            foreach($required_fields as $required_field) {
                if($product->getValue($required_field) === '') $missing_fields[] = $required_field;
            }

            if($missing_fields) {
                $error_messages[] = 'There were some missing fields in the form you have submitted. 
                Please complete the required information and click create again.';
            }

            if($error_messages) {
                $categories = Category::getAll();
                loadView('admin/products/create', [
                    'categories' => $categories,
                    'product' => $product,
                    'missing_fields' => $missing_fields,
                    'error_messages' => $error_messages,
                ]);
            } else {
                $product->insert();
                header('location: ' . APP_URL . 'admin/products');
            }

        } else {
            $categories = Category::getAll();
            loadView('admin/products/create', [
                'categories' => $categories,
                'product' => new Product([]),
                'missing_fields' => [],
                'error_messages' => [],
            ]);
        }
    }

    public static function edit()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            if(isset($_POST['action']) and $_POST['action'] == 'Edit') {
                $required_fields = [ 'id', 'name', 'description', 'category_id', 'price', 'discount_percentage', 'is_out_of_stock'];
                $missing_fields = [];
                $error_messages = [];

                $product = new Product([
                    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
                    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
                    'description' => isset($_POST['description']) ? $_POST['description'] : '',
                    'category_id' => isset($_POST['category_id']) ? preg_replace('/[^0-9]/', '', $_POST['category_id']) : '',
                    'price' => isset($_POST['price']) ? preg_replace('/[^0-9]/', '', $_POST['price']) : '',
                    'discount_percentage' => isset($_POST['discount_percentage']) ? preg_replace('/[^0-9]/', '', $_POST['discount_percentage']) : '',
                    'is_out_of_stock' => isset($_POST['is_out_of_stock']) ? ($_POST['is_out_of_stock']) : '',
                ]);

                foreach($required_fields as $required_field) {
                    if($product->getValue($required_field) === '') $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'There were some missing fields in the form you have submitted. 
                    Please complete the required information and click edit again.';
                }

                if($error_messages) {
                    $existing_product = Product::getProduct($product->getValue('id'));
                    $categories = Category::getAll();
                    loadView('admin/products/create', [
                        'categories' => $categories,
                        'product' => $existing_product,
                        'missing_fields' => $missing_fields,
                        'error_messages' => $error_messages,
                    ]);
                } else {
                    $product->update();
                    header('location: ' . APP_URL . 'admin/products');
                }

            } else {
                $existing_product = Product::getProduct($_GET['fourth-query']);
                $categories = Category::getAll();
                loadView('admin/products/edit', [
                    'categories' => $categories,
                    'product' => $existing_product,
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            }
        } else {
            header('location: ' . APP_URL . 'admin/products');
        }
    }

    public static function addPhoto()
    {
        if(isset($_POST['id']) and $_POST['id']) {
            if(isset($_POST['action']) and $_POST['action'] == 'Add Photo') {
                $existing_product = Product::getProduct($_POST['id']);

                $name = $_FILES['photo']['name'];
                $tmp = $_FILES['photo']['tmp_name'];
                $type = $_FILES['photo']['type'];

                if($type == 'image/jpeg') {
                    $destination_file = '';

                    if((int)$existing_product->getValue('photo_qty') > 0)
                        $destination_file = $existing_product->getValue('photo_name');
                    else
                        $destination_file = 'resources/images/products/' . strtolower(preg_replace('/[^ _a-zA-Z0-9]/', '', $existing_product->getValue('name'))) . '_';

                    $product = new Product([
                        'id' => $_POST['id'],
                        'photo_qty' => (int)$existing_product->getValue('photo_qty') + 1,
                        'photo_name' => $destination_file,
                    ]);

                    $destination_file .= (int)$existing_product->getValue('photo_qty') . '.jpg';
                    move_uploaded_file($tmp, $destination_file);

                    $product->updatePhoto();
                    header('location: ' . APP_URL . 'admin/products/edit/' . $existing_product->getValue('id'));
                    exit();
                }
            }
        }
        header('location: ' . APP_URL . 'admin/products');
    }

    public static function deleteAllPhotos()
    {
        if(isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            $existing_product = Product::getProduct($_GET['fourth-query']);
            if((int)$existing_product->getValue('photo_qty') > 0) {
                for($i=0; $i < $existing_product->getValue('photo_qty'); $i++) {
                    $photo_file = $existing_product->getValue('photo_name') . $i . '.jpg';
                    if(file_exists($photo_file) and !is_dir($photo_file))
                        unlink($photo_file);
                }
            }
            $product = new Product([
                'id' => $_GET['fourth-query'],
                'photo_qty' => 0,
                'photo_name' => '',
            ]);

            $product->updatePhoto();
            header('location: ' . APP_URL . 'admin/products/edit/' . $existing_product->getValue('id'));
        } else {
            header('location: ' . APP_URL . 'admin/products');
        }
    }
}