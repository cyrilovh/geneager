<?php
namespace class\gng;
    $meta_title = "Liste des fiches d'identités ".$meta_separator.$meta_title;
    $meta_description = "Découvrez la liste entière des mes ancêtres !";
    additionnalJsCss::set("ancestorLabel.css");
    additionnalJsCss::set("identityList.css");
    mcv::addView("identityList");
?>