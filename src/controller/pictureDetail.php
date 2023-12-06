<?php
    namespace class;
    
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $filename = security::cleanStr($_GET["id"]);  
        if(file_exists(UPLOAD_DIR_FULLPATH."picture/family/".$filename)){
            $data = \model\picture::getPictureAndAlbumByNameAndLocation($filename);

            if($data){ // if exist in DB 

                // create date object
                $createDateObj = new date();
                $createDateObj->setMySQLDateAsPoo($data["createDate"]);

                // last upDate object
                $lastUpdateObj = new date();
                $lastUpdateObj->setMySQLDateAsPoo($data["lastUpdate"]);

                // FIRSTLY I CREATE MY OBJECT
                $picture = new picture($data["id"], $data["filename"], $createDateObj, $data["authorAlbum"]);
                $picture->setLastUpdate($lastUpdateObj);
                $picture::$html = true;
                // add basic data
                $picture->setTitle($data["title"]);
                $picture->setDescription($data["descript"]);

                // FOLDER OF THE PICTURE
                $folderObj = new folder($data["idAlbum"], $data["authorAlbum"], $data["createDateAlbum"], $data["lastUpdateAlbum"]);
                $folderObj->setTitle($data["titleAlbum"]);
                $folderObj->setDescript($data["descriptAlbum"]);
                $picture->setFolder($folderObj);

                // PICTURE SOURCE
                $sourceObj = new source($data["sourceText"], $data["sourceLink"]);
                $picture->setSource($sourceObj);

                // EVENT
                $dateObj = new date($data["yearEvent"], $data["monthEvent"], $data["dayEvent"]);
                $locationObj = new location($data["country"], $data["stateDepartementName"], $data["cityName"], $data["accuracyLocation"]);
                $eventObj = new event(null, $dateObj, $locationObj);
                $picture->setEvent($eventObj);

                // AUTHOR (= author of the album)
                $picture->setAuthor($data["authorAlbum"]);

                // TAGS
                $dataTag = \model\tag::getByIDPictureWithIdentity($data["id"]);
                echo "<pre>";
                print_r($dataTag);
                echo "</pre>";

                if($dataTag){
                    foreach($dataTag as $tag){
                        $tagList = new tag();

                        // i define the ancestor to put in the tagList
                        $ancestorObj = new ancestor($tag["ancestorID"]);
                        $ancestorObj->setFirstNameList($tag["firstNameList"]);
                        $ancestorObj->setLastNameList($tag["lastNameList"]);
                        $ancestorObj->setBirthNameList($tag["birthNameList"]);
                        $ancestorObj->setMarriedNameList($tag["marriedNameList"]);

                        $tagList->setAncestor($ancestorObj);
    
                        $coordinatesStr = explode(",", $tag["coordinates"]);
                        $coordinatesObj = new coordinates($coordinatesStr[0], $coordinatesStr[1], $coordinatesStr[2], $coordinatesStr[3]);
                        $tagList->setCoordinates($coordinatesObj);

                        $picture->addTag($tagList);
                        
                    }
                }

                // THEN I USE THE OBJECT TO CREATE THE HTML
                $outputData = [
                    "title" => $picture->getTitle(),
                    "descript" => $picture->getDescription(),
                    "location" => $eventObj->getLocation()->getString(),
                    "date" => $eventObj->getDate(),
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