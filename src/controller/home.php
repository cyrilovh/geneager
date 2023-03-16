<?php 
    namespace class;
    additionnalJsCss::set("ancestorLabel.css");

    $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay", "author"), 0, 6);

    if($ancestorList > 0){
        mcv::addView("home");
        $output = template::ancestorReplace(template::get("ancestorCard"), $ancestorList);
    }else{
        $msgError ="Pas de fiches d'identité pour le moment !";
        $output = mcv::addView("noContent");
    }
?>