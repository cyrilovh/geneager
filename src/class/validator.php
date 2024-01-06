<?php
    namespace class;

    /**
    * Static functions to check is a string or other type is valid.
    */
    abstract class validator{

        /**
         * Check if it's an array of array
         *
         * @param [type] $variable
         * @return boolean
         */
        public static function isArrOfArr(mixed $variable):bool {
            return is_array($variable) && count(array_filter($variable, 'is_array')) > 0;
        }


        /**
         * ⚠️ WILL BE DEPRECATED -> POO ⚠️
         * Check if a string (date, time or dateTime) is valid.
         * More informations: https://www.php.net/manual/fr/function.checkdate.php
         *
         * @param mixed $date Date to check
         * @param string $format Date format
         * @return boolean
         */
        public static function isDateTime(mixed $date, string $format = 'Y-m-d H:i:s'):bool
        {
            $d = \DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        /**
         * ⚠️ WILL BE DEPRECATED -> POO ⚠️
         * Check if date exist
         * @param string $date FORMAT: YYYY-MM-DD
         * example: 2018-06-31 returns false (there 30 days in June)
         *  @return boolean
         */
        public static function isDate(string $date):bool{
            $date = explode("-", $date);
            if(count($date) == 3){
                if(checkdate($date[1], $date[2], $date[0])){
                    return true;
                }
            }
            return false;
        }

        /**
         * Check if ID is isset and valid.
         * @return boolean
         */
        public static function isId():bool
        {
            if(isset($_GET["id"])){
                return is_numeric($_GET["id"]);
            }
            return false;
        }

        /**
         * Check if ID is query and valid.
         * @return boolean
         */
        public static function isQuery(int $minlength = 0, int $maxlength = 255):bool
        {
            if(isset($_GET["q"])){
                if(strlen($_GET["q"]) > $minlength && strlen($_GET["q"]) < $maxlength && !empty($_GET["q"])){
                    return !is_null($_GET["q"]);
                }
            }
            return false;
        }

        /**
         * Check if the string is a valid coordinates string (scare)
         * @param string $input FORMAT: X1,Y1,X2,Y2
         * example: 0,0,100,100 returns true
         * example: 100,100,0,0 returns false
         * 
         * @return boolean
         */
        public static function isValidCoordinates($input) {
            // Vérifie le format X1,Y1,X2,Y2
            if (!preg_match('/^\d+,\d+,\d+,\d+$/', $input)) {
                return false;
            }
        
            // Sépare la chaîne en valeurs X et Y
            $coordinates = explode(',', $input);
        
            // Vérifie X1 < X2 et Y1 < Y2
            if ($coordinates[0] >= $coordinates[2] || $coordinates[1] >= $coordinates[3]) {
                return false;
            }
        
            return true;
        }


        /* Currently unused */

        /**
         * Check if the year (MySQL) is valid.
         * example: 2018 returns true
         * example: 50 (2050) returns true
         * example: 70 (1970) returns true
         * @param string $year FORMAT: YYYY
         * @return boolean
         */
        public static function isMySQLYear(string $date):bool{
            $date = explode("-", $date);
            if(count($date) == 3){
                if($date[0] >= 1000 && $date[0] <= 9999){
                    return true;
                }
            }else{
                if($date[0] >= 0 && $date[0] <= 99){
                    return true;
                }
            }
            return false;
        }

        /**
         * Check if it's the string is a MySQL bit string valid.
         * example: 1600 return false
         * example: 0000 return true
         * 
         * @param string $bit MySQL bit string
         * @return boolean
         */
        public static function isMySQLBit(string $bit):bool{
            if(strlen($bit) >= 1 && strlen($bit) <= 64){
                $chars = str_split($bit);
                foreach($chars as $char){
                    if($char != "0" && $char != "1"){
                        return false;
                    }
                }
                return true;
            }
            return false;
        }

        /**
         * Check if it's the string is a MySQL bit string valid.
         *
         * @param string $serial
         * @return boolean
         */
        public static function isMySQLSerial(string $serial):bool{
            if(strlen($serial) >= 1 && strlen($serial) <= 20){
                $chars = str_split($serial);
                foreach($chars as $char){
                    if(!is_int($char)){
                        return false;
                    }
                }
                return true;
            }
            return false;
        }

        /**
         * Check if it's the string is empty or null.
         *
         * @param string $serial
         * @return boolean
         */
        public static function isNullOrEmpty(string|null $str):bool{
            if(is_null($str) || $str == "" || empty($str)){
                return true;
            }
            return false;
        }

        /**
         * Return if the string is empty ONLY (NULL is NOT empty)
         * Used for SQL queries
         * @param string|null $str
         * @return boolean
         */
        public static function isEmpty(string|null $str):bool{
            $str = trim($str);
            if(strlen($str) == 0){
                return true;
            }
            return false;
        }
    }

?>