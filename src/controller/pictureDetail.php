<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);  
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/family/".$filename)){
            $data = \model\picture::getPictureAndAlbumByNameAndLocation($filename);

            if($data){ // if exist in DB 

                // FIRSTLY I CREATE MY OBJECT
                $picture = new pictureV1($data["id"], $data["filename"], $data["createDate"], $data["author"]);
                $picture::$html = true;
                $picture->setTitle($data["title"]);
                $picture->setDescript($data["descript"]);
                $picture->setLocationID($data["location"]);
                $picture->setYearEvent($data["yearEvent"]);
                $picture->setMonthEvent($data["monthEvent"]);
                $picture->setDayEvent($data["dayEvent"]);
                $picture->setSourceText($data["sourceText"]);
                $picture->setSourceLink($data["sourceLink"]);
                $picture->setFolderID($data["idAlbum"]);
                $picture->setFolderTitle($data["titleAlbum"]);
                $picture->setLastUpdate($data["lastUpdate"]);
                $picture->setAccuracyLocation($data["accuracyLocation"]);
                $picture->setLocationCity($data["cityName"]);
                $picture->setLocationStateDepartement($data["stateDepartementName"]);
                $picture->setLocationCountry($data["country"]);
                $picture->setLastUpdate($data["lastUpdate"]);


                // THEN I USE THE OBJECT TO CREATE THE HTML
                $output = null;
                $output .= $picture->getTitle();
                $output .= $picture->getFolderTitle();
                $output .= $picture->getDateEvent();
                $output .= $picture->getDescript();
                $output .= $picture->getFullLocation();
                $output .= $picture->getPicture();
                $output .= $picture->getSource();

                metaTitle::setTitle($data["title"]." — Photo");
                metaTitle::setDescription($data["descript"]);
                
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

