<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);  
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/family/".$filename)){
            $data = \model\picture::getPictureAndAlbumByNameAndLocation($filename);
            // var_dump($data);

            if($data){ // if exist in DB 

                // FIRSTLY I CREATE MY OBJECT
                $picture = new picture($data["id"], $data["filename"], $data["createDate"], $data["authorAlbum"]);
                $picture::$html = true;
                // BASIC DATA
                $picture->setTitle($data["title"]);
                $picture->setDescription($data["descript"]);

                $folder = new folder($data["idAlbum"], $data["authorAlbum"], $data["createDateAlbum"], $data["lastUpdateAlbum"]);
                $folder->setTitle($data["titleAlbum"]);
                $folder->setDescript($data["descriptAlbum"]);
                // PUT THE FOLDER IN THE PICTURE
                $picture->setFolder($folder);

                $date = new date($data["yearEvent"], $data["monthEvent"], $data["dayEvent"]);

                $location = new location();
                $location->setAccuracy($data["accuracyLocation"]);
                $location->setCity($data["cityName"]);
                $location->setStateDepartement($data["stateDepartementName"]);
                $location->setCountry($data["country"]);

                $event = new event(); // EVENT = ?date + ?location

                $date = new date($data["yearEvent"], $data["monthEvent"], $data["dayEvent"]);
                $event->setDate($date);
                $event->setLocation($location);

                // PUT THE EVENT IN THE PICTURE
                $picture->setEvent($event);

                // PUT THE AUTHOR IN THE PICTURE (= author of the album)
                $picture->setAuthor($data["authorAlbum"]);


                // THEN I USE THE OBJECT TO CREATE THE HTML
                $outputData = array(array()); // ATTENTION BRICOLAGE
                $outputData[0]["title"] = $picture->getTitle();
                $outputData[0]["folderTitle"] = $picture->getFolder()->getTitle();
                $outputData[0]["author"] = $picture->getAuthor();
                $outputData[0]["dateEvent"] = $picture->getEvent()->getDate();
                $outputData[0]["descript"] = $picture->getDescription();
                $outputData[0]["location"] = $event->getLocation()->getString();
                $outputData[0]["filename"] = $picture->getFilename();
                $outputData[0]["createDate"] = $picture->getCreateDate(); // FORMATTER / ET SI NULL
                $outputData[0]["lastUpdate"] = $picture->getLastUpdate(); // FORMATTER / ET SI NULL
                // //$output .= $picture->getSource();

                $output = template::autoReplace(template::get("pictureDetail"), $outputData);

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

