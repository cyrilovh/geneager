<?php
    namespace class;

    if(!isset($_GET["id"])){ // i check if ID is provided
        mcv::addView("404");
    }else{
        if(is_numeric($_GET["id"])){ // i check if it's numeric value
            $id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8"); // we never know
            $data = \model\ancestor::get($id);
            
            if(count($data)!=0){
                $ancestor = new ancestor($data["id"]); // i create my new object
                
                $ancestor->setFirstNameList($data["firstNameList"]);
                $ancestor->setLastNameList($data["lastNameList"]);
                $ancestor->setotherIdentityList($data["otherIdentityList"]);
                $ancestor->setMarriedNameList($data["marriedNameList"]);
                $ancestor->setBirthNameList($data["birthNameList"]);
                $ancestor->setMarriedNameList($data["marriedNameList"]);

                $ancestor->setPhoto($data["photo"]);
                $ancestor->setGender($data["gender"]);

                $ancestor->setBiography($data["biography"]);

                //$ancestor->setBirth(); // type event

                //$ancestor->setDeath(); // type event

                // $ancestor->setCemetery(); // type location

                $ancestor->setAuthor($data["author"]);

                $ancestor->setCreateDate($data["createDate"]);

                $ancestor->setLastUpdate($data["lastUpdate"]);

                // $ancestor->setRelationList(); // type relation

                
                metaTitle::setTitle($ancestor->getFullIdentityDisplay()." — Fiche d'identité"); // i set the title page + separator + website name
                metaTitle::setDescription("Découvrez qui était ".$ancestor->getFullIdentityUnformatted()." grâce à sa fiche d'identité (biographie, documents, photos, ...).");

                additionnalJsCss::set("ancestor.css");
                mcv::addView("ancestor");
            }else{
                mcv::addView("404");
            }
        }else{
            mcv::addView("404");
        }
    }
?>