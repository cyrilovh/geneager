<?php
    $meta_title = "Liste des fiches d'identités ".$meta_separator.$meta_title;
    $meta_description = "Découvrez la liste entière des mes ancêtres !";
    \gng\additionnalJsCss::set("ancestorLabel.css");
    \gng\additionnalJsCss::set("identityList.css");
    \gng\mcv::addView("identityList");
?>