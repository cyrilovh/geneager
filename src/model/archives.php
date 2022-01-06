<?php
    namespace model;

    class archive{
        /**
         * Return all informations of an archive
         *
         * @param integer $id
         * @param array $filter
         * @return array
         */
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