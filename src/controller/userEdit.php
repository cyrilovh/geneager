<?php
    namespace class;

    metaTitle::setTitle("Editer mon profil");

    if(userInfo::isAdmin()){
        if(isset($_GET["username"])){
            $username = security::cleanStr($_GET["username"]);
            $title = "Editer le profil de ".$username;
        }else{
            $username = userInfo::getUsername();
            $title = "Editer mon profil";
        }
    }else{
        $username = userInfo::getUsername();
        $title = "Editer mon profil";
    }

    $userData = \model\userInfo::getByUsername($username);

    if($userData){
        $currentURL = url::current();

        if($userData){
            $userForm = new form(
                array(
                    "action" => $currentURL,
                    "method" => "post",
                    "class" => "form"
                )
            );

            if(userInfo::isAdmin() && $username != userInfo::getUsername()){ // if admin edit other user
                $userForm->setElement("select", array(
                    "value" => $userData["banned"],
                    "name" => "banned",
                    "class" => "form-control w100",
                    "required" => true,
                    "option" => array(
                        "0" => "Non",
                        "1" => "Oui"
                    )
                ),
                array(
                    "before" => "<p>Banni:</p>",
                ));
            }
            
            $userForm->setElement("input",
                array(
                    "type" => "text",
                    "name" => "identity",
                    "label" => "Adresse email",
                    "value" => $userData["identity"],
                    "class" => "form-control w100",
                ),
                array(
                    "before" => "<p>Nom, Prénom:</p>",
                )
            );
    
            $userForm->setElement("input",
                array(
                    "type" => "text",
                    "name" => "email",
                    "label" => "Adresse email",
                    "minlength" => "11",
                    "maxlength" => "200",
                    "value" => $userData["email"],
                    "class" => "form-control w100",
                    "required" => true
                ),
                array(
                    "before" => "<p>E-mail:</p>",
                )
            );
    
            $userForm->setElement("input",
                array(
                    "type" => "text",
                    "name" => "emailConfirm",
                    "label" => "Adresse email",
                    "minlength" => "11",
                    "maxlength" => "200",
                    "value" => $userData["email"],
                    "class" => "form-control w100",
                    "required" => true
                ),
                array(
                    "before" => "<p>E-mail (confirmation):</p>",
                )
            );
    
            $userForm->setElement("input",
                array(
                    "type" => "submit",
                    "name" => "submit",
                    "value" => "Enregistrer",
                    "class" => "btn btn-primary w100"
                )
            );
    
            if(isset($_POST["submit"])) {
                if($userForm->check()){
    
                    $outputData = array(); // data to update
    
                    if(security::cleanStr($_POST["email"]) == security::cleanStr($_POST["emailConfirm"])){
                        
                        $userDataByEmail = \model\userInfo::getByEmail($_POST["email"], array("id")); // check if email already exist
    
                        if($userDataByEmail){
                            if($userDataByEmail["id"] != $userData["id"]){
                                $errorMsg = "Cette adresse email est déjà utilisée.";
                            }
                        }else{
                            $outputData["email"] = security::cleanStr($_POST["email"]);
                        }
    
                    }else{
                        $errorMsg = "Les adresses email ne correspondent pas.";
    
                    }
    
                    if(isset($errorMsg)){
                        $errorMsg .= "<p><a href='".$currentURL."' class='btn btn-primary'>🢀 Retour au formulaire</a></p>"; 
                    }
    
                    $outputData["identity"] = security::cleanStr($_POST["identity"]);

                    if(isset($_POST["banned"])){
                        if(userInfo::isAdmin() && $username != userInfo::getUsername()){
                            $outputData["banned"] = security::cleanStr($_POST["banned"]);
                        }
                    }
    
                    $update = db::update($outputData, "user", array("id" => $userData["id"]));
    
                    if($update){
                        $successMsg = "<p>Votre profil a bien été mis à jour.</p>";
                        $successMsg .= "<p><a href='".$currentURL."' class='btn btn-success'>🢀 Retour au formulaire</a></p>";
                    }
                }else{
                    $errorList = $ancestorForm->check(false);
                }
            }
            
            mcv::addView("userEdit");
        }
    }else{
        mcv::addView("500");
    }
?>