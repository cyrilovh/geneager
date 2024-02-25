<?php
namespace class;

header('Content-Type: application/json; charset=utf-8');

$json = new json();
$status = new status();

// get the JSON data
$jsonData = file_get_contents('php://input');
//var_dump($jsonData);

if(!$jsonData){
    $status->setError();
    $json->setMessage("Aucune donnée reçue.");
}else{

    // if user is not connected i stop the process immediately
    if(!userInfo::isConnected()){
        $status->setError();
        $json->setMessage("Vous devez être connecté pour effectuer cette action.");
        $json->setStatus($status);
        echo $json->getJSON();
        exit(); // goodbye !!!
    }

    if(validator::isJSON($jsonData)){
        $data = json_decode($jsonData, true);

        // check if is a valid array
        if(is_array($data)){          
            // check if all data expected are in the array
            if(validator::keylistInArray(array("coordonnees", "ancestorID","pictureID"), $data)){
                // check if types are valid for each data
                if(is_numeric($data["ancestorID"]) && is_numeric($data["pictureID"]) && validator::isValidCoordinates($data["coordonnees"])){
                    $pictureFromDB = \model\picture::getPictureAndAlbumByID($data["pictureID"]);
                    // if picture exist
                    if($pictureFromDB){
                        // if user is the author of the album or admin
                        if(userInfo::isAuthorOrAdmin($pictureFromDB["authorAlbum"])){
                            $ancestorFromDB = \model\ancestor::get($data["ancestorID"]);
                            if($ancestorFromDB){

                                if(!\model\tag::checkIfTagExist($data["pictureID"], $data["ancestorID"])){
                                    if(\model\tag::addTag($data["pictureID"], $data["ancestorID"], $data["coordonnees"])){
                                        $status->setSuccess();
                                        $json->setMessage("L'ancêtre à été ajouté avec succès.");
                                    }else{
                                        $status->setError();
                                        $json->setMessage("Erreur technique lors de l'ajout de l'identification.");
                                    }
                                    $status->setSuccess();
                                    $json->setMessage("Données valides.");
                                }else{
                                    $status->setError();
                                    $json->setMessage("L'ancêtre est déjà identifié sur cette photo.");
                                }

                            }else{
                                $status->setError();
                                $json->setMessage("L'ancêtre n'existe pas dans la base de données.");
                            }
                        }else{
                            $status->setError();
                            $json->setMessage("Vous n'avez pas les droits suffisants pour effectuer cette action.");
                        }
                    }else{
                        $status->setError();
                        $json->setMessage("La photo n'existe pas.");
                    }
                }else{
                    $status->setError();
                    $json->setMessage("Format des données invalides.");
                }
            }else{
                $status->setError();
                $json->setMessage("Données manquantes.");
            }

            // verifs si ancestor existe pas deja dans la photo


        }else{
            $status->setError();
            $json->setMessage("Données invalides.");
        }
    }else{
        $status->setError();
        $json->setMessage("Données invalides.");
    }
}


// validator::isValidCoordinates($_POST["coordinates"])




$json->setStatus($status);
echo $json->getJSON();
?>
