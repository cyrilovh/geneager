<?php
    if(isset($_SESSION["username"])){
        \gng\metaTitle::setTitle("Déconnexion");
        $meta_robots = "noindex,nofollow";
        $include_footer = "none";
        session_destroy();
        \gng\mcv::addView("logout");
    }else{
        header("Location: /login", true, 302);
        header('Connection: close');
        exit();
    }
?>