<?php
    namespace class;
    metaTitle::setTitle("Liste des photos"); // i set the title page + separator + website name
    $meta_description = "Retrouvez les photographies de ma famille sur mon site personnel.";

    additionnalJsCss::set("albumList.css");
    additionnalJsCss::set("albumList.js");

    $albumList = \model\album::getList(array("*"), 0, 15, array("lastUpdate", "ASC"), array());

    mcv::addView("albumList");
?>