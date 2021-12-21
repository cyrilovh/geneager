<?php
namespace gng;
/*
   _____       _______       ____           _____ ______ 
 |  __ \   /\|__   __|/\   |  _ \   /\    / ____|  ____|
 | |  | | /  \  | |  /  \  | |_) | /  \  | (___ | |__   
 | |  | |/ /\ \ | | / /\ \ |  _ < / /\ \  \___ \|  __|  
 | |__| / ____ \| |/ ____ \| |_) / ____ \ ____) | |____ 
 |_____/_/    \_\_/_/    \_\____/_/    \_\_____/|______|                                                   
                                                        
 */
/*
  _       _ _   
 (_)     (_) |  
  _ _ __  _| |_ 
 | | '_ \| | __|
 | | | | | | |_ 
 |_|_| |_|_|\__|
                            
*/
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

/*
                      _ 
                     | |
   ___ _ __ _   _  __| |
  / __| '__| | | |/ _` |
 | (__| |  | |_| | (_| |
  \___|_|   \__,_|\__,_|

  Create
  Read
  Update
  Delete/Drop
                                              
*/

    /* get parameters form database */
    public static function getParameter(string $param = NULL) :mixed{
        global $db;

        if($param!==NULL){ // if the parameter is specified i return the value
            $query = $db->prepare("SELECT * FROM parameter WHERE parameter=:param");
            $query->execute(['param' => $param]);
            return $query->fetch(\PDO::FETCH_ASSOC)["value"]; // string
            $query->closeCursor();
        }else{ // the paramters is not defined (null): i return an array (key => value)
            $return = array();
            $query = $db->query("SELECT * FROM parameter WHERE parameter NOT LIKE 'sn%'");
            
            while($row = $query->fetch(\PDO::FETCH_ASSOC)){
                $return[$row["parameter"]] = $row["value"];
            }
            return $return;
            $query->closeCursor();
        }
    }

    /* get social network links */
    public static function getSocialLink() :mixed{
        global $db;
        $return = array(); // string to return
        $query = $db->query("SELECT * FROM parameter WHERE parameter LIKE 'sn%'"); // i check all line with the parameter start with "sn"
        while($row = $query->fetch(\PDO::FETCH_ASSOC)){ // i do a loop
            $nickname = $row["value"];
            if(trim($nickname)){ // if there is a username (not empty value)
                $v = strtolower(substr($row["parameter"],2)); // i retrieve the value of the row "parameter", then substr (for remove the 2 firsts characters), then i convert to lower case. ex: snFacebook -> facebook
                $return[] = "<i class='fab fa-$v' data-href='https://$v.com/$nickname' data-target='blank' rel='nofollow'></i>"; // i add the value in the array
            }
        }
        if(count($return)>0){ // if there is 1 link or more
            return "<p class='title'>Réseaux sociaux</p><p>".implode(" ", $return)."</p>"; // i return a string
        }
        $query->closeCursor();
    }

    /* get user data informations (1 user only) */
    public static function getUserInfo(string $username, array $filter=array("*")) :array{ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE username=:username");
        $query->execute(['username' => security::cleanStr($username)]);
        if($query->rowCount()>0){
            if(count($filter)==0){ // if i've any result
                if(PROD==false){
                    trigger_error("The array filter can't be empty: try to keep blank the parameter filter or add values inside.", E_USER_ERROR);
                }
                return NULL;
            }else{ // if there 1 column or more i return the value(s) as a string or as an array
                if(count($filter)>1 || $filter[0]=="*"){ // if all columns => i return the data as an array
                    return $query->fetchAll(\PDO::FETCH_ASSOC);
                }else{ // if have 1 column i return the value as string
                    return $query->fetch(\PDO::FETCH_ASSOC)[$filter[0]];  
                }
            }
        }else{
            return array();
        }
        $query->closeCursor();
    }
    
    public static function setUserinfo(int $userID, array $update):string{
        return "hello";
    }
}
?>