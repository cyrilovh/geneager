<?php
    namespace class;

    $title = "Performances du site";
    metaTitle::setTitle($title);

    $form = new form(array(
        "action" => "",
        "method" => "post",
        "class" => "form",
    ));

    $form->setElement("input", array(
        "type" => "number",
        "name" => "pictureMaxAge",
        "required" => "required",
        "min" => 10800,
        "maxlength" => 7890000,
        "placeholder" => "Age maximum de mise en cache des images (en secondes):",
        "class" => "w100",
        "value" => $gng_paramList->get("pictureMaxAge")),
        array(
            "before" => "<h2 class='mt10'>Mise en cache:</h2><p>Mise en cache navigateur:<p>",
            "after" => "<p><small class='txt-disabled italic'>10800 secondes (3 heures) à 7890000 secondes (3 mois)</small></p>",
        )
    );


    $form->setElement("input", array(
        "type" => "submit",
        "name" => "submit",
        "value" => "Enregistrer",
        "class" => "btn btn-primary mt10"
    ));


    if(isset($_POST["submit"])){
        if($form->check()){
            if(db::updateParameter($form->getData())){
                $msgSuccess = "<p>Les paramètres ont été mis à jour.</p><a href='".url::current()."' class='btn btn-primary'>OK</a>";
            }else{
                $msgError = "Une erreur est survenue";
            }
        }else{
            $errorList = $form->check(true);
        }
    }

    mcv::addView("userForm");
?>