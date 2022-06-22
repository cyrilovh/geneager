<?php
    namespace class;
    $meta_title = "Albums photos ".$meta_separator.$meta_title;
    mcv::addView("userNewAlbum");

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
        "maxlength" => 100, // i add the attr maxlength
        "class" => "form-control w100"),
        // add content after or before the element
        array(
            "before" => "<p class='bold'>Titre de l'album:</p>",
        )
    );


    // BUG ICI
    $formNewAlbum->setElement("textarea", array(
        "placeholder" => "Description de l'album", // i set a placeholder
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

    $formNewAlbum->setElement("input", array(
        "type" => "submit",
        "value" => "Ajouter",
        "name" => "submit",
        "class" => "btn btn-primary form-control" // i add a class to the element
    ));
?>