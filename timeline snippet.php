<?php
    $timeline = new timeline();
    $timeline->addEvent(new event("icon1", "date1", "accuracyLocation1", 1, "description1"));
    $timeline->addEvent(new event("icon2", "date2", "accuracyLocation2", 2, "description2"));
    $timeline->addEvent(new event("icon3", "date3", "accuracyLocation3", 3, "description3"));

    $timeline->getAsHTML();

?>