<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);  
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/".$filename)){
            $data = \model\picture::getByFilename($filename);

            if($data){ // if exist in DB 

                $title = (is_null($data["title"])) ? "Sans titre" : $data["title"];
                $titleHTML = "<h1><i class='fa-solid fa-heading'></i> $title</h1>";

                $description = (validator::isNullOrEmpty($data["descript"])) ? "Aucune description" : $data["descript"];
                $descriptionHTML = "<p class='txt-disabled'><i class='fa-solid fa-align-left'></i> $description</p>";

                metaTitle::setTitle($title." — Photo");
                metaTitle::setDescription($description);
                
                mcv::addView("pictureDetail");
            }else{
                $msgError = "Le fichier existe sur le serveur mais pas dans la base de données.";
                mcv::addView("noContent");
            }

        }else{
            $msgError = "Le fichier n'existe pas sur le serveur.";
            mcv::addView("noContent");
        }
    }else{
        mcv::addView("404");
    }

