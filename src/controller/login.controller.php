<?php

namespace gng;

    metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    $meta_robots = "noindex,nofollow";
    $include_footer = "none";
    additionnalJsCss::set("login.css");

    $formLogin = new form(array( // i declare my new object
        "method" => "post", // i give the method attr
        "action" => "", // i give action attr
        "class"=>"login", // i give className ou className list (not required)
    ));

    $formLogin->setElement("input", array( // here i give the type of tag
        "type" => "text", // i give the type of input
        "placeholder" => "Nom d&apos;utilisateur", // i set a placeholder
        "name" => "username", // i give a className
        "required" => "required", // i add the attr required
        "minlength" => db::getParameter("usernameMinLength"), // i add the attr minlength
        "maxlength" => db::getParameter("usernameMaxLength") // i add the attr maxlength
    ));

    $formLogin->setElement("input", array(
        "type" => "password",
        "placeholder" => "Mot de passe",
        "name" => "password",

        "minlength" => db::getParameter("passwordMinLength"),
        "maxlength" => db::getParameter("passwordMaxLength")
    ));

    $formLogin->setElement("input", array(
        "type" => "color",
        "placeholder" => "#fffff",
        "name" => "color",
    ));

    $formLogin->setElement("input", array(
        "type" => "submit",
        "value" => "Connexion",
        "name" => "submit",
        "class" => "btn btn-primary" // i add a class to the element
    ));

    //print_r($formLogin);
    print_r($formLogin->check());

    if(isset($_POST["submit"])){ // check if form is submit
        if(isset($_POST["username"]) && isset($_POST["password"])){ // check if the both input are submit
            if(strlen(trim($_POST["username"]))>=$parametersFromDB["usernameMinLength"] && strlen(trim($_POST["password"]))>=$parametersFromDB["passwordMinLength"]){ // we check the min length of the password and username
                $username = $_POST["username"];

                $userInfo = db::getUserInfo($username, array("id","username","password","role")); // i interrogates the database

                if(count($userInfo)==1){ // if i 1 user matching
                    if(password::match($userInfo[0]["password"],$_POST["password"])){ // if the passwords match
                        $_SESSION["username"] = $userInfo[0]["username"];
                        $_SESSION["userid"] = $userInfo[0]["id"];
                        $userInfo[0]["role"] = $userInfo[0]["role"];
                        header('Location: /');
                        exit();
                    }else{ // if password x username mismatch
                        $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                        mcv::addView("login"); 
                    }
                }else{ // if any or multiple users
                    $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                    mcv::addView("login");
                }
            }else{ // the min length (parameters from DB) of the password or username is false
                $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
                mcv::addView("login");
            }
        }else{ // password input or username input missing
            $msg_mismatch = "Identifiant ou mot de passe incorrect."; 
            mcv::addView("login");
        }
    }else{ // if form is not submit
        mcv::addView("login");
    }
?>