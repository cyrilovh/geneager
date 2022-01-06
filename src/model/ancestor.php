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
        static function get(int $id):array{
            global $db;
            $query = $db->prepare("SELECT * FROM ancestor WHERE id=:id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }
    }
?>