<?php
    namespace class;
    $meta_title = "Liste des photos ".$meta_separator.$meta_title;
    mcv::addView("userPictureList");
    additionnalJsCss::set("table.css");

    if(validator::isId()){ // i check if ID is provided
        $id = format::normalize($_GET["id"]);
        $btnNewPicture = "<a href='/userNewPicture/?id=$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>";
        $data = \model\picture::getList(array("picture.folder" => $id));
    }else{
        $data = \model\picture::getList();
    }

    $output = template::autoReplace(template::get("userPictureList"), $data, true, "Picture");
?>