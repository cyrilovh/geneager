<?php 
    namespace class;
    mcv::addView("home");
    additionnalJsCss::set("ancestorLabel.css");

    $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay"), 0, 6);
?>