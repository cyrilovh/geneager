<?php
    require "../src/inc/root.php";
    if(!str_contains($_SERVER["REQUEST_URI"], 'XHR')){
        require MVC . "view/router.php"; // le template
    }
?>