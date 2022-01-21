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
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }
        /**
         * Return the list of ancestor
         *
         * @param array $filter
         * @param [type] $limit
         * @return array
         */
        static public function getList(array $filter = array("*"), int $limit=NULL):array{
            global $db;
            $filter = implode(",", $filter);
            $limit = ($limit==NULL) ? "" : ((is_int($limit)) ? "LIMIT ".\class\security::cleanStr($limit) : "");
            $query = $db->prepare("SELECT $filter FROM ancestor $limit");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC); // string
            $query->closeCursor(); 
        }
    }
?>