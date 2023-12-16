<?php
    namespace class;
    $title = "Supprimer la photo d'un ancêtre";
    metaTitle::setTitle($title);


    if(isset($_GET['id'])){
        $id = security::cleanStr($_GET['id']);
        if(is_numeric($id)){

            $ancestor = \model\ancestor::get($id);

            if($ancestor){
                if(!validator::isNullOrEmpty($ancestor["photo"])){
                    if(userInfo::isAuthorOrAdmin($ancestor["author"])){
                        $form = new form(array( // i declare my new object
                            "method" => "post", // i give the method attr
                            "action" => "", // i give action attr
                            "class"=>"", // i give className ou className list (not required)
                        ));
                    
                        $form->setElement("input", array(
                            "type" => "checkbox", // i give the type of input
                            "name" => "confirm", // i give a className
                            "required" => "required", // i add the attr required
                            "class" => "form-control" // i add a class to the element
                            ),
                            // add content after or before the element
                            array(
                                "before" => "<p style='display:flex;'><img src='/picture/ancestor/".$ancestor["photo"]."' ></p><p>",
                                "after" => " <span class='bold red'>Supprimer la photo ci-dessus de manière définitive.</span></p><br>",
                            )
                        );
                    
                        $form->setElement("input", array(
                            "type" => "submit",
                            "value" => "Supprimer",
                            "name" => "submit",
                            "class" => "btn btn-danger form-control" // i add a class to the element
                        ));
                    
                        if(isset($_POST['submit'])){
                            if($form->check()){
                                $file = UPLOAD_DIR_FULLPATH."picture/ancestor/".$ancestor["photo"];
                                if(file_exists($file)){
                                    if(unlink($file)){
                                        $sql = db::update(array("photo" => ""), "ancestor", array("id" => $ancestor["id"]), true);
                                        if($sql){
                                            $msgSuccess = "<p>La photo a bien été supprimée.</p><p><a href='/ancestor/".$ancestor["id"]."' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la fiche de l'ancêtre</a></p>";
                                        }else{
                                            $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier à été supprimé mais la base de données n'a pas pu être mise à jour.");
                                        }
                                    }else{
                                        $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier n'a pas pu être supprimé.");
                                    }
                                }else{
                                    $sql = db::update(array("photo" => ""), "ancestor", array("id" => $ancestor["id"]), true); // if the file doesn't exist, i delete the link in the database
                                    if($sql){
                                        $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier est introuvable mais la base de données a été mise à jour.");
                                    }else{
                                        $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier est introuvable et la base de données n'a pas pu être mise à jour.");
                                    }
                                    
                                }
                            }else{
                                $errorList = $form->check(false);
                            }
                        }
                    
                        mcv::addView("userForm");
                    }else{
                        $msgError = "Vous n'avez pas les droits pour supprimer cet photo.<br><a href='/ancestor/".$ancestor["id"]."' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la fiche de l'ancêtre</a>";
                        mcv::addView("403");
                    }
                }else{
                    $msgError = "Cette ancêtre n'a pas de photo.<br><a href='/ancestor/".$ancestor["id"]."' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la fiche de l'ancêtre</a>";
                    mcv::addView("noContent"); // if the ancestor picture doesn't exist, i display a message                   
                }   
            }else{
                $msgError = "L'ancêtre n'existe pas.<br><a href='/ancestorList' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la liste des ancêtres</a>";
                mcv::addView("noContent"); // if the ancestor doesn't exist, i display a message
            }
        }else{
            $msgError = "ID invalide.";
            mcv::addView("noContent"); // if $_GET["id"] is wrong (not a number)
        }
    }else{
        $msgError = "ID manquant.";
        mcv::addView("noContent"); // if $_GET["id"] is not set, i display a message
    }

?>