<?php
namespace class;

use class\security;
use class\validator;

header('Content-Type: application/json; charset=utf-8');
// $output = array();
$json = new json();

if(userInfo::isConnected()){
    if(validator::isQuery(0)){
        $query = security::cleanStr($_GET["q"]);
        $sqlData = \model\ancestor::suggestByIdentity($query);
    
        $count = count($sqlData);
        if($count>0){
            
            $ancestorList = new ancestorList();

            // set ancestor object
            foreach($sqlData as $dataAncestor){
                $ancestor = new ancestor($dataAncestor["id"]);
                $ancestor->setFirstnameList($dataAncestor["firstNameList"]);
                $ancestor->setLastnameList($dataAncestor["lastNameList"]);
                $ancestor->setBirthNameList($dataAncestor["birthNameList"]);
                $ancestor->setMarriedNameList($dataAncestor["marriedNameList"]);
                $ancestor->setOtherIdentityList($dataAncestor["otherIdentityList"]);

                // set birth and death
                $eventBirth = new event();
                $dateBirth = new date();
                $dateBirth->setYear($dataAncestor["birthdayY"]);
                $eventBirth->setDate($dateBirth);
                $ancestor->setBirth($eventBirth);

                $eventDeath = new event();
                $dateDeath = new date();
                $dateDeath->setYear($dataAncestor["deathdateY"]);
                $eventDeath->setDate($dateDeath);
                $ancestor->setDeath($eventDeath);

                // add ancestor to ancestorList
                $ancestorList->addAncestor($ancestor);
            }
    
            // set json
            $json->addData($ancestorList->getArrayAsArray());

            $status = new status();
            $status->setSuccess();
    
            $json->setMessage($count." suggestions(s) trouvé(s).");
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
}else{
    $status = new status();
    $status->setError();

    $json->setMessage("Vous devez être connecté pour effectuer cette action.");
}

$json->setStatus($status);
echo $json->getJSON();
?>