<?php
namespace class;
// initialize the  connection to datbase
class db{
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
}
?>