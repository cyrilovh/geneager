<?php
    namespace class;

    $title = "Confirmation de l'adresse email";
    metaTitle::setTitle($title);
    metaTitle::setRobot(array("noindex", "nofollow"));

    if(isset($_GET["token"]) && isset($_GET["email"])){
        $token = security::cleanStr($_GET["token"]);
        $email = security::cleanStr($_GET["email"]);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $userInfo = \model\userInfo::getByEmail($email);
            if($userInfo){
                if($userInfo["tokenEmailVerified"] == $token){
                    $update = db::update(array("tokenEmailVerified" => NULL), "user", array("email" => $email));
                    if($update){
                        $successMsg = "Votre adresse email a été validée: vous pouvez désormais vous <a href='/login'>connecter</a>.";
                    }else{
                        $errorMsg = "Erreur interne: Impossible de confirmer votre adresse email. Si le problème persiste, veuillez contacter l'administrateur du site.";
                    }
                }else{
                    $errorMsg = "Lien invalide.";
                }
            }else{
                $errorMsg = "Lien invalide.";
            }
        }else{
            $errorMsg = "Lien invalide.";
        }
    }else{
        $errorMsg = "Lien invalide.";
    }

    mcv::addView("signupConfirm");
?>