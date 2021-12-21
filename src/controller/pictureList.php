<?php
    namespace gng;
    metaTitle::setTitle("Liste des photos"); // i set the title page + separator + website name
    $meta_description = "Retrouvez les photographies de ma famille sur mon site personnel.";

    additionnalJsCss::set("pictureList.css");
    additionnalJsCss::set("pictureList.js");
    mcv::addView("pictureList");
?>