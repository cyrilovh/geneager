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
        public static function removeParam(string $url, string $param, bool $htmlentities = true):string {
            $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
            $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
            return ($htmlentities) ? htmlentities($url, ENT_QUOTES, "UTF-8") : $url;
        }

        public static function addParam(string $url, string $param, string $value, bool $htmlentities = true):string {
            $url = url::removeParam($url, $param);
            $url .= (strpos($url, '?') === false ? '?' : '&');
            $url .= $param.'='.$value;
            return ($htmlentities) ? htmlentities($url, ENT_QUOTES, "UTF-8") : $url;
        }

        /**
         * Return current URL
         * @param bool $htmlentities Return as HTML entities string (default: false (no htmlentities))
         * @return string
         */
        public static function current(bool $htmlentities = false):string {
            $url = "http";
            if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
                $url .= "s";
            }
            $url .= "://";
            $url .= $_SERVER["SERVER_NAME"];
            $url .= $_SERVER["REQUEST_URI"];
            return ($htmlentities) ? htmlentities($url, ENT_QUOTES, "UTF-8") : $url;
        }

        /**
         * Return if the origin is the same domain (sensitive subdomains)
         * @param string $origin Referer for example (if empty, $_SERVER["HTTP_REFERER"] is used as default if exists)
         * @return bool
         */
        public static function isSameOrigin($urlOrigin =""):bool{
            $urlOrigin = (!empty(security::cleanStr($urlOrigin))) ? parse_url($urlOrigin) : (isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "");
            $domainOrigin = (isset(parse_url($urlOrigin)["host"])) ? parse_url($urlOrigin)["host"] : "";
            $current = parse_url(url::current());
            return ($domainOrigin == $current["host"]) ? true : false;
        }
    }
?>