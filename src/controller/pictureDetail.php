<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);
        metaTitle::setTitle(" *** TITRE *** — Photo");
    
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/".$filename)){
            mcv::addView("pictureDetail");
        }else{
            mcv::addView("noContent");
        }
    }else{
        mcv::addView("404");
    }

