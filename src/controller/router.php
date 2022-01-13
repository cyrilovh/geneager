<?php
    namespace class;

    use model\parameter;


    /*

    doesn't works !!!

    \gng\mcv::filterFileMC("model"); // i load firstly my model (about URL)
    \gng\mcv::filterFileMC("controller"); // then my controller (about URL)
    
    */

    /*
    
        but here it's works !

    */
    /* DEFAULT META TAGS */
    $gng_paramList = new parameter();
    $meta_separator = " ".$gng_paramList->get("separator")." "; // default title
    $meta_title = $gng_paramList->get("websiteName"); // default title OR website name
    $meta_description = $gng_paramList->get("defaultDescription"); // default description
    $meta_keyword = $gng_paramList->get("defaultKeywordList"); // default keywords
    $meta_favicon = $gng_paramList->get("favicon"); // favicon PNG (without extension) - Keep blank for the default favicon
    $meta_author = ""; // default author
        
    // here i load only the "model" about URL 
    foreach(mcv::load() as $f){
        $explode = explode(":", $f);
        // if($explode[0]=="model"){ // first i load the model
        //     include $explode[1];
        // }
        if($explode[0]=="controller"){ // then i load the controller
            include $explode[1];
        }
    }
    


    $obj_MetaTitle = new metaTitle($meta_title, $meta_description, $meta_keyword, $meta_favicon, $meta_author, $meta_robots); // i create my object "meta title"

    $obj_HNF = new customHNF($include_header, $include_navbar, $include_footer); // i create my object for custom header, navbar and footer
    
?>