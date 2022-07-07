<?php

    namespace class;
    /* TEST METAS */
    $meta_title = "My title test";
    $meta_description = "Just a description";
    $meta_keyword = "test, test, test";
    $meta_author = "Paul testeur";
    
    //$include_header = "header3";


    mcv::addView("test");

    $form = new form(
        array(
            "action" => "/test",
            "method" => "post",
            "class" => "form-horizontal",
            "id" => "formTest",
            "enctype" => "multipart/form-data"
        )
    );

    $form->setElement("input",
        array(
            "type" => "file",
            "name" => "fichier",
            "id" => "file",
            "class" => "form-control",
            "placeholder" => "test",
            "value" => "test"
        )
    );

    $form->setElement("input",
        array(
            "type" => "submit",
            "name" => "submit",
            "id" => "submit",
            "class" => "btn btn-primary",
            "value" => "Submit"
        )
    );

    if($form->check()){
        if(!isset($_FILES['fichier'])){
            trigger_error("\$_FILES is not set");
        }
        $theFile = $_FILES["fichier"];
        echo "----------------------------------------------------<br>";
        var_dump(file::upload($theFile, array("picture")));
    }


 ?>