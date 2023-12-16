<?php
    namespace class;
    $title = "Supprimer un ancêtre";
    metaTitle::setTitle($title);


    if(isset($_GET['id'])){
        $id = security::cleanStr($_GET['id']);
        if(is_numeric($id)){

            $ancestor = \model\ancestor::get($id);

            if($ancestor){
                if(userInfo::isAuthorOrAdmin($ancestor["author"])){
                    $form = new form(array( // i declare my new object
                        "method" => "post", // i give the method attr
                        "action" => "", // i give action attr
                        "class"=>"", // i give className ou className list (not required)
                    ));
                
                    $photo = (validator::isNullOrEmpty($ancestor["photo"])) ? DEFAULTPICTUREANCESTOR : "/picture/ancestor/".$ancestor["photo"];
                    $form->setElement("input", array(
                        "type" => "checkbox", // i give the type of input
                        "name" => "confirm", // i give a className
                        "required" => "required", // i add the attr required
                        "class" => "form-control" // i add a class to the element
                        ),
                        // add content after or before the element
                        array(
                            "before" => "<p style='display:flex;'><img src='".$photo."' ></p><p>",
                            "after" => " <span class='bold red'>Oui, supprimer la fiche d'identité n&deg;".$id." ( ".$ancestor["firstNameList"]." ".$ancestor["lastNameList"]." ".$ancestor["birthNameList"]." ".$ancestor["marriedNameList"]." )</span></p><br>",
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
                            $delete = db::delete("ancestor", array("id"=>$id));

                            if($delete){
                                $msgSuccess = "L'ancêtre a bien été supprimé.<br><a href='/ancestorList' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la liste des ancêtres</a>";
                            }else{
                                $msgError = "Une erreur est survenue lors de la suppression de l'ancêtre.<br><a href='/ancestor/".$ancestor["id"]."' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la fiche de l'ancêtre</a>";
                            }
                        }else{
                            $errorList = $form->check(false);
                        }
                    }
                
                    mcv::addView("userForm");
                }else{
                    $msgError = "Vous n'avez pas les droits pour supprimer cet fiche d'identité.<br><a href='/ancestor/".$ancestor["id"]."' class='btn btn-success'><span class='far fa-id-card'></span> Retour à la fiche de l'ancêtre</a>";
                    mcv::addView("403");
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