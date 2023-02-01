<?php
    namespace class;
    $meta_title = "Liste des photos ".$meta_separator.$meta_title;
    mcv::addView("userPictureList");

    if(validator::isId()){ // i check if ID is provided
        $id = format::normalize($_GET["id"]);
        $btnNewPicture = "<a href='/userNewPicture/?id=$id' class='btn btn-success'><i class='fas fa-plus'></i> Ajouter une photo</a>";
        $data = \model\picture::getList(array("picture.folder" => $id));
    }else{
        $data = \model\picture::getList();
    }

    $template = '
        <tr>
        <td><img src="/photo/{filename}" /></td>
        <td>
            <p class="bold"><i class="fa-solid fa-heading"></i> {title}<p>
            <p><i class="fa-solid fa-align-left"></i> {descript}</p>
            <p title="Création"><i class="fa-solid fa-file-arrow-up"></i> {createDate}</p>
            <p title="Dernière modification"><i class="fa-solid fa-pen-to-square"></i> {lastUpdate}</p>
            <p></p>
        </td>
        <td><a class="btn btn-outline-info btn-sm" href="/userEditPicture/?filename={filename}"><i class="fa-solid fa-pen" title="Editer la photo"></i></a> <a class="btn btn-outline-danger btn-sm" href="/userDeletePicture/{id}"><i title="Supprimer la photo" class="fa-solid fa-trash"></i></a> <a href="/pictureDetail/{filename}" class="btn btn-outline-primary btn-sm"><i title="Voir la photo et toutes les informations" class="fas fa-eye"></i></a></td>
    </tr>
    ';

    $output = "";
    foreach($data as $line){
        $template_tmp = $template;
        foreach($line as $key => $value){
            $template_tmp = str_replace("{".$key."}", (is_null($value) ? "Aucune information." : $value), $template_tmp);
        }
        $output .= $template_tmp;
    }
?>