<?php
namespace model;
class parameter{

    public function __construct()
    {
        $this->data = parameter::getDataFromDB();
    }

    public function get(string $str, bool $btnEdit = false):mixed{
        if($btnEdit){
            if(\class\userInfo::isAdmin()){
                return $this->data[$str]." <a class='btn btn-outline-info btn-sm' href='/adminEditParameter/?key=".$str."'><i class='fas fa-pen'></i></a>";
            }
        }
        return $this->data[$str];
    }
    /**
     * Get parameters form database
     *
     * @param [type] $param
     * @return mixed
     */
    private static function getDataFromDB(string $param = NULL) :mixed{
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