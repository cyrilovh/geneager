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
    public static function getUserList(array $filter = array("id", "username", "role", "identity", "signupDate", "banned", "email", "passwordAlgo")) :array|bool{ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").
        
        if(!\class\userInfo::isAdmin()){
            trigger_error("Erreur interne: Accès à la methode suivante refusée: model\userInfo::getUserList().", E_USER_ERROR);
            exit();
        }

        // if method called by admin, we can get all users
        global $db;

        $filter_str = \class\format::removeValueFromArray($filter, "password"); // remove password from filter for security reasons
        $filter_str = implode(",", $filter);

        $query = $db->prepare("SELECT $filter_str FROM user ORDER BY username ASC");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }

    /**
     * Get all users informations
     *
     * @param string $username
     * @param array $filter
     * @return array
     */
    public static function getAdminList():array|bool{
        global $db;

        $query = $db->prepare("SELECT id, username FROM user WHERE role='admin' ORDER BY username ASC");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }

    /**
     * Get all users informations
     *
     * @param string $username
     * @param array $filter
     * @return array
     */
    public static function getUsernameList():array|bool{ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").

        // if method called by admin, we can get all users
        global $db;

        $query = $db->prepare("SELECT id, username FROM user");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
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

    /**
     * Get all user informations form email (ANY VISITOR CAN USE THIS METHOD)
     * 
     * @param string $email email to check
     * @param array $filter columns to filter (default: all) exemple: array("id", "username","password").
     */
    public static function getByEmail(string $email, array $filter=array("*")):array|bool{
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE email=:email");
        $query->execute(['email' => \class\security::cleanStr($email)]);
        return $query->fetch(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }

    /**
     * Get all user informations form id (ANY VISITOR CAN USE THIS METHOD)
     * 
     * @param string $id id to check
     * @param array $filter columns to filter (default: all) exemple: array("id", "username","password").
     */
    public static function getByID(int $id, array $filter=array("*")):array|bool{
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE id=:id");
        $query->execute(['id' => \class\security::cleanStr($id)]);
        return $query->fetch(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }
}
