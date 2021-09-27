<?php
    /* TEST METAS */
    $meta_title = "My title test";
    $meta_description = "Just a description";
    $meta_keyword = "test, test, test";
    $meta_author = "Paul testeur";
    
    //$include_header = "header3";

    /* TEST VIEWS */
    if(1==1){
        \gng\mcv::addView("test");
        /* \gng\mcv::addView("test2"); */
    }

    /* TEST CSS AND JS ADD */

    \gng\additionnalJsCss::set("style2.css");
    \gng\additionnalJsCss::set("monJS.js");

    /* FORM */

    $myForm = new \gng\form("get","?"); // je déclare un nouveau objet (formulaire) GET et la cible où les données sont
                                        // à envoyer

    $myForm->setElement("input", array( // je crée un élément
        "type" => "input",              // je spécifie qu'il s'agit d'une balise input
        "value" => "My text input",     // je spécifie sa valeur
        "name" => "testInput",          // je lui donne son nom /!\ REQUIS pour le submit
        "onclick" => "alert(\"Focused !\");" // j'ouvre un boite à dialogue "alert"
    ));

    $myForm->setElement("select", array(    // menu déroulant
        "1" => "un",    // la valeur et le texte associé
        "2" => "deux",
        "3" => "trois",
        "attr:" => array(
            "name"=>"quantity"
        )   
    ));

    $myForm->setElement("textarea", array(  //textarea
        "value" => "test textarea",         // je peux spécifier sa valeur
        "maxlength" => "200"                // je lui fixe un attribut. ici l'attribut "maxlength" avec une valeur à "200"
    ));

    $myForm->setElement("input", array(     // ici je crée mon élément input
        "type" => "submit",                 // de type submit
        "value" => "submit"                 // avec la valeur "submit"
    ));
    
 ?>