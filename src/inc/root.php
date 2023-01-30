<?php
    /**
     * This file is required for use the basics functions of the CMS
     * It's recommanded to use this file in all your files in the "public" folder
     */

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
?>