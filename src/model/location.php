<?php

    namespace model;
    class location{
        public static function getLocationList(array $filter = array("city.id", "city.name", "stateDepartement.country", "stateDepartement.name AS stateDepartement"), string $orderBy = "stateDepartement.country, stateDepartement.name, city.name DESC"):array{
            global $db;
            $filter = implode(",", $filter);
            $query = $db->prepare("SELECT $filter FROM city LEFT JOIN stateDepartement ON city.stateDepartement = stateDepartement.id ORDER BY $orderBy");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }
    }
