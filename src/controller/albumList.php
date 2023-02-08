<?php
    namespace class;
    metaTitle::setTitle("Liste des photos"); // i set the title page + separator + website name
    metaTitle::setDescription("Retrouvez les photographies de ma famille sur mon site personnel.");

    additionnalJsCss::set("albumList.css");
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

    /* FILTER */
    $filter = array();


    $resultPerPage = 10; // number max of result per page
    $start = ($page-1)*$resultPerPage;

    $albumCount = count(\model\album::getList(array("id"), 0, NULL, array($albumOrderBy, $sortBy), $filter)); // number of album in DB
    $pageCount = ceil($albumCount/$resultPerPage); // number of page


    if($albumCount > 0 && $page <= $pageCount){
        $albumList = \model\album::getList(array("*"), $start, $resultPerPage, array($albumOrderBy, $sortBy), array());


        $template = '
            <div class="label">
                <div class="cover"></div>
                <div class="subLabel detail">
                    <a class="title" href="/userPictureList/{id}"> {title}</a>
                    <p> {descript}</p>
                    <p class="author"><i class="fa fa-user" aria-hidden="true"></i> {author}</p>
                    {editBtn}
                </div>
            </div>
        ';

        $output = "";
        foreach($albumList as $album){ 
            $template_tmp = $template;
            foreach($album as $key => $value){
                $template_tmp = str_replace("{".$key."}", (is_null($value) ? "Aucune information." : ($key == "descript" ? display::truncateText($value): $value)), $template_tmp);
                if(userInfo::isConnected()){
                    if($key=="author"){
                        $template_tmp = str_replace("{editBtn}", (userInfo::isAuthorOrAdmin($value) ? "<a class='btn btn-outline-primary btn-sm mt10' href='/userEditAlbum/".$album["id"]."'><i class='fa-solid fa-edit'></i> Modifier</a>" : "") , $template_tmp);
                    }
                }
            }
            $output .= $template_tmp;
        }

        mcv::addView("albumList");
    }else{ // if any identity card or any result with the filters
        header("HTTP/1.1 404 NOT FOUND");
        mcv::addView("noContent");
    }
?>