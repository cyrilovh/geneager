<?php
    namespace class;

    use model\{userInfo,parameter};
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
        "minlength" => $gng_paramList->get("usernameMinLength"), // i add the attr minlength
        "maxlength" => $gng_paramList->get("usernameMaxLength"), // i add the attr maxlength
        "class" => "form-control"
        ),
        // add content after or before the element
        // array( 
        //     "before" => "before",
        //     "after" => "after"
        // )
    );

    $formLogin->setElement("input", array(
        "type" => "password",
        "placeholder" => "Mot de passe",
        "name" => "password",
        "minlength" => $gng_paramList->get("passwordMinLength"),
        "maxlength" => $gng_paramList->get("passwordMaxLength"),
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
        if($formLogin->check()){ // check if the both input are submit
    
            $username = $_POST["username"];

            $userInfo = userInfo::getByUsername($username, array("id","username","password","role")); // i interrogates the database

            if($userInfo){ // if i 1 user matching
                if(password::match($userInfo["password"],$_POST["password"])){ // if the passwords match
                    $_SESSION["username"] = $userInfo["username"];
                    $_SESSION["userid"] = $userInfo["id"];
                    $_SESSION["role"] = $userInfo["role"];
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
        }else{ // password input or username input missing
            $msg_mismatch = "Veuillez remplir correctement le formulaire."; 
            mcv::addView("login");
        }
    }else{ // if form is not submit
        mcv::addView("login");
    }
?>