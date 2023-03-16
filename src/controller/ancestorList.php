<?php
    namespace class;
    metaTitle::setTitle("Liste des fiches d'identité");
    metaTitle::setDescription("Découvrez la liste entière des mes ancêtres !");
    additionnalJsCss::set("ancestorLabel.css");
    additionnalJsCss::set("paging.css");
    additionnalJsCss::set("filter.js");
    

    $page = 1;
    if(isset($_GET["page"])){
        if(is_numeric($_GET["page"])){
            $page = \class\security::cleanStr($_GET["page"]);
        }
    }

    /* SORT BY */
    if(isset($_GET["ancestorOrderBy"])){ // if ancestorOrderBy is set
    
        $ancestorOrderBy = "lastUpdate";
        if(in_array($_GET["ancestorOrderBy"], \enumList\ancestorOrderBy::names())){ // i check if the row for ancestorOrderBy is in the enumList
            $ancestorOrderBy = $_GET["ancestorOrderBy"];
        }

        $sortBy = "ASC";
        if(isset($_GET["sortBy"])){ // if ancestorOrderBy is set
            if(in_array($_GET["sortBy"], \enumList\sortBy::names())){ // i check if VALUE is in the enumList
                $sortBy = $_GET["sortBy"];
            } 
        }
    }else{ // if ancestorOrderBy is not set
        $ancestorOrderBy = "lastUpdate";
        $sortBy = "ASC";
    }


    /* FILTER */
    $filter = array();

    if(isset($_GET["gender"])){ // if gender i check if value is in enumList
        if(in_array($_GET["gender"], \enumList\gender::values())){
            $filter["gender"] = $_GET["gender"];
        }
    }

    $resultPerPage = 10; // number max of result per page
    $start = ($page-1)*$resultPerPage;

    $ancestorCount = count(\model\ancestor::getList(array("id"), 0, NULL, array($ancestorOrderBy, $sortBy), $filter)); // number of ancestor in DB
    $pageCount = ceil($ancestorCount/$resultPerPage); // number of page

    
    if($ancestorCount > 0 && $page <= $pageCount){
        $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay", "author"), $start, $resultPerPage, array($ancestorOrderBy, $sortBy), $filter);
        
        $output = template::ancestorReplace(template::get("ancestorCard"), $ancestorList);
        
        mcv::addView("ancestorList");
    }else{ // if any identity card or any result with the filters
        header("HTTP/1.1 404 NOT FOUND");
        $msgError ="Pas de fiches d'identité pour le moment !";
        mcv::addView("noContent");
    }

?>