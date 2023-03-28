<?php

    namespace class;

    $title = "Inscription";
    metaTitle::setTitle($title);

    $canRegister = false;
    $btnTxt = "S'inscrire";
    
    if($gng_paramList->get("signup") || userInfo::getRole()=="admin"){
        $canRegister = true;
        $btnTxt = "Ajouter un utilisateur";
    }

    if(userInfo::isConnected() && userInfo::getRole() != "admin"){
        $canRegister = false;
    }


    if($gng_paramList->get("signupIndexFollow")){
        metaTitle::setDescription("Page d'inscription au site.");
    }else{
        metaTitle::setRobot(array('noindex','nofollow'));
    }

    if(!$canRegister){

        $msgError = (userInfo::isConnected()) ? "Inscription impossible" : "Les inscriptions sont fermées.";
        mcv::addView('403');
    }else{
        additionnalJsCss::set("form.js");

        $form = new form(array( // i declare my new object
            "method" => "post", // i give the method attr
            "action" => "", // i give action attr
            "class"=>"", // i give className ou className list (not required)
        ));

        $form->setElement("input",array( // i declare my new input
            "type"=>"text", // i give the type attr
            "name"=>"username", // i give the name attr
            "class"=>"w100", // i give className ou className list (not required)
            "placeholder"=> $gng_paramList->get("usernameMinLength")." à ".$gng_paramList->get("usernameMaxLength")." caractères alphanumériques sans accent", // i give the placeholder attr
            "minlength"=>$gng_paramList->get("usernameMinLength"), // i give the minlength attr
            "maxlength"=>$gng_paramList->get("usernameMaxLength"), // i give the minlength attr
            "required"=>"required", // i give the required attr
            "value"=>(isset($_POST["username"]) ? security::cleanStr($_POST["username"]) : ""), // i give the value if submitted but error
            "autocomplete"=>"off", // i give the autocomplete attr
            "pattern"=>"[a-zA-Z0-9]{". $gng_paramList->get("usernameMinLength") .",". $gng_paramList->get("usernameMaxLength") ."}", // i give the pattern attr
            ),
            array(
                "before" => "<p>Utilisateur:</p>"
            )
        );

        $form->setElement("input",array( // i declare my new input
            "type"=>"email", // i give the type attr
            "name"=>"email", // i give the name attr
            "class"=>"w100", // i give className ou className list (not required)
            "placeholder"=>"E-mail (11 à 200 caractères)", // i give the placeholder attr
            "minlength"=>"11", // i give the minlength attr
            "maxlength"=>"200", // i give the minlength attr
            "required"=>"required", // i give the required attr
            "value"=>(isset($_POST["email"]) ? security::cleanStr($_POST["email"]) : ""), // i give the value if submitted but error
            ),
            array(
                "before" => "<p>Adresse électronique:</p>"
            )
        );

        $form->setElement("input",array( // i declare my new input
            "type"=>"email", // i give the type attr
            "name"=>"emailConfirm", // i give the name attr
            "class"=>"w100", // i give className ou className list (not required)
            "placeholder"=>"E-mail (11 à 200 caractères)", // i give the placeholder attr
            "minlength"=>"11", // i give the minlength attr
            "maxlength"=>"200", // i give the minlength attr
            "required"=>"required", // i give the required attr
            "value"=>(isset($_POST["emailConfirm"]) ? security::cleanStr($_POST["emailConfirm"]) : ""), // i give the value if submitted but error
            "autocomplete"=>"off", // i give the autocomplete attr
            "onpaste" => "return false", // i give the onpaste attr
            ),
            array(
                "before" => "<p>Adresse électronique:</p>"
            )
        );

        $form->setElement("input",array( // i declare my new input
            "type"=>"password", // i give the type attr
            "name"=>"password", // i give the name attr
            "class"=>"w100", // i give className ou className list (not required)
            "placeholder"=>"Mot de passe (8 à 200 caractères)", // i give the placeholder attr
            "minlength"=>$gng_paramList->get("passwordMinLength"), // i give the minlength attr
            "maxlength"=>$gng_paramList->get("passwordMaxLength"), // i give the minlength attr
            "required"=>"required", // i give the required attr
            "value"=>(isset($_POST["password"]) ? security::cleanStr($_POST["password"]) : ""), // i give the value if submitted but error
            "autocomplete"=>"off", // i give the autocomplete attr
            ),
            array(
                "before" => "<p>Mot de passe:</p>"
            )
        );

        $form->setElement("input",array( // i declare my new input
            "type"=>"password", // i give the type attr
            "name"=>"passwordConfirm", // i give the name attr
            "class"=>"w100", // i give className ou className list (not required)
            "placeholder"=>"Retapez le même mot de passe", // i give the placeholder attr
            "minlength"=>$gng_paramList->get("passwordMinLength"), // i give the minlength attr
            "maxlength"=>$gng_paramList->get("passwordMaxLength"), // i give the minlength attr
            "required"=>"required", // i give the required attr
            "autocomplete"=>"off", // i give the autocomplete attr
            "onpaste" => "return false", // i give the onpaste attr
            ),
            array(
                "before" => "<p>Confirmation du mot de passe:</p>"
            )
        );

        if(userInfo::isAdmin()){
            $form->setElement("select",array( // i declare my new input
                "type"=>"text", // i give the type attr
                "name"=>"role", // i give the name attr
                "class"=>"w100", // i give className ou className list (not required)
                "placeholder"=>"Rôle", // i give the placeholder attr
                "minlength"=>"1", // i give the minlength attr
                "maxlength"=>"10", // i give the minlength attr
                "required"=>"required", // i give the required attr
                "option"=> \class\userInfo::getRoleListArr(), // i give the value attr
                "value"=>(isset($_POST["role"]) ? security::cleanStr($_POST["role"]) : "user"), // i give the value if submitted but error
                ),
                array(
                    "before" => "<p>Rôle:</p>"
                )
            );
        }

        $form->setElement("input", array(
            "type" => "submit",
            "name" => "submit",
            "value" => $btnTxt,
            "class" => "btn btn-primary w100",
        ));

        if(isset($_POST["submit"])){
            if($form->check()){
                $username = format::normalize(security::cleanStr($_POST["username"]));
                $email = format::normalize(security::cleanStr($_POST["email"]));
                $password = password::hash($_POST["password"]);
                if(userInfo::isAdmin()){
                    $role = (isset($_POST["role"]) ? security::cleanStr($_POST["role"]) : "user");
                }else{
                    $role = "user";
                }
                
                

                $errorList = array();
                if(format::normalize($_POST["email"]) != format::normalize($_POST["emailConfirm"])){
                    $errorList[] = "Les adresses électroniques ne correspondent pas.";
                }
                if(format::normalize($_POST["password"]) != format::normalize($_POST["passwordConfirm"])){
                    $errorList[] = "Les mots de passe ne correspondent pas.";
                }
                if(\model\userInfo::getByEmail($email, array("email"))){
                    $errorList[] = "Cette adresse électronique est déjà utilisée.";
                }
                if(\model\userInfo::getByUsername($username, array("username"))){
                    $errorList[] = "Ce nom d'utilisateur est déjà utilisé.";
                }
                
                if(count($errorList) == 0){

                    $data = array(
                        "username" => $username,
                        "identity" => $username,
                        "email" => $email,
                        "password" => $password,
                        "role" => $role,
                        "signupDate" => date("Y-m-d H:i:s"),
                        "banned" => "0",
                        "passwordAlgo" => DEFAULT_ALGO,
                    );
                    if(db::insert($data, "user")){
                        $msgSuccess = "L'utilisateur ".$username." a bien été inscrit.";
                    }else{
                        $msgError = "Une erreur est survenue de l'ajout de l'utilisateur.";
                    }
                }
            }else{
                $msgError = $form->check(true);
            }
        }

        mcv::addView("signup");
    }

?>