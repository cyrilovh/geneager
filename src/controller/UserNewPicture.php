<?php

    namespace class;
    /* TEST METAS */
    metaTitle::setTitle("Ajouter une photo");
    metaTitle::setRobot(array("noindex", "nofollow"));
    
    $include_footer = "none";

    if(validator::isId()){ // i check if the id is valid and set

        $albumData = \model\album::getByID($_GET["id"]);

        if(userinfo::isAuthorOrAdmin($albumData["author"])){ // i check if the user is the owner or admin
            if($albumData){
                mcv::addView("userNewPicture");
    
                $form = new form(
                    array(
                        "action" => "",
                        "method" => "post",
                        "enctype" => "multipart/form-data"
                    )
                );
        
                $form->setElement("input",
                    array(
                        "type" => "file",
                        "name" => "fichier",
                        "class" => "form-control",
                        "required" => "required",
                        "accept" => implode(",", UPLOAD_FILETYPE_ALLOWED["picture"])
                    )
                );
        
        
                $form->setElement("input",
                    array(
                        "type" => "submit",
                        "name" => "submit",
                        "class" => "btn btn-primary",
                        "value" => "Envoyer la photo"
                    )
                );
        
                // if submit
                if($form->check()){
                    if(isset($_POST["submit"])){
                        $theFile = $_FILES["fichier"];
                        $return = file::upload($theFile, array("picture"), "picture/");
                
                        if(count($return["error"]) == 0){
        
                            $successMsg = "<b>Fichier a bien été envoyé !</b>";
                            if(count($return["file"]["messageList"])>0){

                                $successMsg .= "<br>".implode("<br>", $return["file"]["messageList"]);
                            }

                            if(count($return["file"]["warningList"])>0){
                                $warningList = implode("<br>", $return["file"]["warningList"]);
                            }
                            // NEXT STEP: save the file name in the DB
                            try{
                                \model\picture::insert(
                                    array(
                                        "filename" => $return["file"]["newName"],
                                        "folder" => $_GET["id"],
                                        "createDate" => date("Y-m-d H:i:s")
                                    )
                                );
                            }catch(\Exception $e){
                                $errorList = "Erreur lors de l'enregistrement de la photo dans la base de données";
                            }

                            $btnContinue = "<a href='/userEditPicture/".$_GET["id"]."' class='btn btn-primary'><i class='fa-solid fa-plus' title='Envoyer un nouveau fichier'></i> Ajouter une autre photo</a>";
                            $btnContinue .= " <a href='/userEditPicture/?filename=".$return["file"]["newName"]."' class='btn btn-success'><i class='fa-solid fa-pen' title='Editer'></i> Editer les informations de la photo</a>";
                        }else{
                            $errorList = implode("<br>", $return["error"]);
                        }
                    }else{
                        $errorList = $form->check(false);
                    }
                }
            }else{
                $msgError = "L'album n'existe pas ou plus.";
                mcv::addView("noContent");         
            }
        }else{
            $msgError = "Vous n'avez pas les droits pour ajouter une photo à cet album.";
            mcv::addView("403");
        }
        
    }else{
        $msgError = "ID de l'album invalide ou non fourni.";
        mcv::addView("noContent");
    }
 ?>