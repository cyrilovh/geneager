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
     * Check if the all type of all data is correct
     * @param string $table Table to check
     * @param array $columns Columns to check columnName => Data
     */
    private static function checkType(string $table, array $data):array
    {
        global $db;

        $return = array(
            "fatal" => false, // if fatal is true, it means that there is a important problem with the data type
            "columnListNotInDB" => array(), // list of columns not in database (not fatal, just a warning)
            "columnListNullOrOversize" => array(), // column list without data where as it's required or data is too long
            "success" => array() // list of the columns with the correct data
        );

        $table = \class\security::cleanStr($table);
        $query = $db->prepare("SHOW COLUMNS FROM $table");
        $query->execute();
        foreach ($query as $row) {

            foreach ($data as $columnName => $value) { // for each data
                $columnName = \class\security::cleanStr($columnName);

                // 1 - I CHECK IF THE COLUMN COME FORM FORM EXIST AND IF CAN'T BE NULL
                if(in_array($columnName, $row['Field'])){ // if column exist
                    if($row['Null'] == 'NO' && $value == null){ // if column can't be null and value is null
                        $return["columnListNullOrOversize"][] = $columnName;
                    }
                }


                if ($row['Field'] == $columnName) { // if it's the good column
                    $type = explode("(", $row['Type']);
                    $type = $type[0];
                    
                    $length = explode(")", explode("(", $row['Type'])[1])[0]; // get the length of the type
                    $length = (strlen($length) == 0) ? 0 : $length;

                     // 2 - IF THE LENGTH IS TOO LONG (BIGGER THAN THE LENGTH OF THE COLUMN IN THE DB)
                    if(strlen($value) > $length){
                        $return["columnListNullOrOversize"][] = $columnName;
                    }

                    // 3 - IF THE LENGHT IS GOOD (maxlenght allowed per type) I CHECK THE TYPE
                    $typeOf = array(
                        "tinyint" => array("is_int", 4),
                        "smallint" => array("is_int", 6),
                        "mediumint" => array("is_int", 9),
                        "int" => array("is_int", 11),
                        "bigint" => array("is_int", 20),
                        "varchar" => array("is_string", 65535),
                        "tinytext" => array("string", 255),
                        "text" => array("is_string", 65535),
                        "mediumtext" => array("is_string", 16777215),
                        "longtext" => array("is_string", 4294967295),
                        "enum" => array("is_string", 65535), // TO CHECK AGAIN TYPE
                        "date" => array("class\\validator::isDate", 10),
                        "datetime" => array("class\\validator::isDateTime", 19),
                        "timestamp" => array("is_int", 19),
                        "time" => array("class\\validator::isTime", 8), // TO CREATE THE METHOD

                    );

                    // verifier que les colonnes qui ne sont pas dans les tableaux columnListNullOrOversize et columnListNotInDB

                }
            }
        }

        $query->closeCursor();
        return $return;
    }


    /**
     * Update data in database from form
     * Check if columns exists before
     * @param string $table table to update
     * @param array $data array associatif (columnName => valueToApply)
     * @return array
     */
    public static function updataData(string $table, array $data): array
    {

        $return = array(
            "status" => false,
            "message" => ""
        );

        $columns = array_keys($data); // i get all columns name
        if (db::columnListExist($table, $columns)) { // I CHECK IF COLUMNS EXISTS (and table too)
            /* 3 - CHECK TYPE FEEL BE GOOD */
            // db::checkType($table, $data);
            /* -4 - UPDATE DATA */
            /* +5 - RETURN ARRAY */
        }
        $return["message"] = "Erreur: une ou des colonnes n'existent pas dans la base de données ou la table n'existe pas.";
        return $return;
    }

    public static function insertData(){

    }

    public static function deleteData(){

    }

}
