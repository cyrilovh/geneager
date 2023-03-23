<?php
namespace class;

metaTitle::setTitle("Securité");
metaTitle::setRobot(array("noindex", "nofollow"));

$health = \class\health::status();

$msgWarning = (count($health["warning"]) > 0 ? "<div class='alert alert-warning'>".implode("<br>", $health["warning"])."</div>" : "Aucune anomalie à risque modéré n'a été détectée.");
$msgCritical = (count($health["critical"]) > 0 ? "<div class='alert alert-danger'>".implode("<br>", $health["critical"])."</div>" : "Aucune anomalie à risque critique n'a été détectée.");
$msgInfo = (count($health["info"]) > 0 ? "<div class='alert alert-primary'>".implode("<br>", $health["info"])."</div>" : "Aucune anomalie n'a été détectée.");

mcv::addView("adminHealth");