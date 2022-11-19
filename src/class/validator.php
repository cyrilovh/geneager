<?php
    namespace class;

    /**
    * Static functions to check is a string or other type is valid.
    */
    class validator{
        /**
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
         * Check if date exist
         * @param string $date FORMAT: YYYY-MM-DD
         * example: 2018-06-31 returns false (there 30 days in June)
         * @return boolean
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
         * Check if time exist
         * @param string $time FORMAT: HH:MM:SS
         * example: 25:00:00 returns false (there is no 25 hours in a day)
         * @return boolean
         */
        public static function isTime(string $time):bool{
            $time = explode(":", $time);
            if(count($time) == 3){
                if($time[0] >= 0 && $time[0] <= 23){
                    if($time[1] >= 0 && $time[1] <= 59){
                        if($time[2] >= 0 && $time[2] <= 59){
                            return true;
                        }
                    }
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
    }

?>