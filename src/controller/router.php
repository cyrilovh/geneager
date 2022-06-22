<?php
    namespace class;
    if(str_starts_with(security::cleanStr($_SERVER["REQUEST_URI"]), '/admin') || str_starts_with(security::cleanStr($_SERVER["REQUEST_URI"]), '/user')){ // if URL start with "/admin"
        if(isset($_SESSION["role"])){ // if logged
            if($_SESSION["role"]!="admin"){
                http_response_code(403);
                die("<h1>Vous n'avez pas des droits suffisants pour accéder à cette page.</h1>");
            }

            if(!isset($_SESSION["role"])){ // if logged
                die("<h1>Vous n'avez pas des droits suffisants pour accéder à cette page.</h1>");
            }
        }else{ // if not logged
            header("location: /login");
            exit();
        }
    }


    use model\parameter;


    /* DEFAULT META TAGS */
    $gng_paramList = new parameter();
    $meta_separator = " ".$gng_paramList->get("separator")." "; // default title
    $meta_title = $gng_paramList->get("websiteName"); // default title OR website name
    $meta_description = $gng_paramList->get("defaultDescription"); // default description
    $meta_keyword = $gng_paramList->get("defaultKeywordList"); // default keywords
    $meta_favicon = $gng_paramList->get("favicon"); // favicon PNG (without extension) - Keep blank for the default favicon
    $meta_author = ""; // default author
        
    // here i load only the sub-controller about URL 
    foreach(mcv::load() as $f){
        $explode = explode(":", $f);

        if($explode[0]=="controller"){ // then i load the controller
            include $explode[1];
        }
    }
    


    $obj_MetaTitle = new metaTitle($meta_title, $meta_description, $meta_keyword, $meta_favicon, $meta_author, $meta_robots); // i create my object "meta title"

    $obj_HNF = new customHNF($include_header, $include_navbar, $include_footer); // i create my object for custom header, navbar and footer
    
?>