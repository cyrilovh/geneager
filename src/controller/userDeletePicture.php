<?php
    namespace class;
    $title = "Supprimer une photo de famille";
    $meta_title = $title." ".$meta_separator.$meta_title;


    if(isset($_GET['id'])){
        $id = security::cleanStr($_GET['id']);
        if(is_numeric($id)){

            $photo = \model\picture::getPictureAndAlbumByID($id);

            if($photo){
                if(userInfo::isAuthorOrAdmin($photo["authorAlbum"])){
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
                            "before" => "<p style='display:flex;'><img src='/picture/family/".$photo["filename"]."' ></p><p>",
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
                            $file = UPLOAD_DIR_FULLPATH."picture/family/".$photo["filename"];
                            if(file_exists($file)){
                                if(unlink($file)){
                                    $sql = db::delete("picture", array("id" => $id));
                                    if($sql){
                                        $msgSuccess = "<p>La photo a bien été supprimée.</p></p>";
                                    }else{
                                        $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier à été supprimé mais la base de données n'a pas pu être mise à jour.");
                                    }
                                }else{
                                    $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier n'a pas pu être supprimé.");
                                }
                            }else{
                                $sql = db::delete("picture", array("id" => $id));
                                if($sql){
                                    $errorList = array("Le fichier n'existe pas mais la base de données a été mise à jour.");
                                }else{
                                    $errorList = array("Une erreur est survenue lors de la suppression de la photo: le fichier est introuvable et la base de données n'a pas pu être mise à jour.");
                                }
                            }
                        }else{
                            $errorList = $form->check(false);
                        }
                    }
                
                    mcv::addView("userDeleteForm");
                }else{
                    $msgError = "Vous n'avez pas les droits pour supprimer cet photo.";
                    mcv::addView("403");
                }
            }else{
                $msgError = "La photo n'existe pas dans la base de données.";
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