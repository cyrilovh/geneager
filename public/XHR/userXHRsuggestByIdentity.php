<?php

$include_header = "";
$include_navbar = "";
$include_footer = "";

header('Content-Type: application/json; charset=utf-8');

$sqlData = model\ancestor::suggestByIdentity("pierre");
$output = array();
$count = count($sqlData);
if($count>0){
    $output['status'] = "success";
    $output['message'] = $count." suggestions(s) trouvé(s).";
    $output['data'] = $sqlData;
}else{
    $output['status'] = "error";
    $output['message'] = "Aucune suggestion trouvée.";
    $output['data'] = array();
}

echo json_encode($output, JSON_PRETTY_PRINT);

?>