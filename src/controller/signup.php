<?php

    namespace class;

    $title = "Inscription";
    metaTitle::setTitle($title);

    $canRegister = false;
    
    if($gng_paramList->get("signup") || userInfo::getRole()=="admin"){
        $canRegister = true;
    }

    if($gng_paramList->get("signupIndexFollow")){
        metaTitle::setDescription("Page d'inscription au site.");
    }else{
        metaTitle::setRobot(array('noindex','nofollow'));
    }

    if(!$canRegister){
        $msgError = "Les inscriptions sont fermées.";
        mcv::addView('403');
    }else{
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
            "value"=>"", // i give the value attr
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
            "value"=>"", // i give the value attr
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
            "value"=>"", // i give the value attr
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
            "value"=>"", // i give the value attr
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
                ),
                array(
                    "before" => "<p>Rôle:</p>"
                )
            );
        }

        $form->setElement("input", array(
            "type" => "submit",
            "name" => "submit",
            "value" => "Inscrire",
            "class" => "btn btn-primary w100",
        ));
        mcv::addView("userForm");
    }

?>