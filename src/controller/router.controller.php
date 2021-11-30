<?php
    /* DEFAULT META TAGS */
    $parametersFromDB = \gng\db::getParameter();
    $meta_separator = " ".$parametersFromDB["separator"]." "; // default title
    $meta_title = $parametersFromDB["websiteName"]; // default title OR website name
    $meta_description = $parametersFromDB["defaultDescription"]; // default description
    $meta_keyword = $parametersFromDB["defaultKeywordList"]; // default keywords
    $meta_favicon = $parametersFromDB["favicon"]; // favicon PNG (without extension) - Keep blank for the default favicon
    $meta_author = ""; // default author
    /*

    doesn't works !!!

    \gng\mcv::filterFileMC("model"); // i load firstly my model (about URL)
    \gng\mcv::filterFileMC("controller"); // then my controller (about URL)
    
    */

    /*
    
        but here it's works !

    */
    // here i load only the "model" about URL 
    foreach(\gng\mcv::load() as $f){
        $explode = explode(":", $f);
        if($explode[0]=="model"){ // first i load the model
            include $explode[1];
        }
        if($explode[0]=="controller"){ // then i load the controller
            include $explode[1];
        }
    }
    
    $obj_MetaTitle = new \gng\metaTitle($meta_title, $meta_description, $meta_keyword, $meta_favicon, $meta_author, $meta_robots); // i create my object "meta title"

    $obj_HNF = new \gng\customHNF($include_header, $include_navbar, $include_footer); // i create my object for custom header, navbar and footer

    
     require MVC."view/router.view.php";
?>