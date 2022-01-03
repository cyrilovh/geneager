<?php
    namespace class;

    if(!isset($_GET["id"])){ // i check if ID is provided
        mcv::addView("404");
    }else{
        if(is_numeric($_GET["id"])){ // i check if it's numeric value
            $id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8"); // we never know
            $ancestor = new ancestor(\model\ancestor::get($id), ""); // i create my new object
            if(count($ancestor->get())!=0){
                metaTitle::setTitle($ancestor->getFullIdentity(false)." — Fiche d'identité"); // i set the title page + separator + website name
                $meta_description = "Découvrez qui était XXXXX grâce à sa fiche d'identité (biographie, documents, photos, ...).";

                additionnalJsCss::set("ancestor.css");
                mcv::addView("ancestor");
            }else{
                mcv::addView("404");
            }
        }else{
            mcv::addView("404");
        }
    }
?>