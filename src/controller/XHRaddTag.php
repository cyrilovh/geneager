<?php
namespace class;

header('Content-Type: application/json; charset=utf-8');

$json = new json();
$status = new status();

// get the JSON data
$jsonData = file_get_contents('php://input');


if(!$jsonData){
    $status->setError();
    $json->setMessage("Aucune donnée reçue.");
}else{
    if(validator::isJSON($jsonData)){
        $data = json_decode($jsonData, true);
        if(validator::isArrOfArrNotEmpty($data)){
            $status->setSuccess();
            $json->setMessage("Données valides.");
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
