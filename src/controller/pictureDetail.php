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
                // add basic data
                $picture->setTitle($data["title"]);
                $picture->setDescription($data["descript"]);

                // FOLDER OF THE PICTURE
                $folder = new folder($data["idAlbum"], $data["authorAlbum"], $data["createDateAlbum"], $data["lastUpdateAlbum"]);
                $folder->setTitle($data["titleAlbum"]);
                $folder->setDescript($data["descriptAlbum"]);
                $picture->setFolder($folder);

                // PICTURE SOURCE
                $source = new source($data["sourceText"], $data["sourceLink"]);
                $picture->setSource($source);

                // EVENT
                $date = new date($data["yearEvent"], $data["monthEvent"], $data["dayEvent"]);
                $location = new location($data["country"], $data["stateDepartementName"], $data["cityName"], $data["accuracyLocation"]);
                $event = new event(null, $date, $location);
                $picture->setEvent($event);

                // AUTHOR (= author of the album)
                $picture->setAuthor($data["authorAlbum"]);

                // TAGS
                $dataTag = \model\tag::getByIDPictureWithIdentity($data["id"]);
                // echo "<pre>";
                // print_r($dataTag);
                // echo "</pre>";

                if($dataTag){
                    foreach($dataTag as $tag){
                        $tagList = new tag();

                        // i define the ancestor to put in the tagList
                        $ancestor = new ancestor($tag["ancestorID"]);
                        $ancestor->setFirstNameList($tag["firstNameList"]);
                        $ancestor->setLastNameList($tag["lastNameList"]);
                        $ancestor->setBirthNameList($tag["birthNameList"]);
                        $ancestor->setMarriedNameList($tag["marriedNameList"]);

                        $tagList->setAncestor($ancestor);
    
                        $coordinatesStr = explode(",", $tag["coordinates"]);
                        $coordinates = new coordinates($coordinatesStr[0], $coordinatesStr[1], $coordinatesStr[2], $coordinatesStr[3]);
                        $tagList->setCoordinates($coordinates);

                        
                    }
                }

                // THEN I USE THE OBJECT TO CREATE THE HTML
                $outputData = [
                    "title" => $picture->getTitle(),
                    "descript" => $picture->getDescription(),
                    "location" => $event->getLocation()->getString(),
                    "date" => $event->getDate(),
                    "tagList" => $picture->getTagString(),
                    "source" => $picture->getSource()->toHTML(),
                    "folderID" => $picture->getFolder()->getID(),
                    "folderTitle" => $picture->getFolder()->getTitle(),
                    "author" => $picture->getAuthor(),
                    "dateEvent" => $picture->getEvent()->getDate(),
                    "filename" => $picture->getFilename(),
                    "createDate" => $picture->getCreateDate()->getdate(),
                    "lastUpdate" => $picture->getLastUpdate()->getdate()
                ];
                

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