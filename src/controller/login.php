<?php
    namespace class;

    use model\{userInfo,parameter};
    metaTitle::setTitle("Connexion"); // i set the title page + separator + website name
    metaTitle::setRobot(array("noindex","nofollow"));
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
        )
    );

    $formLogin->setElement("input", array(
        "type" => "password",
        "placeholder" => "Mot de passe",
        "name" => "password",
        "minlength" => $gng_paramList->get("passwordMinLength"),
        "maxlength" => $gng_paramList->get("passwordMaxLength"),
        "class" => "form-control"
    ));

    if($gng_paramList->get("captcha")){ // if captcha is enable
        $formLogin->setElement("input", array(
            "type" => "text",
            "placeholder" => "Captcha",
            "name" => "captcha",
            "required" => "required",
            "minlength" => 1,
            "maxlength" => 50,
            "class" => "form-control mt10"
        ),
        array(
            "before" => "<p class='txt-center'><img src='/captcha' alt='captcha' class='captcha' class='mt10'><a href='javascript:refreshCaptcha();' class='refreshCaptcha'><i class='fas fa-sync-alt'></i></a></p><p>Recopîez le code affiché:</p>",
        ));
    }

    $formLogin->setElement("input", array(
        "type" => "submit",
        "value" => "Connexion",
        "name" => "submit",
        "class" => "btn btn-primary form-control mt10" // i add a class to the element
    ));

    if(isset($_POST["submit"])){ // check if form is submit

        if($gng_paramList->get("captcha")){
            if(isset($_POST["captcha"])){
                if(!captcha::check($_POST['captcha'])){
                    $msg_mismatch = "Le captcha est incorrect.";
                    //die("le captcha est incorrect");
                }
            }else{
                $msg_mismatch = "Veuillez remplir correctement le formulaire.";
                //die("Veuillez remplir correctement le formulaire.");
            }
        }

        //die("STOP.");

        if($formLogin->check() && !(isset($msg_mismatch))){ // check if the both input are submit
    
            $username = security::cleanStr($_POST["username"]);

            $userInfo = userInfo::getByUsername($username, array("id","username","password","role","passwordAlgo")); // i interrogates the database

            if($userInfo){ // if i 1 user matching
                if(password::match($userInfo["password"], $_POST["password"], $userInfo["passwordAlgo"])){ // if the passwords match
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
            $msg_mismatch = (!isset($msg_mismatch)) ? "Veuillez remplir correctement le formulaire." : $msg_mismatch; 
            mcv::addView("login");
        }
    }else{ // if form is not submit
        if (isset($_GET["logout"]) && url::isSameOrigin()){ // if logout is set
            $msg_success = "<i class='fa-solid fa-circle-check'></i> Vous avez été déconnecté."; 
        }
        mcv::addView("login");
    }
?>
