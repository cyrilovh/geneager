<?php
namespace class;

use class\security;
use class\validator;

header('Content-Type: application/json; charset=utf-8');
// $output = array();
$json = new json();

if(validator::isQuery(2)){
    $query = security::cleanStr($_GET["q"]);
    $sqlData = \model\ancestor::suggestByIdentity($query);

    $count = count($sqlData);
    if($count>0){
        $status = new status();
        $status->setSuccess();

        $json->setMessage($count." suggestions(s) trouvé(s).");

        $json->addData($sqlData);
    }else{
        $status = new status();
        $status->setInfo();

        $json->setMessage("Aucune suggestion trouvée.");
    }
}else{
    $status = new status();
    $status->setError();

    $json->setMessage("Requête invalide.");
}

$json->setStatus($status);
echo $json->getJSON();

?>