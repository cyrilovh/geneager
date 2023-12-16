<?php
    namespace class;

    // default values (new album)
    $update = false;
    $title = "Nouvel album photos";
    $btnSave = "Ajouter";

    // if i edit an album
    if(isset($_GET["id"]) && !validator::isNullOrEmpty($_GET["id"])) {
        if(is_numeric($_GET["id"])){ // i check if id is an integer
            $id = $_GET["id"];
            $album = \model\album::getByID($id);

            if($album){
                $update = true;
                $title = "Modifier l&apos;album photos";
                $btnSave = "Modifier";
            }
        }
    }

    metaTitle::setTitle($title.$meta_separator.$meta_title);
    metaTitle::setRobot(array("noindex, nofollow"));

    $formNewAlbum = new form(array( // i declare my new object
        "method" => "post", // i give the method attr
        "action" => "", // i give action attr
        "class"=>"", // i give className ou className list (not required)
    ));

    $formNewAlbum->setElement("input", array(
        "type" => "text", // i give the type of input
        "placeholder" => "Champs requis (2 à 30 caractères)", // i set a placeholder
        "name" => "title", // i give a className
        "required" => "required", // i add the attr required
        "minlength" => 2,  // i add the attr minlength
        "maxlength" => 30, // i add the attr maxlength
        "value" => ($update) ? $album["title"] : "", // i add a value
        "class" => "form-control w100"),
        // add content after or before the element
        array(
            "before" => "<p class='bold'>Titre de l&apos;album:</p>",
        )
    );

    $formNewAlbum->setElement("textarea", array(
        "placeholder" => "Facultatif (3 à 300 caractères)", // i set a placeholder
        "name" => "descript", // i give a className
        "minlength" => 3,  // i add the attr minlength
        "maxlength" => 300, // i add the attr maxlength
        "value" => ($update) ? $album["descript"] : "", // i add a value
        "class" => "form-control w100"
        ),
        // add content after or before the element
        array(
            "before" => "<p class='bold'>Description de l'album:</p>",
        )
    );

    $formNewAlbum->setElement("select", array(
        "name" => "public", // i give a className
        "required" => "required", // i add the attr required
        "value" => ($update) ? $album["public"]: "", // i add a value
        "class" => "form-control w100 capitale",
        "option" => \enumList\visibility::array()),
        // add content after or before the element
        array(
            "after" => "<p class='txt-description'>Privé: accès limité aux utilisateurs connectés</p>",
        )
    );

    $formNewAlbum->setElement("input", array(
        "type" => "submit",
        "value" => $btnSave,
        "name" => "submit",
        "class" => "btn btn-success form-control" // i add a class to the element
    ));

    /* SUBMIT FORM */
    if(isset($_POST["submit"])){
        if($formNewAlbum->check()){ // i check if there is any error in the form submit
            $albumTitle = $_POST["title"];
            $albumDescript = $_POST["descript"];

            if(!$update){
                $sql = \model\album::set($albumTitle, $albumDescript,  $_POST["public"]);

                if($sql){
                    $successMessage = "L&apos;album a bien été créé.";
                }else{
                    $errorMessage = "L&apos;album n&apos;a pas pu été créé.";
                }
            }else{
                $data = $formNewAlbum->getData();
                $sql = db::update($data, "picturefolder", array("id" => $id));

                if($sql){
                    $currentURL = \class\url::current();
                    $successMessage = "<p class='mt10 bold uppercase'>Les données ont été mises à jour.<p>";
                    $successMessage .= "<p><a class='btn btn-success mt10' href='$currentURL'>&#129152; Retour au formulaire.</a></p>";
                }else{
                    $errorMessage = "L&apos;album n&apos;a pas pu été modifié.";
                }
            }
        }else{
            $errorList = $formNewAlbum->check(false);
        }
    }

    mcv::addView("userEditAlbum");
?>