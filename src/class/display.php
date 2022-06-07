<?php

namespace class;
/**
 * Advanced formatting methods (project related)
 */
class display{
    public static function gender(int $n):string{
        $gender = "???";
        if(!is_null($n)){
            foreach(\enumList\gender::array() as $int => $genderTxt){
                if($int == $n){
                    $gender = $genderTxt; 
                }
            }
        }
        return $gender;
    }

    /**
     * Shortcut to the string (identity of the ancestor)
     * example: Joe Zachary DOE
     * return: Joe Z. DOE
     * @param string $firstNameList
     * @param string $lastName
     * @param string $maidenName
     * @return void
     */
    public static function truncateIdentity(string|null $firstNameList, string|null $lastName, string|null $maidenName){ // A CONTINUER
        $return = "";

        // first names for start
        if(strlen(format::normalize($firstNameList))>15){
            $firstNameImplode = explode(" ", $firstNameList);
            if(count($firstNameImplode)>0){
                $return = format::htmlToUcfirst($firstNameImplode[0], true);
                if(count($firstNameImplode)>1){
                    for($i=1; $i<count($firstNameImplode); $i++){
                        $return .= " ".format::htmlToUpperFirst(substr($firstNameImplode[$i], 0, 1), true).".";
                    }
                }
            }else{
                $return = "???";
            }
        }else{
            $return = format::htmlToUcfirst($firstNameList, true);
        }

        if(strlen(format::normalize($maidenName))==0){
            $return .= " ".format::htmlToUpper($lastName);
        }else{
            $return .= format::htmlToUpper(" ".$lastName." (".$maidenName.")");
        }
        
        return $return;
    }

    public static function truncateText(string $string, int $length = 30, bool $dots = true){
        $string = strip_tags($string);
        $string = str_replace("\n", " ", $string);
        $string = str_replace("\r", " ", $string);
        $string = str_replace("\t", " ", $string);
        $string = str_replace("  ", " ", $string);
        $string = trim($string);
        $string = substr($string, 0, $length);
        $string = substr($string, 0, strrpos($string, " "));
        if($dots){
            $string .= "...";
        }
        return $string;
    }
}
?>
