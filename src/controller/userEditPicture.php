<?php
    namespace class;
    /* TEST METAS */
    metaTitle::setTitle("Editer une photo");
    $include_footer = "none";

    if(isset($_GET["filename"])){
        $filename = security::cleanStr($_GET["filename"]);
        $pictureData = \model\picture::getByFilename($filename);
        if($pictureData){
            mcv::addView("userEditPicture");

            $form = new form(
                array(
                    "action" => "",
                    "method" => "post",
                    "class" => "",
                )
            );

            $form->setElement("input",
                array(
                    "type" => "text",
                    "name" => "filename",
                    "value" => $filename,
                    "disabled" => "disabled",
                    "class" => "form-control w100",
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
                    "disabled" => "disabled",
                    "class" => "form-control w100",
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
                "option" => array(
                    "0" => "Aucun dossier",
                    "1" => "Dossier 1",
                    "2" => "Dossier 2",
                    "3" => "Dossier 3",
                    "4" => "Dossier 4",
                    "5" => "Dossier 5",
                    "6" => "Dossier 6",
                    "7" => "Dossier 7",
                    "8" => "Dossier 8",
                    "9" => "Dossier 9",
                    "10" => "Dossier 10",
                    "11" => "Dossier 11",
                    "12" => "Dossier 12",
                    "13" => "Dossier 13",
                    "14" => "Dossier 14",
                    "15" => "Dossier 15",
                    "16" => "Dossier 16",
                    "17" => "Dossier 17",
                    "18" => "Dossier 18",
                    "19" => "Dossier 19",
                    "20" => "Dossier 20",
                    "21" => "Dossier 21",
                    "22" => "Dossier 22",
                    "23" => "Dossier 23",
                    "24" => "Dossier 24",
                    "25" => "Dossier 25",
                    "26" => "Dossier 26",
                    "27" => "Dossier 27",
                    "28" => "Dossier 28",
                    "29" => "Dossier 29",
                    "30" => "Dossier 30",
                    "31" => "Dossier 31",
                    "32" => "Dossier 32",
                    "33" => "Dossier 33",
                    "34" => "Dossier 34",
                    "35" => "Dossier 35",
                    "36" => "Dossier 36",
                    "37" => "Dossier 37",
                    "38" => "Dossier 38",
                    "39" => "Dossier 39",
                    "40" => "Dossier 40",
                    "41" => "Dossier 41",
                    "42" => "Dossier 42",
                    "43" => "Dossier 43",
                    "44" => "Dossier 44"
                ),
            ),
            array(
                "before" => "<p class='bold'>Album:</p>",
            )
        );

            $form->setElement("input",
                array(
                    "type" => "text",
                    "name" => "title",
                    "minlength" => "3",
                    "maxlength" => "45",
                    "class" => "form-control w100",
                    "required" => "required"
                ),
                array(
                    "before" => "<hr><p class='bold'>Titre:</p>",
                )
            );

            $form->setElement("textarea",
                array(
                    "name" => "descript",
                    "minlength" => "3",
                    "maxlength" => "300",
                    "class" => "form-control w100",
                    "required" => "required",
                    "rows" => "5"
                ),
                array(
                    "before" => "<p class='bold'>Description:</p>",
                )
            );

            $form->setElement("input",
                array(
                    "type" => "date",
                    "name" => "dateEvent",
                    "class" => "form-control w100",
                    "minlength" => "10",
                    "maxlength" => "10"
                ),
                array(
                    "before" => "<hr><p class='bold'>Date de l'événement:</p>",
                )
            );
            $form->setElement("select", array(
                "name" => "location",
                "class" => "form-control w100",
                "option" => location::cityAsKeyValue()
            ),
            array(
                "before" => "<p class='bold'>Ville:</p>",
            ));

            $form->setElement("textarea",
                array(
                    "type" => "text",
                    "name" => "accuracyLocation",
                    "class" => "form-control w100",
                    "maxlength" => "100"
                ),
                array(
                    "before" => "<p class='bold'>Précision du lieu:</p>",
                )
            );

            $form->setElement("input",
                array(
                    "type" => "url",
                    "name" => "latitude",
                    "class" => "form-control w100",
                    "minlength" => "12",
                    "maxlength" => "2036"
                ),
                array(
                    "before" => "<hr><p class='bold'>Source (URL):</p>",
                )
            );

            $form->setElement("input",
                array(
                    "type" => "url",
                    "name" => "longitude",
                    "class" => "form-control w100",
                    "minlength" => "2",
                    "maxlength" => "50"
                ),
                array(
                    "before" => "<p class='bold'>Source (Texte):</p>",
                )
            );
        }else{
            $msgError = "Cette photo n'existe pas ou plus.";
            mcv::addView("noContent");
        }
    }else{
        $msgError = "Requête invalide.";
        mcv::addView("noContent");
    }
?>