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
                    "before" => "<p class='bold'>Titre:</p>",
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
        }else{
            $msgError = "Cette photo n'existe pas ou plus.";
            mcv::addView("noContent");
        }
    }else{
        $msgError = "Requête invalide.";
        mcv::addView("noContent");
    }
?>