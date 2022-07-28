<!DOCTYPE html><!-- for all files -->
<?php
/* This page is the router */
define('MVC', "../src/"); // We defined "MVC" folder
define('FULLPATH', $_SERVER['REQUEST_URI']);

if (file_exists(MVC . "config.php")) {
    require_once MVC . "config.php";
} else {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    require_once MVC."view/setup/newSetup.html";
    exit();
}


// autoload PHP classes
require_once MVC . "autoload.php";
autoloader::register();

// i connect me to database
class\db::connect();
require_once MVC . "controller/router.php";

require MVC . "view/router.php"; // le template
?>