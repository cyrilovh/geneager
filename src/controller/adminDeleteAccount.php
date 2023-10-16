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
                $recipientArray[$value["username"]] = $value["username"];
            }
        }

        if($user){
            if($user["role"] == "admin"){
                if(count(\model\userInfo::getAdminList()) == 1){
                    $msgError = "Vous ne pouvez pas supprimer le dernier compte administrateur.";
                }elseif($user["username"] == userInfo::getUsername()){
                    $msgError = "Vous ne pouvez pas supprimer votre propre compte administrateur.";
                }
                mcv::addView("noContent");
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
                        "after" => "<small>Utilisateur désigné ci-dessus héritera des travaux (photos, albums, fiches d'identités, archives, ...).</small>",
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

                if(isset($_POST["submit"])) {
                    if($form->check()){
                        // first we update author in all table (replace author by recipient)
                        $tableList = array("ancestor", "archive", "pictureFolder", "video");
                        $tableUpdated = array();

                        // i update all table with the new author in the tables 
                        foreach($tableList as $key => $value){
                            if(db::update(array("author" => $_POST["recipient"]), $value, array("author" => $user["username"]), false)){
                                $tableUpdated[] = $value;
                            }
                        }
                        
                        if(count($tableList) == count($tableUpdated)){
                            // then we delete the user
                            if(db::delete("user", array("id" => $user["id"]))){
                                $msgSuccess = "Le compte ".$user["username"]." a été supprimé.";
                            }else{
                                $msgError = "Une erreur est survenue lors de la suppression du compte.";
                            }
                        }else{
                            $msgError = "Une erreur est survenue lors de la mise à jour des données dans les tables suivantes: ".implode(", ",array_diff($tableList, $tableUpdated)).".<br>Le compte n'a pas été supprimé.";
                        }
                        // then we delete the user if no error
                    }else{
                        $errorList = $form->check(false);
                    }
                }

                mcv::addView("userForm");
            }
        }else{
            $msgError = "Aucun compte n'a été trouvé.";
            mcv::addView("noContent");
        }
    }else{
        $msgError = "ID invalide.";
        mcv::addView("noContent");
    }