<?php
    namespace class;

    use model\album;
    $title = "Supprimer un album";
    $meta_title = $title." ".$meta_separator.$meta_title;


    if(isset($_GET['id'])){
        $id = security::cleanStr($_GET['id']);
        if(is_numeric($id)){

            $album = album::getByID($id);

            if($album){

                if(userInfo::isAuthorOrAdmin($album["author"])){
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
                            "before" => "<p>",
                            "after" => " <span class='bold red'>Supprimer l&apos;album &laquo; ".$album["title"]." &raquo; définitivement.</span></p><br>",
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
                            if(\model\album::delete($_GET['id'])){
                                $msgSuccess = "L'album a bien été supprimé.";
                            }else{
                                $errorList = array("Une erreur est survenue lors de la suppression de l'album.<br>Assurez-vous que l'album soit vide avant de le supprimer.");
                            }
                        }else{
                            $errorList =$form->check(false);
                        }
                    }
                
                    mcv::addView("userForm");
                }else{
                    $msgError = "Vous n'avez pas les droits pour supprimer cet album.";
                    mcv::addView("403");
                }
                
            }else{
                $msgError = "L'album n'existe pas.";
                mcv::addView("noContent"); // if the album doesn't exist, i display a message
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