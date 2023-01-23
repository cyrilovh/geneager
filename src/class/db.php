<?php

namespace class;

class db
{
    /**
     * Initialize the  connection to datbase
     *
     * @return void
     */
    public static function connect()
    {
        global $db_host;
        global $db_name;
        global $db_user;
        global $bd_password;
        global $db;
        try {
            $db = new \PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $bd_password);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // Obligatoire pour la suite
        } catch (\PDOException $error) {
            http_response_code(500);
            echo "<p>Erreur n°'{$error->getCode()}</p>";
            die("<p>Erreur : {$error->getMessage()}</p>");
        }
    }

    /* Currently unused */

    /**
     * Check if the table exist in database
     *
     * @param string $table Table to check
     * @return boolean true if exist, else false.
     */
    public static function tableExist(string $table): bool
    {
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
     * @param array $columns Columns name only (as value) to check
     * @return boolean true if all columns exist, else false.
     */
    public static function columnListExist(string $table, array $columns): bool
    {
        global $db;
        if(static::tableExist($table)){ // Check if table exist before
            $table = \class\security::cleanStr($table);
            $query = $db->prepare("SHOW COLUMNS FROM $table");
            $query->execute();
            
            $columnListTable = array(); // i will store all columns names from DB in this array

            foreach ($query as $row) {
                $columnListTable[] = $row['Field']; // i store all columns names from DB in this array
            }

            foreach ($columns as $column) { // i read all columns names from array provided in parameter of this method
                $column = \class\security::cleanStr($column);
                if(!in_array($column, $columnListTable)){ // if i don't find the column name provided in the array of the parameter of this method in in the table, i return false
                    return false;
                }
            }
            $query->closeCursor();
            return true; // return true if all columns exist
        }
        return false; // return false if table doesn't exist
    }

    /** 
     * Update database from Form for example
     * @param array $data Data to update (key = column name, value = value to update)
     * @param string $tableName Table name to update
     * @param array $where Where condition (key = column name, value = value to check)
     * @param array $ignoreFields Fields to ignore in the update (value = column name)
     */

    public static function update(array $data, string $tableName, array $where, array $ignoreFields,bool $checkLastUpdate = false):bool{
        global $db;

        $tableName = \class\security::cleanStr($tableName);

        if(count($where) > 0 && static::columnListExist($tableName, array_keys($where))){ // i check if there is only one condition in the where array and if all columns exist in the table
            /* ingnored currently */
            $changeLastUpdate = false;
            if($checkLastUpdate){
                if(static::columnListExist($tableName, array("lastUpdate"))){
                    $changeLastUpdate = true;
                }
            }

            // FIRST I CREATE THE QUERY STRING WITH THE PARAMETERS
            $sql = "UPDATE $tableName SET ";
            $i = 0;
            foreach ($data as $key => $value) {
                $key = \class\security::cleanStr($key);
                $value = \class\security::cleanStr($value);
                if(!in_array($key, $ignoreFields)){
                    if($i > 0){
                        $sql .= ", ";
                    }
                    $sql .= "$key = :$key";
                    $i++;
                }
            }

            if(!array_key_exists("lastUpdate", $data) && $changeLastUpdate){
                if($i > 0){
                    $sql .= ", ";
                }
                $sql .= "lastUpdate = :lastUpdate";
            }

            $whereStr = "";
            foreach($where as $key => $value){
                if($whereStr != ""){
                    $whereStr .= " AND ";
                }
                $key = \class\security::cleanStr($key);
                $value = \class\security::cleanStr($value);
                $whereStr .= "$key ='$value'";
            }

            $sql .= " WHERE ".$whereStr;

            $query = $db->prepare($sql);

            // SECOND I BIND THE PARAMETERS
            foreach($data as $key => $value){
                if(!in_array($key, $ignoreFields)){
                    $query->bindValue(":$key", $value);
                }
            }

            if(!array_key_exists("lastUpdate", $data) && $changeLastUpdate){
                $query->bindValue(":lastUpdate", date("Y-m-d H:i:s"));
            }

            // THIRD I EXECUTE THE QUERY
            $query->execute();

            return true;
        }else{
            return false;
        }

    }
}
