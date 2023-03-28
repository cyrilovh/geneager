<?php
    namespace class;

    $title = "Paramètres de sécurité";
    metaTitle::setTitle($title);

    $form = new \class\form(array(
        "action" => "",
        "method" => "post",
        "class" => "form",
    ));


    $form->setElement("input", array(
        "type" => "checkbox",
        "name" => "captcha",
        ($gng_paramList->get("captcha") == "1" ? "checked" : "off") => ($gng_paramList->get("captcha") == "1" ? "checked" : "true"),
        ),
        array(
            "before" => "<h2 class='mt10'>Général:</h2><p><label class='switch'>",
            "after" => "<span class='slider round'></span></label> Activer le captcha<p>"
        )
    );


    $form->setElement("input", array(
        "type" => "checkbox",
        "name" => "signup",
        ($gng_paramList->get("signup") == "1" ? "checked" : "off") => ($gng_paramList->get("signup") == "1" ? "checked" : "true"),
        ),
        array(
            "before" => "<p><label class='switch'>",
            "after" => "<span class='slider round'></span></label> Inscriptions ouvertes au public<p>"
        )
    );

    $form->setElement("input", array(
        "type" => "checkbox",
        "name" => "signupIndexFollow",
        ($gng_paramList->get("signupIndexFollow") == "1" ? "checked" : "off") => ($gng_paramList->get("signupIndexFollow") == "1" ? "checked" : "true"),
        ),
        array(
            "before" => "<p><label class='switch'>",
            "after" => "<span class='slider round'></span></label> Autoriser les moteurs de recherche à indexer la page d'inscription<p>"
        )
    );

    $form->setElement("input", array(
        "type" => "text",
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
            "type" => "text",
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
            "type" => "text",
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
            "type" => "text",
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
            db::updateParameter($data);
        }else{
            $errorList = $form->check(true);
        }
        
    }

    mcv::addView("userForm");

?>
