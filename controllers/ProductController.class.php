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
}