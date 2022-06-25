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

    public static function getUsername(){
        return (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
    }
}