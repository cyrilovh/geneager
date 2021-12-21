<!DOCTYPE html><!-- for all files -->
<?php
    /* This page is the router */
    define('MVC', "../src/"); // We defined "MVC" folder
    define('FULLPATH', $_SERVER['REQUEST_URI']);

    require_once MVC."config.php"; // Config file (for database, ...)

    // autoload PHP classes
    require_once MVC."class/autoload.class.php";
    autoloader::register();

    // i connect me to database
    \gng\db::connect();
    require_once MVC."controller/router.controller.php"; // le template
?>