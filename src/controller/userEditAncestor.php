<?php
    namespace class;

    additionnalJsCss::set("form.js");
    additionnalJsCss::set("editAncestor.css");
    mcv::addView("userEditAncestor");

    $update = false;
    $title = "Ajouter un ancêtre"; // default title
    $btnSave = "Ajouter"; // default submit button text
    if(isset($_GET["id"]) && !validator::isNullOrEmpty($_GET["id"])) { // i check if id is set and not null or empty
        if(is_numeric($_GET["id"])){ // i check if id is an integer
            $id = $_GET["id"];
            $SQLdata = \model\ancestor::get($id); // i get the ancestor informations
            if(!isset($SQLdata["id"])){ // if the ancestor doesn't exist
                header("location: /userEditAncestor/");
                exit();
            }
            $title = "Modifier la fiche d'un ancêtre";
            $btnSave = "Enregistrer les modifications";
            $update = true;
        }
    }

    metaTitle::setTitle($title); // i set the title page + separator + website name
    metaTitle::setRobot(array("noindex", "nofollow"));

    $ancestorForm = new form(
        array(
            "action" => "",
            "method" => "post",
            "class" => "form",
            "enctype" => "multipart/form-data" // for add file (picture profile)
        ),
        array(),
        false
    );

    $ancestorForm->setElement("input",
        array(
            "type" => "file",
            "name" => "photo",
            "class" => "form-control w100",
            "accept" => implode(",", UPLOAD_FILETYPE_ALLOWED["picture"]),
            "maxsize" => MAX_FILE_SIZE // used by the JS validator (js/form.js)
        ),
        array(
            "before" => "<br><h2>Photo d'identité:</h2><p class='bold'>Fichier:</p>",
            "after" => (isset($SQLdata["photo"]) ? "<div class='bold inline-block'>Fichier actuel:<br><div class='picture-block'><img src='/picture/ancestor/".$SQLdata["photo"]."'><a class='fas fa-trash' title='Supprimer la photo' href='/userDeleteAncestorPicture/".$SQLdata["id"]."'></a></div></div>" : "")
        )
    );


    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "firstNameList",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100",
        "value" => (isset($SQLdata["firstNameList"]) ? $SQLdata["firstNameList"] : "")),
        array(
            "before" => "<h2>&Eacute;tat civil:</h2><p class='bold'>Prénom(s) de l'ancêtre:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "lastName",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100",
        "value" => (isset($SQLdata["lastName"]) ? $SQLdata["lastName"] : "")),
        array(
            "before" => "<p class='bold'>Nom de famille/Nom de jeune fille:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "text",
        "placeholder" => "200 caractères maximum",
        "name" => "maidenNameList",
        "minlength" => 1,
        "maxlength" => 200,
        "class" => "form-control w100",
        "value" => (isset($SQLdata["maidenNameList"]) ? $SQLdata["maidenNameList"] : "")),
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
        "class" => "form-control w100",
        "value" => (isset($SQLdata["nickNameList"]) ? $SQLdata["nickNameList"] : "")),
        array(
            "before" => "<p class='bold'>Surnoms, pseudonymes:</p>",
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
            "before" => "<p class='bold'>Autres nom(s) de famille de l'ancêtre (exemple si né sous un autre nom avant d'avoir été reconnu par le père):</p>",
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
        "placeholder" => "JJ",
        "value" => (isset($SQLdata["birthdayD"]) ? $SQLdata["birthdayD"] : "")),
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
        "placeholder" => "MM",
        "value" => (isset($SQLdata["birthdayM"]) ? $SQLdata["birthdayM"] : ""))
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "birthdayY",
        "class" => "form-control",
        "maxlength" => 4,
        "min" => "1000",
        "max" => date("Y"),
        "placeholder" => "AAAA",
        "value" => (isset($SQLdata["birthdayY"]) ? $SQLdata["birthdayY"] : ""))
    );


    $ancestorForm->setElement("select", array(
        "name" => "birthCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => (isset($SQLdata["birthCity"]) ? $SQLdata["birthCity"] : ""),
    ),
    array(
        "before" => "<p class='bold'>Lieu de naissance:</p>",
    ));

    $ancestorForm->setElement("textarea",
        array(
            "name" => "birthAccuracyLocation",
            "maxlength" => 200,
            "class" => "form-control w100",
            "rows" => 5,
            "placeholder" => "200 caractères maximum",
            "value" => (isset($SQLdata["birthAccuracyLocation"]) ? $SQLdata["birthAccuracyLocation"] : "")
        ),
        array(
            "before" => "<p class='bold'>Précision sur le lieu de naissance:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deathdateD",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "31",
        "placeholder" => "JJ",
        "value" => (isset($SQLdata["deathdateD"]) ? $SQLdata["deathdateD"] : "")),
        array(
            "before" => "<hr><h2>Décés:</h2><p class='bold'>Date de décès:</p>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deathdateM",
        "class" => "form-control",
        "maxlength" => 2,
        "min" => "1",
        "max" => "12",
        "placeholder" => "MM",
        "value" => (isset($SQLdata["deathdateM"]) ? $SQLdata["deathdateM"] : "")),
    );

    $ancestorForm->setElement("input", array(
        "type" => "number",
        "name" => "deathdateY",
        "class" => "form-control",
        "maxlength" => 4,
        "min" => "1000",
        "max" => date("Y"),
        "placeholder" => "AAAA",
        "value" => (isset($SQLdata["deathdateY"]) ? $SQLdata["deathdateY"] : "")),
    );

    $ancestorForm->setElement("select", array(
        "name" => "deathCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => (isset($SQLdata["deathCity"]) ? $SQLdata["deathCity"] : ""),
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
            "value" => (isset($SQLdata["deathAccuracyLocation"]) ? $SQLdata["deathAccuracyLocation"] : "")
        ),
        array(
            "before" => "<p class='bold'>Précision sur le lieu de décès:</p>",
        )
    );

    $ancestorForm->setElement("select", array(
        "name" => "cemeteryCity",
        "class" => "form-control w100",
        "option" => location::cityAsKeyValue(),
        "value" => (isset($SQLdata["cemeteryCity"]) ? $SQLdata["cemeteryCity"] : ""),
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
            "value" => (isset($SQLdata["cemeteryAccuracyLocation"]) ? $SQLdata["cemeteryAccuracyLocation"] : "")
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
            "value" => (isset($SQLdata["biography"]) ? $SQLdata["biography"] : "")
        ),
        array(
            "before" => "<hr><h2>Biographie:</h2>",
        )
    );

    $ancestorForm->setElement("input", array(
        "type" => "submit",
        "name" => "submit",
        "value" => $btnSave,
        "class" => "btn btn-primary form-control w100",
    ));

    if(isset($_POST["submit"])) {
        if($ancestorForm->check()){ // if form is valid
            $theFile = $_FILES["photo"];
            $return = file::upload($theFile, array("picture"), "picture/ancestor/", true, NULL, MAX_FILE_SIZE, true, true);
            if(count($return["error"]) > 0){ // upload success
                $errorList = implode("<br>", $return["error"]);
            }

            if(key_exists("file", $return)){
                if(key_exists("warningList", $return["file"])){
                    if(count($return["file"]["warningList"])>0){
                        $warningList = implode("<br>", $return["file"]["warningList"]);
                    }
                }
            }

            $data = $ancestorForm->getData();
            $data["author"] = userInfo::getUsername();
            if(count($return["error"])==0){
                if(key_exists("file", $return)){
                    $data["photo"] = $return["file"]["newName"];
                    $successMsg = "<p>La photo a été envoyée avec succès !</p>";
                }
            }

            if(!$update){
                if(db::insert($data, "ancestor")){
                    (!isset($successMsg)) ? $successMsg = "" : $successMsg = $successMsg;
                    $successMsg .= "<p>Ancêtre ajouté avec succès !</p>";
                }else{
                    (!isset($errorList)) ? $errorList = "" : $errorList = $errorList;
                    $errorList .= "<p><b>Erreur lors de l'ajout de l'ancêtre !</b></p>";
                }
            }else{
                if(db::update($data, "ancestor", array("id" => $id), true)){
                    (!isset($successMsg)) ? $successMsg = "" : $successMsg = $successMsg;
                    $currentURL = \class\url::current();
                    $successMsg = "<p class='mt10 bold uppercase'>Les données ont été mises à jour.<p>";
                    $successMsg .= "<p><a class='btn btn-success mt10' href='$currentURL'>&#129152; Retour au formulaire.</a></p>";
                }else{
                    (!isset($errorList)) ? $errorList = "" : $errorList = $errorList;
                    $errorList .= "<p><b>Erreur lors de la modification de l'ancêtre !</b></p>";
                }
            }
        }else{
            $errorList = $ancestorForm->check(false);
        }
    }