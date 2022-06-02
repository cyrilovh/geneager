<?php
    namespace class;
    $meta_title = "Liste des fiches d'identités ".$meta_separator.$meta_title;
    $meta_description = "Découvrez la liste entière des mes ancêtres !";
    additionnalJsCss::set("ancestorLabel.css");
    additionnalJsCss::set("identityList.css");
    additionnalJsCss::set("filter.js");
    

    $page = 1;
    if(isset($_GET["page"])){
        if(is_numeric($_GET["page"])){
            $page = \class\security::cleanStr($_GET["page"]);
        }
    }

    $resultPerPage = 3; // number max of result per page
    $start = ($page-1)*$resultPerPage;

    $ancestorCount = count(\model\ancestor::getList(array("id"))); // number of ancestor in DB
    $pageCount = ceil($ancestorCount/$resultPerPage); // number of page

    if($ancestorCount > 0 && $page <= $pageCount){
        
        /* SORT BY */
        if(isset($_GET["orderBy"])){ // if orderBy is set
            
            $orderBy = "lastUpdate";
            if(in_array($_GET["orderBy"], \enumList\orderBy::names())){ // i check if the row for orderBy is in the enumList
                $orderBy = $_GET["orderBy"];
            }

            $sortBy = "ASC";
            if(isset($_GET["sortBy"])){ // if orderBy is set
                if(in_array($_GET["sortBy"], \enumList\sortBy::names())){ // i check if VALUE is in the enumList
                    $sortBy = $_GET["sortBy"];
                } 
            }
        }else{ // if orderBy is not set
            $orderBy = "lastUpdate";
            $sortBy = "ASC";
        }


        $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay"), $start, $resultPerPage, array($orderBy, $sortBy));
        mcv::addView("identityList");
    }else{ // if any identity card or any result with the filters
        header("HTTP/1.1 204 NO CONTENT");
        mcv::addView("noContent");
    }

?>