<?php
namespace class;
/**
 * Class contain basic methods for format strings
 * ⚠️ ALL METHODS "date" WILL BE DEPRECATED (check out POO) ⚠️
 */
class format{
    /**
     * return phone number (Ten character) pair per pair with a dot between
     *
     * @param mixed $n
     * @return string
     */
    public static function phone(mixed $n):string{
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/','\1.\2.\3.\4.\5',$n);
    }
    /**
     * convert a french phone number to international format
     *
     * @param mixed $n
     * @return string
     */
    public static function phoneInternational(mixed $n):string{
        return preg_replace('/^0/', "+33", $n);
    }
    /**
     * replace the character "@" by the "@" of font-awesome (spam prevent)
     *
     * @param string $str
     * @return string
     */
    public static function mailProtect(string $str):string{
        return str_replace("@","<i class='fas fa-at'></i>",$str);
    }
    /**
     * convert str to lowercase and remove trim
     *
     * @param string $str
     * @return string
     */
    public static function normalize(string|null $str):string{
        return (!is_null($str)) ? preg_replace('/\s+/', ' ', strtolower(trim($str))) : "";
    }
    /**
     * clean values (remove whites spaces except between the words) then remove duplicated values
     *
     * @param array $arr
     * @return array
     */
    public static function cleanArr(array $arr):array{
        $cleanArr = [];

        // first i clean all values and insert into new array
        foreach($arr as $key => $value){
            $cleanValue = static::normalize($value);
            $cleanArr[] = $cleanValue;
        }
        // i remove duplicate values
        array_unique($cleanArr);
        return $cleanArr;
    }

    /**
     * Remove a value from an array
     *
     * @param array $arr data array
     * @param string $value value to remove
     * @return array
     */
    public static function removeValueFromArray(array $arr, string $value):array{
        $key = array_search(static::normalize($value), $arr);
        if($key !== false){
            unset($arr[$key]);
        }
        return $arr;
    }

    /**
     * Returns the entire all first letters of all words in uppercase from string
     *
     * @param string $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToUpperFirst(string $str, bool $html = false):string{
        $explode = explode(" ", $str);
        $return = array();
        foreach($explode as $value){
            $value = mb_convert_case(html_entity_decode($value, ENT_QUOTES, ENCODE), MB_CASE_TITLE, ENCODE);
            if($html==true){
                array_push($return, htmlentities($value, ENT_QUOTES, ENCODE));
            }else{
                array_push($return, $value);
            }
        }
        return implode(" ", $return);
    }
    /**
     * Returns the whole string in upper case
     *
     * @param string|null $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToUpper(string|null $str, bool $html = false):string{
        if(validator::isNullOrEmpty($str)){
            return "";
        }
        $str = mb_strtoupper(html_entity_decode($str, ENT_QUOTES, ENCODE));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, ENCODE);
        }
        return $str;
    }

    /**
     * Returns the whole string in lower case
     *
     * @param string|null $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToLower(string|null $str, bool $html = false):string{
        if(validator::isNullOrEmpty($str)){
            return "";
        }
        $str = strtolower(html_entity_decode($str, ENT_QUOTES, ENCODE));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, ENCODE);
        }
        return $str;
    }

    /**
     * Convert the first the letter of the string (only) to uppercase
     *
     * @param string $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToUcfirst(string $str, bool $html = false):string{
        $str = ucfirst(html_entity_decode($str, ENT_QUOTES, ENCODE));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, ENCODE);
        }
        return $str;
    }

    /**
     * Convert timestamp (ms) to date
     */
    public static function date(string $datetime, string $format="d/m/Y"):string{
        $date = new \DateTime($datetime);
        return $date->format($format);
    }

    /**
     * Convert a string YMD format (form DB for example) to date (format: d/m/Y for example) if the string contains 4, 6 or 8 characters
     * 4 characters: year
     * 6 characters: year + month
     * 8 characters: year + month + day
     * 
     * 20221201 => 01 décembre 2022
     */
    public static function strToDate(string|null $strDate):string|null{
        $monthArr = array(
            "01" => "Janvier",
            "02" => "Février",
            "03" => "Mars",
            "04" => "Avril",
            "05" => "Mai",
            "06" => "Juin",
            "07" => "Juillet",
            "08" => "Août",
            "09" => "Septembre",
            "10" => "Octobre",
            "11" => "Novembre",
            "12" => "Décembre"
        );

        if(validator::isStrDate($strDate)){
            if(strlen($strDate)==4){
                return $strDate;
            }elseif(strlen($strDate)==6){
                $year = substr($strDate, 0, 4);
                $month = substr($strDate, 4, 2);
                return $monthArr[$month]." ".$year;
            }elseif(strlen($strDate)==8){
                $year = substr($strDate, 0, 4);
                $month = substr($strDate, 4, 2);
                $day = substr($strDate, 6, 2);
                return $day." ".$monthArr[$month]." ".$year;
            }
        }else{
            return NULL;
        }
    }

    /**
     * Convert a string date Y,M,D to a valid string
     * 1999,0,0 => 1999
     * 1999,12,0 => 199912
     * 1999,12,31 => 19991231
     *
     * @param string|integer|null $year
     * @param string|integer|null $month
     * @param string|integer|null $day
     * @return string
     */
    public static function YMDtoStr(string|int|null $year, string|int|null $month, string|int|null $day, string $separator = ""):string|null{
        $year = (!validator::isNullOrEmpty($year) ? str_pad($year, 4, "0", STR_PAD_LEFT) : "");
        $month = (!validator::isNullOrEmpty($month) ? str_pad($month, 2, "0", STR_PAD_LEFT) : "");
        $day = (!validator::isNullOrEmpty($day) ? str_pad($day, 2, "0", STR_PAD_LEFT) : "");
        return $year.$month.$day;
    }

}
?>