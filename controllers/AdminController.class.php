<?php
namespace Controllers;

use Models\Admin;

class AdminController
{

    /**
     * -----------------------------------------
     * Display login form or process login form
     * -----------------------------------------
     * If user send login credentials, this function will process 
     * whether this user's login credentials has in database or not.
     * If authentication success this user row is store in session by a way of an admin object
     * and redirect to admin/orders 
     * 
     */
    public static function login()
    {
        if(isset($_POST['action']) and $_POST['action'] == 'Login') {
            $required_fields = ['email', 'password'];
            $missing_fields = [];
            $error_messages = [];

            $admin = new Admin([
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'password' => isset($_POST['password']) ? $_POST['password'] : ''
            ]);
            
            foreach($required_fields as $required_field) {
                if(!$admin->getValue($required_field)) $missing_fields[] = $required_field;
            }

            if($missing_fields) {
                $error_messages[] = 'There were some missing fields in the form you have submitted. 
                Please complete the username and password and click Login again.';
            } elseif(!$logged_in_admin = $admin->authenticate()) {
                $error_messages[] = 'Sorry, we could not login with your information. 
                Please check your username and password, and try again.';
            }

            if($error_messages) {
                loadView('admin/auth/login', [
                    'admin' => $admin,
                    'missing_fields' => $missing_fields,
                    'error_messages' => $error_messages,
                ]);
            } else {
                session_start();
                $_SESSION['admin'] = $logged_in_admin;
                header('location: ' . APP_URL . 'admin');
            }

        } else {
            loadView('admin/auth/login', [
                'admin' => new Admin([]),
                'missing_fields' => [],
                'error_messages' => [],
            ]);
        }
            
    }

    /**
     * ----------------
     * Logout function
     * ----------------
     * assing $_SESSION['admin'] = null;
     * and redirect to login page
     * 
     */
    public static function logout()
    {
        session_start();
        $_SESSION['admin'] = null;
        
        header('location: ' . APP_URL . 'auth/login');
    }

    /**
     * -------------------------
     * Display all page admins
     * -------------------------
     * 
     */
    public static function list()
    {
        $data = Admin::getAll();
        loadView('admin/page_admins/list', [
            'admins' => $data,
        ]);
    }

    /**
     * --------------------------------------------------------------
     * Display new admin create form and process from form submitted
     * ---------------------------------------------------------------
     * If the create form is submitted, this function will process creating admin process
     * 
     * Only id(1) admin can create, edit, and delete other admins' data
     * 
     */
    public static function create()
    {
        if($_SESSION['admin']->getValue('id') == 1) {
            if(isset($_POST['action']) and $_POST['action'] == 'Create') {
                $required_fields = ['email', 'password', 'name', 'phone'];
                $missing_fields = [];
                $error_messages = [];

                $admin = new Admin([
                    'email' => isset($_POST['email']) ? $_POST['email'] : '',
                    'password' => (isset($_POST['password1']) and isset($_POST['password2'])and $_POST['password1'] == $_POST['password2']) ? $_POST['password1'] : '',
                    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-z0-9]/', '', $_POST['name']) : '',
                    'phone' => isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '',
                ]);

                foreach($required_fields as $required_field) {
                    if(!$admin->getValue($required_field)) $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'There were some missing fields in the form you have submitted. 
                    Please complete the required information and click submit again.';
                }

                /**
                 * Email of admins have to be unique in database
                 * 
                 */

                if(Admin::getByEmail($admin->getValue('email'))) {
                    $error_messages[] = 'A admin with that email address already exists in the website.
                    Please make sure email address or use another email address.';
                }

                if($error_messages) {
                    loadView('admin/page_admins/create', [
                        'admin' => $admin,
                        'missing_fields' => $missing_fields,
                        'error_messages' => $error_messages,
                    ]);
                } else {
                    $admin->insert();
                    header('location: ' . APP_URL . 'admin/admins');
                }

            } else {
                loadView('admin/page_admins/create', [
                    'admin' => new Admin([]),
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            }                  
        } else {
            header('location: ' . APP_URL . 'admin/admins');
        }
    }

    /**
     * --------------------------------------------------------------
     * Display admin edit form and process from form submitted
     * ---------------------------------------------------------------
     * If the edit form is submitted, this function will process editing admin process
     * 
     * Only id(1) admin can create, edit, and delete other admins' data
     * 
     * To display edit form, admin id is needed to edit
     * 
     */
    public static function edit()
    {
        if($_SESSION['admin']->getValue('id') == 1 and isset($_GET['fourth-query']) and $_GET['fourth-query']) {

            if(isset($_POST['action']) and $_POST['action'] == 'Edit') {
                $required_fields = ['email', 'name', 'phone'];
                $missing_fields = [];
                $error_messages = [];

                $temp_admin = new Admin([
                    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
                    'email' => isset($_POST['email']) ? $_POST['email'] : '',
                    'password' => isset($_POST['password']) ? $_POST['password'] : '',
                    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-z0-9]/', '', $_POST['name']) : '',
                    'phone' => isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '',
                ]);

                foreach($required_fields as $required_field) {
                    if(!$temp_admin->getValue($required_field)) $missing_fields[] = $required_field;
                }

                if($missing_fields) {
                    $error_messages[] = 'There were some missing fields in the form you have submitted. 
                    Please complete the required information and click submit again.';
                }

                /**
                 * Email of admins have to be unique in database
                 * 
                 */

                if($existing_admin = Admin::getByEmail($temp_admin->getValue('email')) and $existing_admin->getValue('id') != $temp_admin->getValue('id')) {
                    $error_messages[] = 'A admin with that email address already exists in the website.
                    Please make sure email address or use another email address.';
                }

                if($error_messages) {
                    loadView('admin/page_admins/edit', [
                        'admin' => $temp_admin,
                        'missing_fields' => $missing_fields,
                        'error_messages' => $error_messages,
                    ]);
                } else {
                    $temp_admin->update();
                    header('location: ' . APP_URL . 'admin/admins');
                }


            } else {
                $admin = Admin::getAdmin($_GET['fourth-query']);
                loadView('admin/page_admins/edit', [
                    'admin' => $admin,
                    'missing_fields' => [],
                    'error_messages' => [],
                ]);
            }
        } else {
            header('location: ' . APP_URL . 'admin/admins');
        }
    }

    /**
     * --------------------------------------------------------------
     * Display admin edit form and process from form submitted
     * ---------------------------------------------------------------
     * If the edit form is submitted, this function will process editing admin process
     * 
     * Only id(1) admin can create, edit, and delete other admins' data
     * 
     * 
     */

    public static function delete()
    {
        if($_SESSION['admin']->getValue('id') == 1 and isset($_GET['fourth-query']) and $_GET['fourth-query']) {
            $admin = new Admin([
                'id' => isset($_GET['fourth-query']) ? preg_replace('/[^0-9]/', '', $_GET['fourth-query']) : '', 
            ]);

            if($admin->getValue('id'))
                $admin->delete();
                
            header('location: ' . APP_URL . 'admin/admins');
        } else {
            header('location: ' . APP_URL . 'admin/admins');
        }
    }
}