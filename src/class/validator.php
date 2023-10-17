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
        function isArrOfArr($variable) {
            return !empty(array_filter($variable, 'is_array'));
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
         * ⚠️ WILL BE DEPRECATED -> POO ⚠️
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
         * ⚠️ WILL BE DEPRECATED -> POO ⚠️
         * Check if the string (YMD) can be a true date
         * 4 characters: year
         * 6 characters: year + month
         * 8 characters: year + month + day
         * Warning: this metthod use too the method sleft::isTime() to check if the day is valid
         * for example: 20230229 returns false cause 2023 is not a leap year (28 days in February month of 2023)
         */
        public static function isStrDate(string|null $strDate):bool{
            if(is_numeric($strDate)){                
                if(strlen($strDate) == 4){
                    if($strDate >= 1000 && $strDate <= 9999){
                        return true;
                    }
                }elseif(strlen($strDate) == 6){
                    $year = substr($strDate, 0, 4);
                    $month = substr($strDate, 4, 2);
                    if($year >= 1000 && $year <= 9999){
                        if($month >= 1 && $month <= 12){
                            return true;
                        }
                    }
                }elseif(strlen($strDate) == 8){
                    $year = substr($strDate, 0, 4);
                    $month = substr($strDate, 4, 2);
                    $day = substr($strDate, 6, 2);
                    if($year >= 1000 && $year <= 9999){
                        if($month >= 1 && $month <= 12){
                            if($day >= 1 && $day <= 31){
                                if(self::isTime("$year-$month-$day")){
                                    return true;
                                }
                            }
                        }
                    }
                }
                return false;
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
    }

?>