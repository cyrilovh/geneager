<?php
    namespace class;

    /**
     * URL manipulation
     */
    class url{

        /**
         * Remove a parameter with value from URL
         *
         * @param string $url
         * @param string $param
         * @return string
         */
        public static function removeParam(string $url, string $param):string {
            $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
            $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
            return htmlentities($url, ENT_QUOTES, "UTF-8");
        }
    }
?>