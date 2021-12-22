<?php

namespace class\gng;

    metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    $meta_robots = "noindex,nofollow";
    $include_header = "none";
    $include_navbar = "none";
    $include_footer = "none";
    additionnalJsCss::set("login.css");
    additionnalJsCss::set("login.js");

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
        "minlength" => \model\gng\parameter::get("usernameMinLength"), // i add the attr minlength
        "maxlength" => \model\gng\parameter::get("usernameMaxLength"), // i add the attr maxlength
        "data-gngLabel" => "Utilisateur",
        "class" => "form-control"
    ));

    $formLogin->setElement("input", array(
        "type" => "password",
        "placeholder" => "Mot de passe",
        "name" => "password",
        "minlength" => \model\gng\parameter::get("passwordMinLength"),
        "maxlength" => \model\gng\parameter::get("passwordMaxLength"),
        "data-gngLabel" => "Mot de passe",
        "class" => "form-control"
    ));

    $formLogin->setElement("input", array(
        "type" => "submit",
        "value" => "Connexion",
        "name" => "submit",
        "class" => "btn btn-primary form-control" // i add a class to the element
    ));

    //print_r($formLogin);
    //print_r($formLogin->check());

    if(isset($_POST["submit"])){ // check if form is submit
        if(isset($_POST["username"]) && isset($_POST["password"])){ // check if the both input are submit
            if(strlen(trim($_POST["username"]))>=$parametersFromDB["usernameMinLength"] && strlen(trim($_POST["password"]))>=$parametersFromDB["passwordMinLength"]){ // we check the min length of the password and username
                $username = $_POST["username"];

                $userInfo = \model\gng\userInfo::get($username, array("id","username","password","role")); // i interrogates the database

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