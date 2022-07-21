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