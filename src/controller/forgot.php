<?php

    namespace class;


    captcha::$captchaName = "captchaForgetPassword";

    $title = "Mot de passe oublié";
    metaTitle::setTitle($title);
    metaTitle::setRobot(array("noindex", "nofollow"));

    if(!userInfo::isConnected()){

        $form = new form(array(
            "action" => "",
            "method" => "post",
            "class" => "form",
        ));

        $form->setElement("input", array(
            "name" => "email",
            "type" => "email",
            "required" => "required",
            "placeholder" => "Email",
            "minlength" => 6,
            "maxlength" => 200,
            "class" => "w100",
            "value" => (isset($_POST["email"])) ? $_POST["email"] : ""),
            array(
                "before" => "E-mail:"
            )
        );

        if($gng_paramList->get(captcha::$captchaName)){ // if captcha is enable
            $form->setElement("input", array(
                "type" => "text",
                "placeholder" => "Captcha",
                "name" => "captcha",
                "required" => "required",
                "minlength" => 1,
                "maxlength" => 50,
                "class" => "form-control mt10 w100"
            ),
            array(
                "before" => "<hr><p class='mt10'><img src='/captcha?name=".captcha::$captchaName."' alt='captcha' class='captcha' class='mt10' /><p>Recopîez le code affiché:</p>",
                "after" => "<hr>"
            ));
        }

        $form->setElement("input", array(
            "type" => "submit",
            "name" => "submit",
            "value" => "Valider",
            "class" => "btn btn-primary w100 mt10",
        ));

        if(isset($_POST["submit"])){

            if($gng_paramList->get(captcha::$captchaName)){
                if(isset($_POST["captcha"])){
                    if(!captcha::check($_POST['captcha'])){
                        $msgError = "Le captcha est incorrect.";
                    }
                }else{
                    $msgError = "Veuillez remplir correctement le formulaire.";
                }
            }

            if($form->check() && !isset($msgError)){

            }else{
                $errorList = $form->check(true);
            }
        }

        mcv::addView("userForm");
    }else{
        header("Location: /userEdit");
        exit();
    }