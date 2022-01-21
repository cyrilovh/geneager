<?php
namespace class;
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
        return preg_replace('/\s+/', ' ', strtolower(trim($str)));
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
            $cleanValue = format::normalize($value);
            $cleanArr[] = $cleanValue;
        }
        // i remove duplicate values
        array_unique($cleanArr);
        return $cleanArr;
    }
    /**
     * Returns the entire all first letters in uppercase from string
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

}
?>