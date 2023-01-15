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
        if(db::tableExist($table)){ // Check if table exist before
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
    * EXPERIMENTAL METHOD 1
    * Update data in database
    * @param string $table Table to update
    * @param array $columns Columns name only (as value) to update
    * @param array $values Values to update
    * @param string $where Where clause (optional)
    * @return void
    */

    public static function updateData(string $table, array $columns, array $values, string $where = null)
    {
        global $db;

        if(db::columnListExist($table, $columns)){ // Check if all columns exist before
            $table = \class\security::cleanStr($table);
            $query = "UPDATE $table SET ";
            $i = 0;
            foreach ($columns as $column) {
                $column = \class\security::cleanStr($column);
                $query .= "$column = :$column";
                if($i < count($columns) - 1){
                    $query .= ", ";
                }
                $i++;
            }
            if(!is_null($where)){
                $query .= " WHERE $where";
            }
            $query = $db->prepare($query);
            $i = 0;
            foreach ($columns as $column) {
                $column = \class\security::cleanStr($column);
                $query->bindValue(":$column", $values[$i]);
                $i++;
            }
            $query->execute();
            $query->closeCursor();
        }

    }
}
