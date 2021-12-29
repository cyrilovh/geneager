<?php
namespace class;
class format{
    // return phone number (Ten character) pair per pair with a dot between
    public static function phone(mixed $n):string{
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/','\1.\2.\3.\4.\5',$n);
    }
    // convert a french phone number to international format
    public static function phoneInternational(mixed $n):string{
        return preg_replace('/^0/', "+33", $n);
    }
    // replace the character "@" by the "@" of font-awesome (spam prevent)
    public static function mailProtect(string $str):string{
        return str_replace("@","<i class='fas fa-at'></i>",$str);
    }
    // convert str to lowercase and remove trim
    public static function normalize(string $str):string{
        return preg_replace('/\s+/', ' ', strtolower(trim($str)));
    }
    // clean values then remove duplicated values
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
    // Returns the entire all first letters in uppercase from string
    public static function htmlToUpperFirst(string $str):string{
        $explode = explode(" ", $str);
        $return = array();
        foreach($explode as $value){
            array_push($return, htmlentities(mb_convert_case(html_entity_decode($value, ENT_QUOTES, "UTF-8"), MB_CASE_TITLE, "UTF-8"), ENT_QUOTES, "UTF-8"));
        }
        return implode(" ", $return);
    }
    // Returns the whole string in upper case
    public static function htmlToUpper(string $str):string{
        return htmlentities(mb_strtoupper(html_entity_decode($str, ENT_QUOTES, "UTF-8")), ENT_QUOTES, "UTF-8");
    }

}
?>