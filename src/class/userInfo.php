<?php
namespace class;

class userInfo{
    
    /**
     * Return user role
     *
     * @return string
     */
    public static function getRole():string{
        return (isset($_SESSION["role"])) ? $_SESSION["role"] : "";
    }

    /**
     * Return user role list as array role => role
     *
     * @return array
     */
    public static function getRoleListArr():array{
        $roleList = array();
        foreach(\model\userInfo::getRoleList() as $k => $role){
            $roleList[$role["name"]] = $role["name"];
        }
        return $roleList;
    }

    /**
     * Return if user connected is a admin
     *
     * @return int
     */
    public static function isAdmin():bool{
        return (isset($_SESSION["role"]) && $_SESSION["role"]=="admin") ? true : false;
    }

    /**
     * Return if user connected is a standart user
     *
     * @return int
     */
    public static function isUser():bool{
        return (isset($_SESSION["role"]) && $_SESSION["role"]=="user") ? true : false;
    }

    public static function isConnected():bool{
        return (isset($_SESSION["role"])) ? true : false;
    }

    /**
     * Return if user is the owner
     *
     * @param string $user username (nickname)
     * @return int
     */
    public static function isAuthor(string $user):bool{
        return (isset($_SESSION["username"]) && $_SESSION["username"]==$user) ? true : false;
    }

    /**
     * Return if user can edit/delete (check if admin or author)
     *
     * @param string $user username (nickname)
     * @return int
     */
    public static function isAuthorOrAdmin(string $user):bool{
        return (isset($_SESSION["username"])) ? ((userinfo::isAuthor($user) || userinfo::isAdmin() ) ? true : false) : false;
    }

    /**
     * Return username if the visitor is connected
     */
    public static function getUsername():string{
        return (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
    }

    /**
     * Return is the admin is connected AND if he have enable admin mode ("filter" for hidde/display shorter or longer list of the albums)
     */
    public static function adminMode():bool{
        if(userinfo::isAdmin()){
            if(isset($_GET["adminMode"])){
                if($_GET["adminMode"]=="1"){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    /**
     * Return if adminMode is missing or invalid
     */
    public static function adminModeMissing():bool{
        return (!isset($_GET["adminMode"]) || (isset($_GET["adminMode"]) && !in_array($_GET["adminMode"], array("0", "1")))) ? true : false;
    }
}