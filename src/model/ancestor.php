<?php
    namespace model;

    class ancestor{
        /* return ancestor informations */
        /**
         * Return all data of an ancestor from ID
         *
         * @param integer $id
         * @return array
         */
        public static function get(int $id):array{
            global $db;
            $query = $db->prepare("SELECT * FROM ancestor WHERE id=:id");
            $query->execute(['id' => $id]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            return (!is_array($result) ? array(): $result); // string
            $query->closeCursor();
        }
        /**
         * Return the list of ancestor
         *
         * @param array $filter name of the mySQL column
         * @param integer $start start of the result list (offset) - ignored if $limit is null or not an integer
         * @param integer $limit number of results (limit)
         * @return array
         */
        public static function getList(array $filter = array("*"), int $start=0 ,int $limit=NULL, array $order = array("lastUpdate", "DESC") , array $where = array()):array{
            global $db;
            $filter = implode(",", $filter);

            if(count($order)==2){
                if(in_array($order[1], \enumList\sortBy::names())){
                    $order = $order[0]." ".$order[1];
                }else{
                    $order = "lastUpdate DESC";
                }
            }else{
                $order = "lastUpdate DESC";
            }

            //$limit = ($limit==NULL) ? "" : ((is_int($limit)) ? "LIMIT ".\class\security::cleanStr($limit) : "");

            if($limit == NULL){ // if limit null
                $limitSQL = "";
            }else{ // if limit is not null
                if(is_int($limit)){ // if limit is an integer
                    $limitSQL = "LIMIT ".\class\security::cleanStr($limit);
                    if($start != NULL){ // if start is not null
                        if(is_int($start)){ // if start is an integer
                            $limitSQL = "LIMIT ".\class\security::cleanStr($start).", ".\class\security::cleanStr($limit); 
                        }
                    }
                }else{
                    $limitSQL = "";
                }
            }
            
            $whereSQL = "";
            if(count($where)>0){
                $whereSQL = "WHERE ";
                $i = 0;
                foreach($where as $key => $value){
                    if($i>0){
                        $whereSQL .= "AND ";
                    }
                    $whereSQL .= \class\security::cleanStr($key)." = '".\class\security::cleanStr($value)."' ";
                    $i++;
                }
            }
            $query = $db->prepare("SELECT $filter FROM ancestor $whereSQL ORDER BY $order $limitSQL");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC); // string
            $query->closeCursor(); 
        }
    }
?>