<?php

    namespace model;
    class location{
        public static function getLocationList(array $filter = array("city.id", "city.name", "stateDepartement.country", "stateDepartement.name AS stateDepartement"), string $orderBy = "stateDepartement.country, stateDepartement.name, city.name DESC"):array|bool{
            global $db;
            try{
                $filter = implode(",", $filter);
                $query = $db->prepare("SELECT $filter FROM city LEFT JOIN stateDepartement ON city.stateDepartement = stateDepartement.id ORDER BY $orderBy");
                $query->execute();
                return $query->fetchAll(\PDO::FETCH_ASSOC);
                $query->closeCursor();
            }catch(\PDOException $error){
                if(PROD==false){
                    trigger_error("Erreur n°'{$error->getCode()}' : {$error->getMessage()}", E_USER_ERROR);
                }                
                return false;
            }
        }
        
        /**
         * Get location by ID
         * @param int $id ID of location
         * @param bool $accuracy If true, return all data (city, stateDepartement, country)
         * @return array
         */
        public static function getByID(int $id, bool $accuracy = true):array|bool{
            global $db;
            try{
                if($accuracy){
                    $query = $db->prepare("SELECT city.id as cityID, city.name as cityName, stateDepartement.country as country, stateDepartement.name AS stateDepartement FROM city LEFT JOIN stateDepartement ON city.stateDepartement = stateDepartement.id WHERE city.id = :id");
                }else{
                    $query = $db->prepare("SELECT * FROM city WHERE id = :id");
                }
                $query->execute(array(
                    ":id" => $id
                ));
                return $query->fetch(\PDO::FETCH_ASSOC);
                $query->closeCursor();
            }catch(\PDOException $error){
                if(PROD==false){
                    trigger_error("Erreur n°'{$error->getCode()}' : {$error->getMessage()}", E_USER_ERROR);
                }                
                return false;
            }

        }
    }
