<!DOCTYPE html><!-- for all files -->
<?php
    /* This page is the router */
    define('MVC', "../src/"); // We defined "MVC" folder
    define('FULLPATH', $_SERVER['REQUEST_URI']);

    require_once MVC."config.php"; // Config file (for database, ...)
    require_once MVC."model/router.model.php"; // classes of index
    require_once MVC."controller/router.controller.php"; // le template
?>