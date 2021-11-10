<?php
    \gng\metaTitle::setTitle("Liste des photos"); // i set the title page + separator + website name
    $meta_description = "Retrouvez les photographies de ma famille sur mon site personnel.";

    \gng\additionnalJsCss::set("pictureList.css");
    \gng\additionnalJsCss::set("pictureList.js");
    \gng\mcv::addView("pictureList");
?>