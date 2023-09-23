<?php
    namespace class;
    metaTitle::setTitle("Liste des photos ");

    additionnalJsCss::set("table.css");

    if(validator::isId()){ // i check if ID is provided
        $id = format::normalize($_GET["id"]);
        $data = \model\picture::getList(array("picture.folder" => $id));
        $btnNewPicture = "<a href='/userNewPicture/$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>";

        var_dump(\model\album::getPictureListAndAlbumInfoByID($id));
    }else{
        $data = \model\picture::getList();
    }

    if(count($data) > 0){
        $output = template::autoReplace(template::get("pictureList"), $data, true, "Picture");
        mcv::addView("pictureList");
    }else{
        $msgError = "Aucune photo n'a été trouvée...";
        if(validator::isId()){
            $msgError .= (userInfo::isConnected() ? "<br><a href='/userNewPicture/$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>" : "");
        }
        mcv::addView("noContent");
    }
?>