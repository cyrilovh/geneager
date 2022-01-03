<?php
    namespace model;

    class archive{
        /* return ancestor informations */
        static function get(int $id, array $filter = array("*")):array{
            global $db;
            $filter_str = implode(",", $filter);
            $query = $db->prepare("SELECT $filter_str FROM archive WHERE id=:id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }
    }
?>