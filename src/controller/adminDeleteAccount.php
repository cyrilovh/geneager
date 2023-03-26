<?php
    namespace class;

    $title = "Supprimer un compte";
    metaTitle::setTitle($title);
    metaTitle::setDescription("Supprimer un compte utilisateur.");

    if(validator::isId()){
        $user = \model\userInfo::getById($_GET["id"], array("id", "username", "role"));

        $recipientList = \model\userInfo::getUsernameList(); // get all username
        $recipientArray = array(""=>"");
        foreach($recipientList as $key => $value){ // create an array with all username except the user to delete
            if($value["id"] != $user["id"]){
                $recipientArray[$value["id"]] = $value["username"];
            }
        }

        if($user){
            if($user["role"] == "admin"){
                mcv::addView("noContent");
                if(count(\model\userInfo::getAdminList()) == 1){
                    $msgError = "Vous ne pouvez pas supprimer le dernier compte administrateur.";
                }elseif($user["username"] == userInfo::getUsername()){
                    $msgError = "Vous ne pouvez pas supprimer votre propre compte administrateur.";
                }
            }

            if(!isset($msgError)){
                $form = new form(array(
                    "method" => "post",
                    "action" => "",
                    "class" => "form",
                ));

                $form->setElement("select", array(
                    "name" => "recipient",
                    "required" => "required",
                    "class" => "form-control w100",
                    "option" => $recipientArray),
                    array(
                        "before" => "<p class='bold'>Bénéficaire des données:</p>",
                        "after" => "<small>Utilisateur qui héritera des travaux (photos, albums, fiches d'identités, archives, ...).</small>",
                    )
                );

                $form->setElement("input", array(
                    "type" => "checkbox", // i give the type of input
                    "name" => "confirm", // i give a className
                    "required" => "required", // i add the attr required
                    "class" => "form-control" // i add a class to the element
                    ),
                    // add content after or before the element
                    array(
                        "before" => "<p class='mt10'>",
                        "after" => " <span class='bold red'>Supprimer le compte ".$user["username"]." &raquo; définitivement.</span></p><br>",
                    )
                );

                $form->setElement("input", array(
                    "type" => "submit",
                    "name" => "submit",
                    "value" => "Supprimer",
                    "class" => "btn btn-danger w100",
                    ),
                );

                mcv::addView("userDeleteForm");
            }
        }else{
            $msgError = "Aucun compte n'a été trouvé.";
            mcv::addView("noContent");
        }
    }else{
        $msgError = "ID invalide.";
        mcv::addView("noContent");
    }