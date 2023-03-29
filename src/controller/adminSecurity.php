<?php
    namespace class;

    $title = "Paramètres de sécurité";
    metaTitle::setTitle($title);
    

    $form = new \class\form(array(
        "action" => "",
        "method" => "post",
        "class" => "form",
    ));


    $form->setElement("select", array(
        "name" => "captcha",
        "required" => "required",
        "option" => \enumList\yesNo::array(),
        "value" => $gng_paramList->get("captcha")),
        array(
            "before" => "<h2 class='mt10'>Général:</h2><p>",
            "after" => " Captcha</p>"
        )
    );


    $form->setElement("select", array(
        "name" => "signup",
        "required" => "required",
        "option" => \enumList\yesNo::array(),
        "value" => $gng_paramList->get("signup")),
        array(
            "before" => "<p class='mt10'>",
            "after" => " Inscriptions ouvertes au public</p>"
        )
    );

    $form->setElement("select", array(
        "name" => "emailConfirm",
        "required" => "required",
        "option" => \enumList\yesNo::array(),
        "value" => $gng_paramList->get("emailConfirm")),
        array(
            "before" => "<p class='mt10'>",
            "after" => " Validation obligatoire de l'adresse e-mail (inscription et mise à jour)</p>"
        )
    );
    
    $form->setElement("select", array(
        "name" => "signupIndexFollow",
        "required" => "required",
        "option" => \enumList\yesNo::array(),
        "value" => $gng_paramList->get("signupIndexFollow")),
        array(
            "before" => "<p class='mt10'>",
            "after" => " Autoriser les moteurs de recherche à indexer la page d'inscription</p>"
        )
    );

    $form->setElement("input", array(
        "type" => "number",
        "name" => "usernameMinLength",
        "value" => $gng_paramList->get("usernameMinLength"),
        "class" => "",
        "min" => 2,
        "max" => 6,
        ),
        array(
            "before" => "<hr><h2>Nom d'utilisateur:</h2><p>Longeur minimale (2-6):</p>",
            "after" => ""
        )
    );

    $form->setElement("input", array(
            "type" => "number",
            "name" => "usernameMaxLength",
            "value" => $gng_paramList->get("usernameMaxLength"),
            "class" => "",
            "min" => 12,
            "max" => 50,
        ),
        array(
            "before" => "<p>Longeur maximale (12-50):</p>",
            "after" => ""
        )
    );

    $form->setElement("input", array(
            "type" => "number",
            "name" => "passwordMinLength",
            "value" => $gng_paramList->get("passwordMinLength"),
            "class" => "",
            "min" => 7,
            "max" => 10,
        ),
        array(
            "before" => "<hr><h2>Mot de passe:</h2><p>Longeur minimale (7-10):</p>",
            "after" => ""
        )
    );

    $form->setElement("input", array(
            "type" => "number",
            "name" => "passwordMaxLength",
            "value" => $gng_paramList->get("passwordMaxLength"),
            "class" => "",
            "min" => 12,
            "max" => 50,
        ),
        array(
            "before" => "<p>Longeur maximale (12-50):</p>",
            "after" => ""
        )
    );

    $form->setElement("input", array(
        "type" => "submit",
        "name" => "submit",
        "value" => "Enregistrer",
        "class" => "btn btn-primary w100 mt10",
        )
    );

    if(isset($_POST["submit"])){
        if($form->check()){
            $data = $form->getData();
            if(db::updateParameter($data)){
                $msgSuccess = "<p>Les paramètres ont été mis à jour.</p><a href='".url::current()."' class='btn btn-primary mt10'>OK</a>";
            }else{
                $msgError = "Une erreur est survenue lors de l'enregistrement des paramètres.";
            }
        }else{
            $msgError = $form->check(true);
        }
        
    }

    mcv::addView("userForm");

?>
