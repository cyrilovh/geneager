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
        public static function dateTime(mixed $date, string $format = 'Y-m-d H:i:s'):bool
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
        public static function dateExist(string $date):bool{
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
    }

?>