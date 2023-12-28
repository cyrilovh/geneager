<?php
    namespace class;

    $title = "Gérer les identifications";
    metaTitle::setRobot(array("noindex"));

    $include_header = "";
    $include_navbar = "";
    $include_footer = "";

    additionnalJsCss::set("pictureTag.js");
    additionnalJsCss::set("pictureTag.css");
    additionnalJsCss::set("dialbox.css");

    $messageList = new msgbox();

    if(validator::isId()){

        $idPicture = $_GET["id"];

        $picture = \model\picture::get($idPicture);

        if($picture){ // if picture exist
            
            // FIRST I RETRIEVE ALL TAGS IN DATABASE FOR DISPLAY THEM
            $tag = \model\tag::getByIDPictureWithIdentity($idPicture);

            if($tag){
                $tagList = new tagList();

                foreach($tag as $tag){
                    // set ancestor object
                    $ancestor = new ancestor($tag["ancestorID"]);
                    $ancestor->setFirstnameList($tag["firstNameList"]);
                    $ancestor->setLastnameList($tag["lastNameList"]);
                    $ancestor->setBirthNameList($tag["birthNameList"]);
                    $ancestor->setMarriedNameList($tag["marriedNameList"]);

                    if(validator::isValidCoordinates($tag["coordinates"])){
                        // set coordinates
                        $abs = explode(",", $tag["coordinates"]);
                        $coordinates = new coordinates($abs[0], $abs[1], $abs[2], $abs[3]);


                        // set new tag
                        $tag = new tag();
                        $tag->setAncestor($ancestor);
                        $tag->setCoordinates($coordinates);

                        $tagList->addTag($tag);
                    }else{
                        $messageList->setError("Les coordonnées de l'identification sont invalides.");
                    }
                }

            }

            mcv::addView("pictureTag");
        }else{
            $messageList->setError("La photo n'existe pas ou plus.");
            mcv::addView("noContent");
        }
    }else{
        $messageList->setError("ID de photo invalide.");
        mcv::addView("noContent");
    }


    
?>