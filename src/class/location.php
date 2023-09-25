<?php
    namespace class;

    /**
     * Location class = birthplace, event place, ...
     */
    class location{

        private int $id;
        private string $city;
        private string $stateDepartement;
        private string $country;
        private ?string $accuracy = null;

        public function __construct(int $id, ?string $city, ?string $stateDepartement, ?string $country, ?string $accuracy=null)
        {
            $this->id = $id;
            $this->city = $city;
            $this->stateDepartement = $stateDepartement;
            $this->country = $country;
            $this->accuracy = $accuracy;
        }

        /** SELECT OPTION/MODEL */
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