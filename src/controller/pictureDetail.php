<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);  
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/family/".$filename)){
            $data = \model\picture::getPictureAndAlbumByNameAndLocation($filename);

            if($data){ // if exist in DB 

                // create date object
                $createDate = new date();
                $createDate->setMySQLDateAsPoo($data["createDate"]);

                // last upDate object
                $lastUpdate = new date();
                $lastUpdate->setMySQLDateAsPoo($data["lastUpdate"]);

                // FIRSTLY I CREATE MY OBJECT
                $picture = new picture($data["id"], $data["filename"], $createDate, $data["authorAlbum"]);
                $picture->setLastUpdate($lastUpdate);
                $picture::$html = true;
                // BASIC DATA
                $picture->setTitle($data["title"]);
                $picture->setDescription($data["descript"]);

                $folder = new folder($data["idAlbum"], $data["authorAlbum"], $data["createDateAlbum"], $data["lastUpdateAlbum"]);
                $folder->setTitle($data["titleAlbum"]);
                $folder->setDescript($data["descriptAlbum"]);

                // PUT THE SOURCE IN THE PICTURE
                $source = new source($data["sourceText"], $data["sourceLink"]);
                $picture->setSource($source);

                // PUT THE FOLDER IN THE PICTURE
                $picture->setFolder($folder);

                // CREATE THE EVENT
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

                // put the event in the picture
                $picture->setEvent($event);

                // PUT THE AUTHOR IN THE PICTURE (= author of the album)
                $picture->setAuthor($data["authorAlbum"]);


                // THEN I USE THE OBJECT TO CREATE THE HTML
                $outputData = array(); // ATTENTION BRICOLAGE
                $outputData["title"] = $picture->getTitle();
                $outputData["descript"] = $picture->getDescription();
                $outputData["location"] = $event->getLocation()->getString();
                $outputData["date"] = $event->getDate(); // PROBLEME ICI

                $outputData["source"] = $picture->getSource()->toHTML();
                $outputData["folderID"] = $picture->getFolder()->getID();
                $outputData["folderTitle"] = $picture->getFolder()->getTitle();
                $outputData["author"] = $picture->getAuthor();
                $outputData["dateEvent"] = $picture->getEvent()->getDate();

                $outputData["filename"] = $picture->getFilename();

                $outputData["createDate"] = $picture->getCreateDate()->getdate(); 
                $outputData["lastUpdate"] = $picture->getLastUpdate()->getdate();

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

