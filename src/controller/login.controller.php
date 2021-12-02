<?php
    \gng\metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    $meta_robots = "noindex,nofollow";
    $include_footer = "none";
    \gng\additionnalJsCss::set("login.css");

    if(isset($_POST["submit"])){ // check if form is submit
        if(isset($_POST["username"]) && isset($_POST["password"])){ // check if the both input are submit
            if(strlen(trim($_POST["username"]))>=$parametersFromDB["usernameMinLength"] && strlen(trim($_POST["password"]))>=$parametersFromDB["passwordMinLength"]){ // we check the min length of the password and username
                $username = $_POST["username"];
                //$password = \gng\format::cleanStr($_POST["password"]); // attention hasher pas nettoyer


                $userInfo = \gng\db::getUserInfo($username, array("username","password","role")); // i interrogates the database

                if(count($userInfo)==1){ // if i 1 user matching
                    if(\gng\password::match($userInfo[0]["password"],$_POST["password"])){ // if the passwords match
                        $_SESSION["username"] = $userInfo[0]["username"];
                        $userInfo[0]["role"] = $userInfo[0]["role"];
                        header('Location: /');
                        exit();
                    }else{ // if password x username mismatch
                        $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                        \gng\mcv::addView("login"); 
                    }
                }else{ // if any or multiple users
                    $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                    \gng\mcv::addView("login");
                }
                print_r($userInfo);
            }else{ // the min length (parameters from DB) of the password or username is false
                $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                \gng\mcv::addView("login");
            }
        }else{ // password input or username input missing
            $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
            \gng\mcv::addView("login");
        }
    }else{ // if form is not submit
        \gng\mcv::addView("login");
    }
?>