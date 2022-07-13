<?php
    namespace class;
    metaTitle::setTitle("Albums photos");
    additionnalJsCss::set("filter.js");
    additionnalJsCss::set("paging.css");
    
    $page = 1;
    if(isset($_GET["page"])){
        if(is_numeric($_GET["page"])){
            $page = \class\security::cleanStr($_GET["page"]);
        }
    }

    /* SORT BY */
    if(isset($_GET["albumOrderBy"])){ // if albumOrderBy is set
    
        $albumOrderBy = "lastUpdate";
        if(in_array($_GET["albumOrderBy"], \enumList\albumOrderBy::names())){ // i check if the row for albumOrderBy is in the enumList
            $albumOrderBy = $_GET["albumOrderBy"];
        }

        $sortBy = "ASC";
        if(isset($_GET["sortBy"])){ // if albumOrderBy is set
            if(in_array($_GET["sortBy"], \enumList\sortBy::names())){ // i check if VALUE is in the enumList
                $sortBy = $_GET["sortBy"];
            } 
        }
    }else{ // if albumOrderBy is not set
        $albumOrderBy = "lastUpdate";
        $sortBy = "ASC";
    }

    $currentUser = (userInfo::isConnected()) ? ((userInfo::isAdmin()) ? array() : array("author" => userInfo::getUsername()) ) : array(); // return username except if admin (admin can see all albums)

    /* FILTER */
    $resultPerPage = 10; // number max of result per page
    $start = ($page-1)*$resultPerPage;

    $albumCount = count(\model\album::getList(array("id"), 0, NULL, array($albumOrderBy, $sortBy), $currentUser)); // number of album in DB
    $pageCount = ceil($albumCount/$resultPerPage); // number of page

    if($albumCount > 0 && $page <= $pageCount){
        $albumList = \model\album::getList(array("*"), $start, $resultPerPage, array($albumOrderBy, $sortBy), $currentUser); // get the list of album
        mcv::addView("userAlbumList");
    }else{ // if any identity card or any result with the filters
        header("HTTP/1.1 404 NOT FOUND");
        mcv::addView("noContent");
    }
?>