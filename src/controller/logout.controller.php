<?php
    namespace gng;
    if(isset($_SESSION["username"])){
        metaTitle::setTitle("Déconnexion");
        $meta_robots = "noindex,nofollow";
        $include_footer = "none";
        session_destroy();
        mcv::addView("logout");
    }else{
        header("Location: /login", true, 302);
        header('Connection: close');
        exit();
    }
?>