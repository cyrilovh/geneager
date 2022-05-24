<?php
    namespace model;

    class ancestor{
        /* return ancestor informations */
        /**
         * Return all data of an ancestor from ID
         *
         * @param integer $id
         * @return array
         */
        static public function get(int $id):array{
            global $db;
            $query = $db->prepare("SELECT * FROM ancestor WHERE id=:id");
            $query->execute(['id' => $id]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            return (!is_array($result) ? array(): $result); // string
            $query->closeCursor();
        }
        /**
         * Return the list of ancestor
         *
         * @param array $filter
         * @param [type] $limit
         * @return array
         */
        static public function getList(array $filter = array("*"), int $limit=NULL, array $order = array("lastUpdate", "ASC") ,):array{
            global $db;
            $filter = implode(",", $filter);

            if(count($order)==2){
                if($order[1]=="DESC"){
                    $order = $order[0]." DESC";
                }else if($order[1]=="ASC"){
                    $order = $order[0]." ASC";
                }else{
                    $order = "lastUpdate DESC";
                }
            }else{
                $order = "lastUpdate DESC";
            }

            $limit = ($limit==NULL) ? "" : ((is_int($limit)) ? "LIMIT ".\class\security::cleanStr($limit) : "");
            $query = $db->prepare("SELECT $filter FROM ancestor ORDER BY $order $limit");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC); // string
            $query->closeCursor(); 
        }
    }
?>