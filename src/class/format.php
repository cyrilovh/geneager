<?php
namespace class;
/**
 * Class contain basic methods for format strings
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
            $value = mb_convert_case(html_entity_decode($value, ENT_QUOTES, "UTF-8"), MB_CASE_TITLE, "UTF-8");
            if($html==true){
                array_push($return, htmlentities($value, ENT_QUOTES, "UTF-8"));
            }else{
                array_push($return, $value);
            }
        }
        return implode(" ", $return);
    }
    /**
     * Returns the whole string in upper case
     *
     * @param string $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToUpper(string $str, bool $html = false):string{
        $str = mb_strtoupper(html_entity_decode($str, ENT_QUOTES, "UTF-8"));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, "UTF-8");
        }
        return $str;
    }

    /**
     * Returns the whole string in lower case
     *
     * @param string $str
     * @param boolean $html
     * @return string
     */
    public static function htmlToLower(string $str, bool $html = false):string{
        $str = strtolower(html_entity_decode($str, ENT_QUOTES, "UTF-8"));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, "UTF-8");
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
        $str = ucfirst(html_entity_decode($str, ENT_QUOTES, "UTF-8"));
        if($html==true){
            $str = htmlentities($str, ENT_QUOTES, "UTF-8");
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
     * 20221201 => 01 décembre2022
     */
    public static function strToDate(string|null $strDate):string{
        $monthArr = array(
            "01" => "janvier",
            "02" => "février",
            "03" => "mars",
            "04" => "avril",
            "05" => "mai",
            "06" => "juin",
            "07" => "juillet",
            "08" => "août",
            "09" => "septembre",
            "10" => "octobre",
            "11" => "novembre",
            "12" => "décembre"
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
            return "--/--/----";
        }
    }

    /**
     * Convert a date to string YMD format
     * @param string $date
     * @return string
     */
    public static function dateToStr(string $date):string{
        if(validator::isDate($date)){
            $date = new \DateTime($date);
            return $date->format("Ymd");
        }else{
            return "";
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
    public static function YMDtoStr(string|int|null $year, string|int|null $month, string|int|null $day):string{
        $year = (!validator::isNullOrEmpty($year) ? str_pad($year, 4, "0", STR_PAD_LEFT) : "");
        $month = (!validator::isNullOrEmpty($month) ? str_pad($month, 2, "0", STR_PAD_LEFT) : "");
        $day = (!validator::isNullOrEmpty($day) ? str_pad($day, 2, "0", STR_PAD_LEFT) : "");
        return $year.$month.$day;
    }

}
?>