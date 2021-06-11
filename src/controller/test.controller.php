<?php
    /* TEST METAS */
    $meta_title = "My title test";
    $meta_description = "Just a description";
    $meta_keyword = "test, test, test";
    $meta_author = "Paul testeur";
    
    $include_header = "header3";

    /* TEST VIEWS */
    if(1==1){
        \gng\mcv::addView("test");
        /* \gng\mcv::addView("test2"); */
    }

    /* TEST CSS AND JS ADD */

    \gng\additionnalJsCss::set("style2.css");
    \gng\additionnalJsCss::set("monJS.js");


    
 ?>