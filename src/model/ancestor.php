<?php
    namespace model;

    class ancestor{
        /* return ancestor informations */
        static function get(int $id):array{
            global $db;
            $query = $db->prepare("SELECT * FROM ancestor WHERE id=:id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }
    }
?>