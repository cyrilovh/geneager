<?php 
    namespace class;
    additionnalJsCss::set("ancestorLabel.css");

    $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenNameList", "gender", "birthdayY", "author"), 0, 6);

    if(count($ancestorList) > 0){
        mcv::addView("home");
        $output = template::ancestorReplace(template::get("ancestorCard"), $ancestorList);
    }else{
        mcv::addView("home");
        $output = (userInfo::isConnected() ? "<p>Pas de fiches d'identité pour le moment. </p> <p><a class='btn btn-sm btn-success' href='/userEditAncestor'><span class='fa fa-plus'></span> Ajouter une fiche d'identité</a></p>" : "Pas encore de fiches d'identité pour le moment.");
    }
?>