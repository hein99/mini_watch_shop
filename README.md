# mini_watch_shop
This is a mini online shopping project to practice OOP and MVC pattern concept.

# To test this project on your machine
Step 1. Copy or clone this project folder into your websever document root folder
Step 2. Create Database with the name of 'mini_watch_shop'
Step 3. Import Database tables into the mini_watch_shop database using 'mini_watch_shop.sql' this file is included in this project folder.
Step 4. Change website info and database info in the 'config.php'
Step 5. RewriteBase might be changed depend on your server
Step 6. Resource routes in css might be needed to change
Step 7. if you use MYSQL SERVER 8.0, you need to change password(:password) to CONCAT(\'*\', UPPER(SHA1(UNHEX(SHA1(:password))))) at models/Admin.class.php::(line)118

# this project is hosted at http://demo1.heinkaungkhant.com/

# access admin area using following info
Email : hkk@example.com
password : password

