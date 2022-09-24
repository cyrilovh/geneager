<?php
namespace class;
class db{
    /**
     * Initialize the  connection to datbase
     *
     * @return void
     */
    public static function connect(){
        global $db_host;
        global $db_name;
        global $db_user;
        global $bd_password;
        global $db;
        try
        {
            $db = new \PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $bd_password);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // Obligatoire pour la suite
        }catch (\PDOException $error){
            http_response_code(500);
            echo "<p>Erreur n°'{$error->getCode()}</p>";
            die("<p>Erreur : {$error->getMessage()}</p>");
        }
    }

    /**
     * Check if the table exist in database
     *
     * @param string $table Table to check
     * @return boolean true if exist, else false.
     */
    public static function tableExist(string $table):bool{
        global $db;
        $query = $db->prepare("SHOW TABLES LIKE :table");
        $query->execute(array(
            ":table" => \class\security::cleanStr($table)
        ));
        $query->closeCursor();
        return (($query->rowCount() == 0) ? false : true);
    }

    /**
     * Return if all columns exist in table
     * @param string $table Table to check
     * @param array $columns Columns to check
     * @return boolean true if all columns exist, else false.
    */
    public static function columnListExist(string $table, array $columns):bool{
        global $db;
        $table = \class\security::cleanStr($table);
        $query = $db->prepare("SHOW COLUMNS FROM $table");
        $query->execute();


        foreach($columns as $column){
            $column = \class\security::cleanStr($column);
            $exist = false;
            foreach($query as $row){
                if($row['Field'] == $column){
                    $exist = true;
                    break;
                }
            }
            if(!$exist){
                $query->closeCursor();
                return false;
            }
        }
        $query->closeCursor();
        return true;    
    }

    /**
     * Update data in database from form
     * Check if columns exists before
     * @param string $table table to update
     * @param array $data array associatif (columnName => valueToApply)
     * @return array
     */
    public static function updataData(string $table, array $data):array{

        $return = array(
            "status" => false,
            "message" => ""
        );

        if(db::tableExist($table)){ // I CHECK IF TABLE EXIST
            $columns = array_keys($data); // i get all columns name
            if(db::columnListExist($table, $columns)){ // I CHECK IF COLUMNS EXISTS
                // nothing
            }
            $return["message"] = "Un des colonnes n'existent pas dans la base de données.";
            return $return;
        }else{
            $return["message"] = "Erreur: la table n'existe pas";
            return $return;
        }

        /* +3 - CHECK TYPE FEEL BE GOOD
        /* -4 - UPDATE DATA */
        /* +5 - RETURN ARRAY */
        return $return;
    }
}
?>