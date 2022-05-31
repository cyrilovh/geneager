<?php
    namespace class;
    $meta_title = "Liste des fiches d'identités ".$meta_separator.$meta_title;
    $meta_description = "Découvrez la liste entière des mes ancêtres !";
    additionnalJsCss::set("ancestorLabel.css");
    additionnalJsCss::set("identityList.css");
    additionnalJsCss::set("identityList.js");
    mcv::addView("identityList");


    if(isset($_GET["page"])){
        if(is_numeric($_GET["page"])){
            $page = \class\security::cleanStr($_GET["page"]);
        }
    }

    $resultPerPage = 3; // number max of result per page
    $start = ($page-1)*$resultPerPage;

    $ancestorCount = count(\model\ancestor::getList(array("id"))); // number of ancestor in DB
    $pageCount = ceil($ancestorCount/$resultPerPage); // number of page

    $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay"), $start, $resultPerPage);
   


?>