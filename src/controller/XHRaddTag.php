<?php
namespace class;

header('Content-Type: application/json; charset=utf-8');

$json = new json();

$status = new status();
$status->setError();

$json->setStatus($status);
$json->setMessage("Fonctionnalité non implémentée.");

echo $json->getJSON();
?>
