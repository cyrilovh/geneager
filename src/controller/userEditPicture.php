<?php
    namespace class;
    /* TEST METAS */
    metaTitle::setTitle("Editer une photo");
    $include_footer = "none";

    
    if(userinfo::isAdmin()){
        additionnalJsCss::set("filter.js");
        $adminForm = new form(array("class"=>"filterList"));
        $adminForm->setElement("select", 
            array(
                "name" => "adminMode",
                "class" => "filter",
                "option" => array(
                    "1" => "en tant qu'Administrateur",
                    "0" => "en tant que simple utilisateur"
                ),
                "value" => "1"
                ),
            array(
                "before" => "Editer en tant "
            )
        );

        // check if adminMode is provided: else it's enabled by default
        if(userInfo::adminModeMissing()){
            $redirect = url::addParam(url::current(), "adminMode", "1", false);
            header("Location: $redirect");
            exit();
        }
    }

    if(isset($_GET["filename"])){
        $filename = security::cleanStr($_GET["filename"]);
        $pictureData = \model\picture::getPictureAndAlbumByName($filename);
        if($pictureData){
            if(\class\userInfo::isAuthorOrAdmin($pictureData["authorAlbum"])){
                // VIEW
                mcv::addView("userEditPicture");

                // MY FORM
                $form = new form(
                    array(
                        "action" => "",
                        "method" => "post",
                        "class" => "",
                    ),
                    array(), false
                );

                $form->setElement("input",
                    array(
                        "type" => "text",
                        "name" => "filename",
                        "value" => $filename,
                        "class" => "form-control w100",
                        "disabled" => "disabled"
                    ),
                    array(
                        "before" => "<p class='bold'>Fichier:</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "text",
                        "name" => "create",
                        "value" => format::date($pictureData["createDate"], "d/m/Y à H:i"),
                        "class" => "form-control w100 ",
                        "disabled" => "disabled"
                    ),
                    array(
                        "before" => "<p class='bold'>Date de mise en ligne:</p>",
                        "after" => "<br><br>",
                    )
                );

                $form->setElement("select",
                array(
                    "name" => "folder",
                    "class" => "form-control w100",
                    "required" => "required",
                    "option" => ((userInfo::adminMode()) ? \model\album::getList(array("id", "title"), 0, NULL, array("title", "ASC"), array(), true) : \model\album::getListByAuthor(true)),
                    "value" => $pictureData["folder"]
                ),
                array(
                    "before" => "<p class='bold'>Album:</p>",
                )
                );

                $form->setElement("input",
                    array(
                        "type" => "text",
                        "name" => "title",
                        "maxlength" => "45",
                        "class" => "form-control w100",
                        "required" => "required",
                        "value" => $pictureData["title"],
                        "placeholder" => "45 caractères maximum.",
                    ),
                    array(
                        "before" => "<hr><p class='bold'>Titre:</p>",
                    )
                );

                $form->setElement("textarea",
                    array(
                        "name" => "descript",
                        "maxlength" => "300",
                        "class" => "form-control w100",
                        "rows" => "5",
                        "value" => $pictureData["descript"],
                        "placeholder" => "300 caractères maximum.",
                    ),
                    array(
                        "before" => "<p class='bold'>Description:</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "number",
                        "name" => "dayEvent",
                        "maxlength" => "2",
                        "min" => "1",
                        "max"=> "31",
                        "value" => (is_null($pictureData["dayEvent"]) || $pictureData["dayEvent"]=="0") ? "" : $pictureData["dayEvent"],
                        "placeholder" => "JJ", 
                        "class" => "form-control",
                    ),
                    array(
                        "before" => "<hr><p class='bold'>Date de l'événement:</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "number",
                        "name" => "monthEvent",
                        "maxlength" => "2",
                        "min" => "1",
                        "max"=> "12",
                        "value" => (is_null($pictureData["monthEvent"]) || $pictureData["monthEvent"]=="0") ? "" : $pictureData["monthEvent"], "d/m/Y",
                        "placeholder" => "MM",
                        "class" => "form-control",
                    ),
                );

                $form->setElement("input",
                    array(
                        "type" => "number",
                        "name" => "yearEvent",
                        "maxlength" => "4",
                        "min" => "1000",
                        "max"=> date("Y"),
                        "value" => (is_null($pictureData["yearEvent"]) || $pictureData["yearEvent"]=="0") ? "" : $pictureData["yearEvent"],
                        "placeholder" => "AAAA",
                        "class" => "form-control",
                    ),
                );

                $form->setElement("select", array(
                    "name" => "location",
                    "class" => "form-control w100",
                    "option" => location::cityAsKeyValue(),
                    "value" => $pictureData["location"],
                ),
                array(
                    "before" => "<p class='bold'>Ville:</p>",
                ));

                $form->setElement("textarea",
                    array(
                        "type" => "text",
                        "name" => "accuracyLocation",
                        "class" => "form-control w100",
                        "maxlength" => "100",
                        "value" => is_null($pictureData["accuracyLocation"]) ? "" : $pictureData["accuracyLocation"]
                    ),
                    array(
                        "before" => "<p class='bold'>Précision du lieu:</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "url",
                        "name" => "sourceLink",
                        "class" => "form-control w100",
                        "maxlength" => "2036",
                        "value" => is_null($pictureData["sourceLink"]) ? "" : $pictureData["sourceLink"],
                        "placeholder" => "exemple: http://www.example.com (2036 caractères maximum)"
                    ),
                    array(
                        "before" => "<hr><p class='bold'>Source (URL):</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "text",
                        "name" => "sourceText",
                        "class" => "form-control w100",
                        "maxlength" => "50",
                        "value" => is_null($pictureData["sourceText"]) ? "" : $pictureData["sourceText"],
                        "placeholder" => "50 caractères maxi"
                    ),
                    array(
                        "before" => "<p class='bold'>Source (Texte):</p>",
                    )
                );

                $form->setElement("input",
                    array(
                        "type" => "submit",
                        "name" => "submit",
                        "class" => "mt10 form-control w100 btn btn-primary",
                    )
                );


                // CHECK FORM SUBMIT
                if(isset($_POST["submit"])){
                    if($form->check(true)){ // if the form is not falsified and all the fields are valid
                        if(db::update($form->getData(), "picture", array("filename" => $_GET["filename"]), true)){ // update the data in the database
                            $currentURL = \class\url::current();
                            $msgSuccess = "<p class='mt10 bold uppercase'>Les données ont été mises à jour.<p>";
                            $msgSuccess .= "<p><a class='btn btn-success mt10' href='$currentURL'>&#129152; Retour au formulaire.</a></p>";
                        }else{
                            $msgError = "Une erreur est survenue lors de la mise à jour des données.";
                        }
                    }else{
                        $msgError = $form->check(false);
                    }
                }
            }else{
                $msgError = "Vous n'avez pas les droits pour modifier cette photo.";
                mcv::addView("403");
            }
        }else{
            $msgError = "Cette photo n'existe pas ou plus.";
            mcv::addView("noContent");
        }
    }else{
        $msgError = "Requête invalide.";
        mcv::addView("noContent");
    }
?>