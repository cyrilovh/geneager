<?php
namespace model;
class socialLink{
    /**
     * Get all social links form DB
     *
     * @return mixed
     */
    public static function get() :mixed{
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
}
?>