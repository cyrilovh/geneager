<?php
    namespace class;

    /**
     * Location class = birthplace, event place, ...
     */
    class location{

        private ?int $id = 0;
        private ?string $city;
        private ?string $stateDepartement;
        private ?string $country;
        private ?string $accuracy = null;

        public function __construct()
        {
            $this->id = null;
            $this->city = null;
            $this->stateDepartement = null;
            $this->country = null;
            $this->accuracy = null;
        }

        public function getAll(){
            return [
                "id" => $this->id,
                "city" => $this->city,
                "stateDepartement" => $this->stateDepartement,
                "country" => $this->country,
                "accuracy" => $this->accuracy
            ];
        }

        public function getID():int{
            return $this->id;
        }

        public function getCity():?string{
            return $this->city;
        }

        public function getStateDepartement():?string{
            return $this->stateDepartement;
        }

        public function getCountry():?string{
            return $this->country;
        }

        public function getAccuracy():?string{
            return $this->accuracy;
        }

        public function setID(int $id):void{
            $this->id = $id;
        }

        public function setCity(?string $city):void{
            $this->city = $city;
        }

        public function setStateDepartement(?string $stateDepartement):void{
            $this->stateDepartement = $stateDepartement;
        }

        public function setCountry(?string $country):void{
            $this->country = $country;
        }

        public function setAccuracy(?string $accuracy):void{
            $this->accuracy = $accuracy;
        }

        /**
         * return the location as string
         *
         * @return string
         */
        public function getString():string{
            $city = (!is_null($this->accuracy)) ? format::htmlToUcfirst($this->accuracy).", ": ""; // i check if the city is null or not (can be null if the city can't be determined by user)
            $city .= (!is_null($this->city)) ? format::htmlToUcfirst($this->city).", ": ""; // i check if the city is null or not (can be null if the city can't be determined by user)
            return $city.format::htmlToUpper($this->stateDepartement." - ".$this->country);
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