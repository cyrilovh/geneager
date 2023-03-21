<?php
    namespace class;

    metaTitle::setTitle("Ajout un nouveau ancêtre"); // i set the title page + separator + website name
    metaTitle::setRobot(array("noindex", "nofollow"));

    mcv::addView("userNewAncestor");

    $ancestorForm = new form(array(
        "action" => "",
        "method" => "post",
        "class" => "form",
        "enctype" => "multipart/form-data" // for add file (picture profile)
    ));

    $ancestorForm->setElement("input",
        array(
            "type" => "file",
            "name" => "photo",
            "class" => "form-control w100",
            "accept" => implode(",", UPLOAD_FILETYPE_ALLOWED["picture"]),
            "maxsize" => MAX_FILE_SIZE // used by the JS validator (js/form.js)
        ),
        array(
            "before" => "<p class='bold'>Fichier:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "firstNameList",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100"),
        array(
            "before" => "<h2>&Eacute;tat civil:</h2><p class='bold'>Prénom(s) de l'ancêtre:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "birthNameList",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100"),
        array(
            "before" => "<p class='bold'>Nom(s) de famille de l'ancêtre:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "80 caractères maximum",
        "name" => "maidenName",
        "minlength" => 1,
        "maxlength" => 80,
        "class" => "form-control w100"),
        array(
            "before" => "<p class='bold'>Nom(s) marital(s):</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "nickNameList",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100"),
        array(
            "before" => "<p class='bold'>Surnoms, pseudonymes:</p>",
        )
    );

    $ancestorForm->setElement("select", array(
        "name" => "gender",
        "class" => "form-control w100",
        "option" => \enumList\gender::array()),
        array(
            "before" => "<p class='bold'>Genre:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "birthdayD",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "31",
        "placeholder" => "JJ"),
        array(
            "before" => "<hr><h2>Naissance:</h2><p class='bold'>Date de naissance:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "birthdayM",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "12",
        "placeholder" => "MM"),
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "birthdayY",
        "class" => "form-control",
        "maxlength" => 4,
        "min" => "1000",
        "max" => date("Y"),
        "placeholder" => "AAAA"),
    );


    $ancestorForm->setElement("select", array(
        "name" => "birthCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => "",
    ),
    array(
        "before" => "<p class='bold'>Lieu de naissance:</p>",
    ));

    $ancestorForm->setElement("textarea",
        array(
            "name" => "bithAccuracyLocation",
            "maxlength" => 200,
            "class" => "form-control w100",
            "rows" => 5,
            "placeholder" => "200 caractères maximum",
        ),
        array(
            "before" => "<p class='bold'>Précision sur le lieu de naissance:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deaththdayD",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "31",
        "placeholder" => "JJ"),
        array(
            "before" => "<hr><h2>Décés:</h2><p class='bold'>Date de décès:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deathdayM",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "12",
        "placeholder" => "MM"),
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deathdayY",
        "class" => "form-control",
        "maxlength" => 4,
        "min" => "1000",
        "max" => date("Y"),
        "placeholder" => "AAAA"),
    );

    $ancestorForm->setElement("select", array(
        "name" => "deathCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => "",
    ),
    array(
        "before" => "<p class='bold'>Lieu de naissance:</p>",
    ));

    $ancestorForm->setElement("textarea",
        array(
            "name" => "deathAccuracyLocation",
            "maxlength" => 200,
            "class" => "form-control w100",
            "rows" => 5,
            "placeholder" => "200 caractères maximum",
        ),
        array(
            "before" => "<p class='bold'>Précision sur le lieu de décès:</p>",
        )
    );

    $ancestorForm->setElement("select", array(
        "name" => "cemeteryCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => "",
    ),
    array(
        "before" => "<hr><h2>Lieu du défunt:</h2><p class='bold'>Ville:</p>",
    ));

    $ancestorForm->setElement("textarea",
        array(
            "name" => "cemeteryAccuracyLocation",
            "maxlength" => 200,
            "class" => "form-control w100",
            "rows" => 5,
            "placeholder" => "200 caractères maximum",
        ),
        array(
            "before" => "<p class='bold'>Précision sur le lieu où repose le défunt:</p>",
        )
    );

    $ancestorForm->setElement("textarea",
        array(
            "name" => "biography",
            "maxlength" => "5000",
            "class" => "form-control w100",
            "rows" => 5,
            "placeholder" => "5000 caractères maximum",
        ),
        array(
            "before" => "<hr><h2>Biographie:</h2>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "submit",
        "name" => "submit",
        "value" => "Ajouter l&apos;ancêtre",
        "class" => "btn btn-primary form-control w100",
    ));

    if(isset($_POST["submit"])) {
        if($ancestorForm->check()){
            $theFile = $_FILES["fichier"];
            $return = file::upload($theFile, array("picture"), "picture/ancestor/");
    
            if(count($return["error"]) == 0){

            }

        }else{
            $errorList = $ancestorForm->check(false);
        }
    }