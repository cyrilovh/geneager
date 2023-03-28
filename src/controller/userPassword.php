<?php
    namespace class;

    $title = "Changer mot de passe";

    metaTitle::setTitle($title);
    metaTitle::setDescription("Changer le mot de passe d'un compte utilisateur.");

    additionnalJsCss::set("form.js");

    $username = (userInfo::isAdmin() && isset($_GET["username"])) ? security::cleanStr($_GET["username"]) : userInfo::getUserName(); // i get the username (if admin
    $title .= " de ".$username;

    $form = new form(array(
        "method" => "post",
        "action" => "",
        "class" => "form",
    ));

    $form->setElement("input", array(
        "type" => "password",
        "name" => "oldPassword",
        "placeholder" => "Mot de passe",
        "minlength" => $gng_paramList->get("passwordMinLength"),
        "maxlength" => $gng_paramList->get("passwordMaxLength"),
        "required" => "required",
        "class" => "form-control w100",
    ),
    array(
        "before" => "<div class='alert alert-info'>Le mot de passe doit comporter entre ".$gng_paramList->get("passwordMinLength")." et ".$gng_paramList->get("passwordMaxLength")." caractères et au moins une lettre majuscule, un chiffre et un caractère spécial.</div><p>Mot de passe actuel:<p>",
    ));

    $form->setElement("input", array(
        "type" => "password",
        "name" => "newPassword",
        "placeholder" => "Nouveau mot de passe",
        "minlength" => $gng_paramList->get("passwordMinLength"),
        "maxlength" => $gng_paramList->get("passwordMaxLength"),
        "required" => "required",
        "class" => "form-control w100",
    ),
    array(
        "before" => "<hr><p>Nouveau mot de passe:<p>",
    ));

    $form->setElement("input", array(
        "type" => "password",
        "name" => "newPasswordConfirm",
        "placeholder" => "Retaper le nouveau mot de passe",
        "minlength" => $gng_paramList->get("passwordMinLength"),
        "maxlength" => $gng_paramList->get("passwordMaxLength"),
        "required" => "required",
        "class" => "form-control w100",
    ),
    array(
        "before" => "<p>Confirmez le nouveau mot de passe:<p>",
    ));

    $form->setElement("input", array(
        "type" => "submit",
        "name" => "submit",
        "value" => "Changer le mot de passe",
        "class" => "btn btn-primary w100",
    ));

    if(isset($_POST["submit"])){
        if($form->check()){
            $oldPassword = $_POST["oldPassword"];
            $newPassword = $_POST["newPassword"];
            $newPasswordConfirm = $_POST["newPasswordConfirm"];

            $userInfo = \model\userInfo::getByUsername($username, array("id", "password", "passwordAlgo", "username")); // i get the user info

            if($userInfo){
                if($newPassword == $newPasswordConfirm){ // if new passwords are the same
                    if(password::passwordAllowed($newPassword, $gng_paramList->get("passwordMinLength"), $gng_paramList->get("passwordMaxLength"))){ // i check if the password is strong enough
                        if(password::match($userInfo["password"], $oldPassword, $userInfo["passwordAlgo"])){ // i check if old password is true
                            $newPassword = password::hash($newPassword); // i hash the new password
                            $update = db::update(array("password" => $newPassword, "passwordAlgo" => DEFAULT_ALGO), "user", array("username" => $username)); // i update the password
                            if($update){
                                $msgSuccess = "Le mot de passe a été changé. <a href='".url::current()."'>Retour</a>";
                            }else{
                                $msgError = "Une erreur est survenue lors de la mise à jour du mot de passe. <a href='".url::current()."'>Réessayer</a>";
                            }
                        }else{
                            $msgError = "Le mot de passe actuel est incorrect. <a href='".url::current()."'>Réessayer</a>";
                        }
                    }else{
                       $msgError = "Le mot de passe n'est pas assez fort. <a href='".url::current()."'>Réessayez</a>";
                    }

                }else{
                    $msgError = "Les deux mots de passe ne correspondent pas. <a href='".url::current()."'>Réessayer</a>";
                }
            }else{
                session_destroy();
                die("Erreur critique: impossible de récupérer les informations de l'utilisateur.");
            }
        }else{
            $errorList = $form->check(true);
        }
    }

    mcv::addView("userForm");
    