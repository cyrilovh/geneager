<?php
    namespace class;
    $meta_title = "Albums photos ".$meta_separator.$meta_title;

    $formNewAlbum = new form(array( // i declare my new object
        "method" => "post", // i give the method attr
        "action" => "", // i give action attr
        "class"=>"", // i give className ou className list (not required)
    ));

    $formNewAlbum->setElement("input", array(
        "type" => "text", // i give the type of input
        "placeholder" => "Nom de l&apos;album", // i set a placeholder
        "name" => "albumName", // i give a className
        "required" => "required", // i add the attr required
        "minlength" => 2,  // i add the attr minlength
        "maxlength" => 30, // i add the attr maxlength
        "class" => "form-control w100"),
        // add content after or before the element
        array(
            "before" => "<p class='bold'>Titre de l&apos;album:</p>",
        )
    );

    $formNewAlbum->setElement("textarea", array(
        "placeholder" => "Description de l&apos;album", // i set a placeholder
        "name" => "albumDescript", // i give a className
        "required" => "required", // i add the attr required
        "minlength" => 0,  // i add the attr minlength
        "maxlength" => 300, // i add the attr maxlength
        "class" => "form-control w100"
        ),
        // add content after or before the element
        array(
            "before" => "<p class='bold'>Description de l'album:</p>",
        )
    );

    $formNewAlbum->setElement("select", array(
        "name" => "albumRightAccess", // i give a className
        "required" => "required", // i add the attr required
        "class" => "form-control w100 capitale",
        "option" => \enumList\visibility::array()),
        // add content after or before the element
        array(
            "after" => "<p class='txt-description'>Privé: accès limité aux utilisateurs connectés</p>",
        )
    );

    $formNewAlbum->setElement("input", array(
        "type" => "submit",
        "value" => "Ajouter",
        "name" => "submit",
        "class" => "btn btn-success form-control" // i add a class to the element
    ));

    /* SUBMIT FORM */
    if(isset($_POST["submit"])){
        if($formNewAlbum->check()){ // i check if there is any error in the form submit
            $albumTitle = $_POST["albumName"];
            $albumDescript = $_POST["albumDescript"];

            $sql = \model\album::set($albumTitle, $albumDescript,  $_POST["albumRightAccess"]);

            if($sql){
                $successMessage = "L&apos;album a bien été créé.";
            }else{
                $errorMessage = "L&apos;album n&apos;a pas pu été créé.";
            }
        }else{
            $errorList = implode("<br>", $formNewAlbum->check(false));
        }
    }

    mcv::addView("userNewAlbum");
?>