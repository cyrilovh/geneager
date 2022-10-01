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
     * @param array $columns Columns to check
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
                array_push($columnsListTable, $row['Field']); // i store all columns names from DB in this array  
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
    public static function checkType(string $table, array $data):bool
    {
        global $db;
        $table = \class\security::cleanStr($table);
        $query = $db->prepare("SHOW COLUMNS FROM $table");
        $query->execute();
        foreach ($query as $row) {

            foreach ($data as $columnName => $value) { // for each data
                $columnName = \class\security::cleanStr($columnName);

                // 1 - I CHECK IF THE COLUMN COME FORM FORM EXIST AND IF CAN'T BE NULL
                if(in_array($columnName, $row['Field'])){ // if column exist
                    if($row['Null'] == 'NO' && $value == null){ // if column can't be null and value is null
                        $query->closeCursor();
                        return false;
                    }
                }else{
                    return false;
                }


                if ($row['Field'] == $columnName) { // if it's the good column
                    $type = explode("(", $row['Type']);
                    $type = $type[0];
                    
                    $length = explode(")", explode("(", $row['Type'])[1])[0]; // get the length of the type
                    $length = (strlen($length) == 0) ? 0 : $length;

                     // 2 - IF THE LENGTH IS TOO LONG
                    if(strlen($value) > $length){
                        $query->closeCursor();
                        return false;
                    }


                    // VERIFIER LONGEUR EN FONCTION DU TYPE
                    // VERIFIER LONGEUR EN FONCTION DU TYPE
                    // VERIFIER LONGEUR EN FONCTION DU TYPE
                    // VERIFIER LONGEUR EN FONCTION DU TYPE

                    // ENUM CHECK IF IN LIST
                    // ENUM CHECK IF IN LIST
                    // ENUM CHECK IF IN LIST

                    // CHECK AUTO INCREMENT
                    // CHECK AUTO INCREMENT
                    // CHECK AUTO INCREMENT

                    // 3 - IF THE LENGHT IS GOOD I CHECK THE TYPE
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

                    switch ($type) {
                        case "tinyint":
                            if (!is_int($value)) {
                                $query->closeCursor();
                                return false;
                            }else{
                                if(strlen($value) > 4){
                                    $query->closeCursor();
                                    return false;
                                }
                            }
                            break;
                        case "smallint":
                            if (!is_int($value)) {
                                $query->closeCursor();
                                return false;
                            }else{
                                if(strlen($value) > 6){
                                    $query->closeCursor();
                                    return false;
                                }
                            }
                            break;
                        case "mediumint":
                            if (!is_int($value)) {
                                $query->closeCursor();
                                return false;
                            }else{
                                if(strlen($value) > 9){
                                    $query->closeCursor();
                                    return false;
                                }
                            }
                            break;
                        case "int":
                            if (!is_int($value)) {
                                $query->closeCursor();
                                return false;
                            }else{
                                if(strlen($value) > 11){
                                    $query->closeCursor();
                                    return false;
                                }
                            }
                            break;
                        case "bigint":
                            if (!is_int($value)) {
                                $query->closeCursor();
                                return false;
                            }else{
                                if(strlen($value) > 20){
                                    $query->closeCursor();
                                    return false;
                                }
                            }
                            break;
                        case "varchar":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "text":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "datetime":
                            if (!validator::isDateTime($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "date":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "time":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "float":
                            if (!is_float($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "double":
                            if (!is_float($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "decimal":
                            if (!is_float($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "char":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "blob":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "mediumblob":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "longblob":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "enum":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "set":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        case "year":
                            if (!is_string($value)) {
                                $query->closeCursor();
                                return false;
                            }
                            break;
                        default:
                            $existOrGoodType = true;
                    }
                }
            }
        }

        $query->closeCursor();
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
        if (db::columnListExist($table, $columns)) { // I CHECK IF COLUMNS EXISTS
            // CONTINUE HERE
            // CONTINUE HERE
        }
        $return["message"] = "Erreur: une ou des colonnes n'existent pas dans la base de données ou la table n'existe pas.";
        return $return;


        /* +3 - CHECK TYPE FEEL BE GOOD
        /* -4 - UPDATE DATA */
        /* +5 - RETURN ARRAY */
    }

    public static function insertData(){

    }

    public static function deleteData(){

    }

}
