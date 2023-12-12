<?php

namespace class;

/**
 * Class template
 * @package class
 */
abstract class template
{
    /**
     * Get the template by name into the template folder
     * The templates are in html and are into the template folder
     * The template system permitt to use the same template for all the pages
     * In general you can include a variable in the template by using {variableName}: the variable will be replaced by the value with str_replace function for example
     * @param string $templateName
     * @return string
     */
    public static function get(string $templateName): string
    {
        $file = SRC_DIR . "template/" . $templateName . ".html";
        if (file_exists($file)) {
            $template = file_get_contents($file);
            return $template;
        } else {
            return "<!-- Template $templateName not found -->";
        }
    }

    /**
     * Replace the variables in the template by the values (adapted for the ancestors template)
     * @param array $data (array of data: from the database)
     * @param string $template (HTML Code)
     * @param bool $advancedReplace
     * @return string
     */
    public static function ancestorReplace(string $template, array $ancestorList, bool $advancedReplace = true): string
    {
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

                $template_tmp = str_replace("{gender}", (!is_null($ancestor["gender"]) ? \enumList\gender::getByID($ancestor["gender"]) : ""), $template_tmp);

                $template_tmp = str_replace("{birthdayY}", (!is_null($ancestor["birthdayY"]) ? '<p class="dates">Né(e) en '.$ancestor["birthdayY"].'</p>' : ""), $template_tmp);

                $template_tmp = str_replace("{identity}", display::truncateIdentity($ancestor["firstNameList"], $ancestor["lastNameList"], $ancestor["marriedNameList"]), $template_tmp);

                $template_tmp = str_replace("{photo}", ($ancestor["photo"]) ? "/picture/ancestor/".$ancestor["photo"]: DEFAULTPICTUREANCESTOR, $template_tmp);

                $template_tmp = str_replace("{".$key."}", (is_null($value) ? "" : $value), $template_tmp); // i put this line at the end because i need to check if the value is null before i put it in the template   

            }
            $output .= $template_tmp;
        }

        return $output;
    }

    /**
     * Replace the variables in the template by the values 
     * WARNING: PRIVATE FUNCTION (use autoreplace method instead)
     *
     * @param string $template HTML template with {variableName}
     * @param array $element Data from array or database
     * @param boolean $editBtn If true, the edit buttons will be displayed
     * @param string $pageEditBtn The page where the edit button will redirect
     * @param string $alternativeText The text that will be displayed if the value is null
     * @return string
     */
    private static function replace(string $template, array $element, bool $editBtn = false, string $pageEditBtn = "404", string $alternativeText = ""):string{
        $template_tmp = $template;

        foreach($element as $key => $value){
            if($editBtn){
                if(userInfo::isConnected()){
                    if(str_contains($key, "author") && isset($element["id"])){
                        $id = $element["id"];
                        $template_tmp = str_replace("{editBtn}", (userInfo::isAuthorOrAdmin($value) ? "<span><a class='btn btn-outline-info btn-sm mt10' href='/userEdit$pageEditBtn/$id'><i class='fa-solid fa-edit'></i></a> <a class='btn btn-outline-danger btn-sm mt10' href='/userDelete$pageEditBtn/$id'><i class='fa-solid fa-trash'></i></a> <a class='btn btn-outline-success btn-sm mt10' href='/userNew$pageEditBtn/$id'><i class='fa-solid fa-plus'></i></a></span>" : "") , $template_tmp);
                        $template_tmp = str_replace("{editBtnAlbum}", (userInfo::isAuthorOrAdmin($value) ? "<span><a class='btn btn-outline-info btn-sm mt10' href='/userEdit$pageEditBtn/$id'><i class='fa-solid fa-edit'></i></a> <a class='btn btn-outline-danger btn-sm mt10' href='/userDelete$pageEditBtn/$id'><i class='fa-solid fa-trash'></i></a> <a class='btn btn-outline-success btn-sm mt10' href='/userNewPicture/$id'><i class='fa-solid fa-plus'></i></a></span>" : "") , $template_tmp);
                        $template_tmp = str_replace("{editBtnPicture}", (userInfo::isAuthorOrAdmin($value) ? "<span><a class='btn btn-outline-info btn-sm mt10' href='/userEdit$pageEditBtn/$id'><i class='fa-solid fa-edit'></i></a> <a class='btn btn-outline-danger btn-sm mt10' href='/userDelete$pageEditBtn/$id'><i class='fa-solid fa-trash'></i></a></span>" : "") , $template_tmp);
                    }
                }else{
                    $template_tmp = str_replace(array("{editBtn}", "{editBtnAlbum}"), "", $template_tmp);
                }
            }
            $template_tmp = str_replace("{".$key."}", (is_null($value) ? $alternativeText : $value ), $template_tmp);
        }
        return $template_tmp;      
    }

    /**
     * Replace automatically the variables in the template by the values 
     *
     * @param string $template HTML template with {variableName}
     * @param array $data Data from object or database (can be array OR array of array)
     * @param boolean $editBtn If true, the edit button will be displayed
     * @param string $pageEditBtn The page where the edit button will redirect
     * @param string $alternativeText The text that will be displayed if the value is null
     * @return string
     */
    public static function autoreplace(string $template, array $data, bool $editBtn = false, string $pageEditBtn = "404", string $alternativeText = "?"):string{
        $output = "";
        if(validator::isArrOfArr($data)){
            foreach($data as $element){
                $output .= self::replace($template, $element, $editBtn, $pageEditBtn, $alternativeText);
            }
        }else{
            $output .= self::replace($template, $data, $editBtn, $pageEditBtn, $alternativeText);
        }

        return $output;
    }
}
