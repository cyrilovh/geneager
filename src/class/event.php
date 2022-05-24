<?php
    namespace class;
    // "Sub" class for timeline
    class event{

       public function __construct(string $icon, string $date, string $accuracyLocation, int $city, string $description){
            $this->icon = $icon; // NULLABLE
            $this->date = $date; // type date. NOT NULL
            $this->accuracyLocation = $accuracyLocation; // any string; NULLABLE
            $this->city = $city; // id city (form DB). NULLABLE
            $this->description = $description; // any string. NULLABLE
        }

        /**
         * Return 
         *
         * @return array
         */
        public function get():array{
            return [
                "icon" => $this->icon,
                "date" => $this->date, // ajouter une méthode de conversion en 01/12/2021
                "dateOrder" => $this->date, // ajouter une méthode de conversion 12/2021 + 20211200 ....
                "accuracyLocation" => $this->accuracyLocation,
                "city" => $this->city,
                "description" => $this->description
            ];
        }

    }
?>