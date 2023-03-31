<?php
    namespace class;

use model\socialLink;

    $title = "Paramètres du site";
    metaTitle::setTitle($title);

    $form = new form(array(
        "action" => "",
        "method" => "post",
        "class" => "form",
    ));

    $form->setElement("input", array(
        "type" => "text",
        "name" => "websiteName",
        "required" => "required",
        "minlength" => 3,
        "maxlength" => 45,
        "placeholder" => "Nom du site (3-45 caractères)",
        "class" => "w100",
        "value" => $gng_paramList->get("websiteName")),
        array(
            "before" => "<h2 class='mt10'>Identité du site:</h2><p>Nom du site:<p>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "defaultDescription",
        "required" => "required",
        "minlength" => 10,
        "maxlength" => 200,
        "placeholder" => "Nom du site (10-200 caractères)",
        "class" => "w100",
        "value" => $gng_paramList->get("defaultDescription")),
        array(
            "before" => "<p class='mt10'>Description par défaut des pages:<p>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "defaultKeywordList",
        "required" => "required",
        "minlength" => 3,
        "maxlength" => 200,
        "placeholder" => "Nom du site (3-200 caractères)",
        "class" => "w100",
        "value" => $gng_paramList->get("defaultKeywordList")),
        array(
            "before" => "<p class='mt10'>Description du site:<p>",
            "after" => "<small class='txt-disabled italic'>Recommandation: 10 mots clés maximum séparés de virgules</small>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "aboutText",
        "required" => "required",
        "minlength" => 3,
        "maxlength" => 200,
        "placeholder" => "3-200 caractères",
        "class" => "w100",
        "value" => $gng_paramList->get("aboutText")),
        array(
            "before" => "<p class='mt10'>Texte &laquo; à propos de &raquo;:<p>",
            "after" => "<small class='txt-disabled italic'>Affiché dans le pied de page.</small>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "homeSummary",
        "required" => "required",
        "minlength" => 3,
        "maxlength" => 200,
        "placeholder" => "3-200 caractères",
        "class" => "w100",
        "value" => $gng_paramList->get("homeSummary")),
        array(
            "before" => "<p class='mt10'>Intro de la page d'accueil:<p>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "albumListSummary",
        "required" => "required",
        "minlength" => 3,
        "maxlength" => 200,
        "placeholder" => "3-200 caractères",
        "class" => "w100",
        "value" => $gng_paramList->get("albumListSummary")),
        array(
            "before" => "<p class='mt10'>Intro de la page des albums:<p>",
        )
    );

    $snUsername = socialLink::usernameList();
    $form->setElement("input", array(
        "type" => "text",
        "name" => "snTwitter",
        "minlength" => 4,
        "maxlength" => 15,
        "placeholder" => "Utilisateur Twitter (4-15 caractères)",
        "class" => "w100",
        "value" => $snUsername["snTwitter"]), // use socialLink::get() to get the link
        array(
            "before" => "<h2>Réseaux sociaux</h2><p class='mt10'>Twitter:<p>",
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "snFacebook",
        "minlength" => 2,
        "maxlength" => 50,
        "placeholder" => "Utilisateur Facebook (2-50 caractères)",
        "class" => "w100",
        "value" => $snUsername["snFacebook"]),
        array(
            "before" => "<p class='mt10'>Facebook:<p>"
        )
    );

    $form->setElement("input", array(
        "type" => "text",
        "name" => "snInstagram",
        "minlength" => 2,
        "maxlength" => 50,
        "placeholder" => "Utilisateur Instagram (2-50 caractères)",
        "class" => "w100",
        "value" => $snUsername["snInstagram"]),
        array(
            "before" => "<p class='mt10'>Instagram:<p>"
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