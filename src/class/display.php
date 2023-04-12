<?php

namespace class;
/**
 * Advanced formatting methods (project related)
 */
class display{

    /**
     * ⚠️ DEPRECATED ⚠️
     *
     * @param integer $n
     * @return string
     */
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
     * ⚠️ DEPRECATED ⚠️
     * Shortcut to the string (identity of the ancestor)
     * example: Joe Zachary DOE
     * return: Joe Z. DOE
     * @param string $firstNameList
     * @param string $lastNameList
     * @param string $maidenNameList
     * @return string
     */
    public static function truncateIdentity(string|null $firstNameList, string|null $lastNameList, string|null $maidenNameList):string{ // A CONTINUER
        $return = "";

        // first names for start
        if(strlen(format::normalize($firstNameList))>15){
            $firstNameImplode = explode(" ", $firstNameList);
            if(count($firstNameImplode)>0){
                $return = format::htmlToUcfirst($firstNameImplode[0], true);
                if(count($firstNameImplode)>1){
                    for($i=1; $i<count($firstNameImplode); $i++){
                        $return .= " ".substr(format::htmlToUpperFirst($firstNameImplode[$i], true), 0, 1).".";
                    }
                }
            }else{
                $return = "???";
            }
        }else{
            $return = format::htmlToUcfirst($firstNameList, true);
        }

        if(strlen(format::normalize($maidenNameList))==0){
            $return .= " ".format::htmlToUpper($lastNameList);
        }else{
            $return .= format::htmlToUpper(" ".$lastNameList." (".$maidenNameList.")");
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
        if(strlen($string) > $length){
            $string = substr($string, 0, $length);
            $string = substr($string, 0, strrpos($string, " "));
            if($dots && strlen($string) > 0){
                $string .= "...";
            }
        }
        return $string;
    }
}
?>
