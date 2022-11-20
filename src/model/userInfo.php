<?php
namespace model;
class userInfo{
    /**
     * Get all users informations (ONLY ADMIN CAN USE THIS METHOD)
     *
     * @param string $username
     * @param array $filter
     * @return array
     */
    public static function getUserList(string $username, array $filter=array("*")) :array|bool{ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").
        
        if(!\class\userInfo::isAdmin()){
            trigger_error("Erreur interne: Accès à la methode suivante refusée: model\userInfo::get().", E_USER_ERROR);
            exit();
        }

        // if method called by admin, we can get all users
        global $db;
        $filter_str = implode(",", $filter);
        $username = \class\security::cleanStr($username);
        if(strlen($username)>0){
            $query = $db->prepare("SELECT $filter_str FROM user WHERE username=:username");
            $query->execute(['username' => $username]);
        }else{
            $query = $db->prepare("SELECT $filter_str FROM user");
            $query->execute();
        }
        return $query->fetch(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }

    /**
     * Get all user informations form username (ANY VISITOR CAN USE THIS METHOD)
     * 
     * @param string $username username to check
     * @param array $filter columns to filter (default: all) exemple: array("id", "username","password").
     */
    public static function getByUsername(string $username, array $filter=array("*")):array|bool{
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE username=:username");
        $query->execute(['username' => \class\security::cleanStr($username)]);
        return $query->fetch(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }
}
