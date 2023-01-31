<?php
    namespace class;
    if(isset($_SESSION["username"])){
        

        metaTitle::setTitle("Déconnexion");
        metaTitle::setRobot(array("noindex","nofollow"));

        $include_footer = "none";
        session_destroy();
        header("Location: /login/?logout", true, 302);
    }else{
        header("Location: /login", true, 302);
        header('Connection: close');
        exit();
    }
?>