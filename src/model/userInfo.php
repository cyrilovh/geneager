<?php
namespace model;
class userInfo{
    /**
     * Get all user informations
     *
     * @param string $username
     * @param array $filter
     * @return array
     */
    public static function get(string $username, array $filter=array("*")) :array{ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE username=:username");
        $query->execute(['username' => \class\security::cleanStr($username)]);
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
}