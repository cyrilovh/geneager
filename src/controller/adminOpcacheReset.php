<?php

namespace class;   

metaTitle::setTitle("Purge de l'OPCache");

if(!performance::opcacheIsEnabled()){
    $msgError = "OPcache n'est pas disponible.";
}else{
    if(performance::opcacheReset()){
        $msgSuccess = "OPcache a été réinitialisé.";
    }else{
        $msgError = "Une erreur est survenue lors de la réinitialisation d'OPcache.";
    }
}

$link = "<p class='mt10'><a href=\"javascript:history.back()\" class='btn btn-primary'>&lArr; Page précédente</a></p>";

mcv::addView("Opcache");

?>