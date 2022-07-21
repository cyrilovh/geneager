<?php

    namespace class;
    /* TEST METAS */
    metaTitle::setTitle("Ajouter une photo");
    
    $include_footer = "none";


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
            "required" => "required"
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

    if($form->check()){
        if(isset($_POST["submit"])){
            $theFile = $_FILES["fichier"];
            $return = file::upload($theFile, array("picture"), "picture/");
    
            if(count($return["error"]) == 0){
                $successMsg = "Fichier a bien été envoyé !<br>".$return["file"]["newName"];
                $infoMsg = $return["file"]["messageList"];
                if(count($return["file"]["warningList"])>0){
                    $warningList = implode("<br>", $return["file"]["warningList"]);
                }
                // NEXT STEP: save the file name in the DB
            }else{
                $errorList = implode("<br>", $return["error"]);
            }
        }else{
            $errorList = $form->check(false);
        }
    }


 ?>