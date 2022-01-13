<!DOCTYPE html><!-- for all files -->
<?php
    /* This page is the router */
    define('MVC', "../src/"); // We defined "MVC" folder
    define('FULLPATH', $_SERVER['REQUEST_URI']);

    require_once MVC."config.php"; // Config file (for database, ...)

    // autoload PHP classes
    require_once MVC."autoload.php";
    autoloader::register();

    // i connect me to database
    class\db::connect();
    require_once MVC."controller/router.php"; 
    
    require MVC."view/router.php"; // le template
?>