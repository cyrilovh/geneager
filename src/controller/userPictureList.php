<?php
    namespace class;
    metaTitle::setTitle("Liste des photos ");

    additionnalJsCss::set("table.css");

    if(validator::isId()){ // i check if ID is provided
        $id = format::normalize($_GET["id"]);
        $btnNewPicture = "<a href='/userNewPicture/?id=$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>";
        $data = \model\picture::getList(array("picture.folder" => $id));
    }else{
        $data = \model\picture::getList();
    }

    if(count($data) > 0){
        $output = template::autoReplace(template::get("userPictureList"), $data, true, "Picture");
        mcv::addView("userPictureList");
    }else{
        $msgError = "Aucune photo n'a été trouvée pour cet album.";
        $msgError .= (userInfo::isConnected() ? "<br><a href='/userNewPicture/?id=$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>" : "");
        mcv::addView("noContent");
    }
?>