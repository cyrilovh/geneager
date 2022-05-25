<?php
    namespace class;

    use model\{userInfo,parameter};
    metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    $meta_robots = "noindex,nofollow";
    $include_header = "none"; // bug quand none: page login
    $include_navbar = "none"; // bug quand none: page login
    $include_footer = "none"; // bug quand none: page login
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
        if(isset($_POST["username"]) && isset($_POST["password"])){ // check if the both input are submit
            if(strlen(trim($_POST["username"]))>=$gng_paramList->get("usernameMinLength") && strlen(trim($_POST["password"]))>=$gng_paramList->get("passwordMinLength")){ // we check the min length of the password and username
                $username = $_POST["username"];

                $userInfo = userInfo::get($username, array("id","username","password","role")); // i interrogates the database

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