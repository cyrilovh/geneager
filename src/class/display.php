<?php

namespace class;
/**
 * Advanced formatting methods (project related)
 */
class display{
    public static function gender(bool|null $n):string{
        if(!is_null($n)){
            switch($n){
                case 1:
                    return "Homme";
                    break;
                case 0:
                    return "Femme";
                    break;
                default:
                    (PROD!==false) ? trigger_error("<p class='dev_critical txt-center'>Internal error: The parameter \$n must me an integer boolean (0 or 1)</p>", E_USER_ERROR) : "";
                    return "???";
                    break;
            }
        }else{
            return "???";
        }

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
    // A CONTINUER
    // A CONTINUER
    // A CONTINUER
    // A CONTINUER
    // A CONTINUER
    // CONCACT A AMELIORER
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
}
?>
