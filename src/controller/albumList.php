<?php
    namespace class;
    metaTitle::setTitle("Liste des photos"); // i set the title page + separator + website name
    $meta_description = "Retrouvez les photographies de ma famille sur mon site personnel.";

    additionnalJsCss::set("albumList.css");
    additionnalJsCss::set("filter.css");
    additionnalJsCss::set("filter.js");
    additionnalJsCss::set("albumList.js");

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

    $albumList = \model\album::getList(array("*"), 0, 15, array($albumOrderBy, $sortBy), array());

    mcv::addView("albumList");
?>