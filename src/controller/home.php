<?php 
    namespace class;
    mcv::addView("home");
    additionnalJsCss::set("ancestorLabel.css");

    $ancestorList = \model\ancestor::getList(array("id", "firstNameList", "lastName", "photo",  "maidenName", "gender", "birthDay", "author"), 0, 6);

    if($ancestorList > 0){
        
        $template = template::get("ancestorCard");

        $output = "";
        foreach($ancestorList as $ancestor){ 
            $template_tmp = $template;
            foreach($ancestor as $key => $value){

                if(userInfo::isConnected()){
                    if($key=="author"){
                        $template_tmp = str_replace("{editBtn}", (userInfo::isAuthorOrAdmin($value) ? "<a class='btn btn-outline-info btn-sm mt10' href='/userEditAncestor/".$ancestor["id"]."'><i class='fa-solid fa-edit'></i></a> <a class='btn btn-outline-danger btn-sm mt10' href='/userDeleteAncestor/".$ancestor["id"]."'><i class='fa-solid fa-trash'></i></a>" : "") , $template_tmp);
                    }
                }else{
                    $template_tmp = str_replace("{editBtn}", "", $template_tmp);
                }

                $template_tmp = str_replace("{gender}", display::gender($ancestor["gender"]), $template_tmp);

                $template_tmp = str_replace("{birthDay}", (!is_null($ancestor["birthDay"]) ? '<p class="dates">Né(e) en '.format::date($ancestor["birthDay"],"Y").'</p>' : ""), $template_tmp);

                $template_tmp = str_replace("{identity}", display::truncateIdentity($ancestor["firstNameList"], $ancestor["lastName"], $ancestor["maidenName"]), $template_tmp);

                $template_tmp = str_replace("{photo}", ($ancestor["photo"]) ? "/ressources/ancestorProfilePicture/".$ancestor["photo"]: "/assets/img/unknownAncestor.webp", $template_tmp);

                $template_tmp = str_replace("{".$key."}", (is_null($value) ? "" : $value), $template_tmp); // i put this line at the end because i need to check if the value is null before i put it in the template   

            }
            $output .= $template_tmp;
        }
    }
?>