<?php
    namespace class;

    /**
     * Location class = birthplace, event place, ...
     */
    class location{
        public static function cityAsKeyValue(bool $addNull = true):array{
            $list = \model\location::getLocationList();
            $output = array();
            if($addNull){
                $output[NULL] = "--- Sélectionnez dans la liste ---";
            }
            foreach($list as $item){
                $city = (!is_null($item["name"])) ? format::htmlToUcfirst($item["name"]).", ": ""; // i check if the city is null or not (can be null if the city can't be determined by user)
                $output[$item["id"]] = $city.format::htmlToUpper($item["stateDepartement"]." - ".$item["country"]);
            }
            return $output;
        }
    }
?>