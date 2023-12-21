<?php
    namespace class;
    metaTitle::setTitle("Liste des photos ");

    additionnalJsCss::set("table.css");

    if(validator::isId()){ // i check if ID is provided
        $id = format::normalize($_GET["id"]);
        $data = \model\album::getPictureListAndAlbumInfoByID($id);
        $btnNewPicture = "<a href='/userNewPicture/$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>";
    }else{
        $data = \model\picture::getList();
    }

    if(count($data) > 0){
        $output = template::autoReplace(template::get("pictureList"), $data, true, "Picture");
        mcv::addView("pictureList");
    }else{
        $messageList = new msgbox();
        $msg = "<p>Aucune photo n'a été trouvée...</p>";
        if(validator::isId()){
            $msg .= (userInfo::isConnected() ? "<br><a href='/userNewPicture/$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>" : "");
        }
        $messageList->setError($msg);
        mcv::addView("noContent");
    }
?>