<?php 
    \gng\metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    $meta_robots = "noindex,nofollow";
    \gng\additionnalJsCss::set("login.css");

    if(isset($_POST["submit"])){ // check if form is submit
        if(isset($_POST["username"]) && isset($_POST["password"])){ // check if the both input are submit
            if(strlen(trim($_POST["username"]))>=$parametersFromDB["usernameMinLength"] && strlen(trim($_POST["password"]))>=$parametersFromDB["passwordMinLength"]){ // we check the min length of the password and username
                $username = $_POST["username"];
                $password = \gng\format::cleanStr($_POST["password"]);

                $userInfo = \gng\db::getUserInfo($username, array("username","password"));

                if(count($userInfo)==1){ // if i a user matching
                    // A CONTINUER
                    //$secret = \gng\security::encrypt("motDePasse", KEY_EMAIL);
                    //echo $secret."<br>";
                    //echo \gng\security::decrypt($secret,KEY_EMAIL);
                }
                print_r($userInfo);
            }else{
                $msg_mismatch = "Identifiant ou mot de passe incorrect. 1"; 
                \gng\mcv::addView("login");
            }
        }else{
            $msg_mismatch = "Identifiant ou mot de passe incorrect. 2"; 
            \gng\mcv::addView("login");
        }
    }else{
        \gng\mcv::addView("login");
    }
?>