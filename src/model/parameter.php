<?php
namespace model;
class parameter{
    /**
     * Get parameters form database
     *
     * @param [type] $param
     * @return mixed
     */
    public static function get(string $param = NULL) :mixed{
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
}
?>