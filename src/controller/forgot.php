<?php

    namespace class;


    captcha::$captchaName = "captchaForgetPassword";

    $title = "Mot de passe oublié";
    metaTitle::setTitle($title);
    metaTitle::setRobot(array("noindex", "nofollow"));

    if(!userInfo::isConnected()){

        $messageSuccess = "Un e-mail avec un lien vous a été envoyé à l'adresse e-mail indiquée si elle est associé à un compte.";

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
                $user = \model\userInfo::getByEmail($_POST["email"], array("username", "email"));
                    if($user){ // If user exist
                        $user["token"] = random::alphaNum(20, 30).",".time(); // Generate a random token + timestamp
                        $template = templateEmail::autoReplace("forgetPassword", $user);

                        if(db::update(array("tokenForgetPassword" => $user["token"]), "user", array("email" => $user["email"]), false)){
                            if(email::send("Mot de passe oublié", $user["email"], $user["username"], $template, "Veuillez activer la prise en charge des e-mails HTML pour voir le contenu de ce message.")){
                                $msgSuccess = $messageSuccess;
                            }else{
                                $msgError = "Une erreur est survenue lors de l'étape de l'envoi de l'e-mail. Veuillez réessayer.";
                            }
                        }else{
                            $msgError = "Une erreur est survenue lors de l'étape de la génération du jeton. Veuillez réessayer.";
                        }
                    }else{
                        $msgSuccess = $messageSuccess;
                    }

            }else{
                $errorList = $form->check(true);
            }
        }

        mcv::addView("userForm");
    }else{
        header("Location: /userEdit");
        exit();
    }