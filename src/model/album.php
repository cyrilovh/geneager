<?php

namespace model;

class 
album{
    public static function getList(array $filter = array("*"), int $start=0 ,int $limit=NULL, array $order = array("lastUpdate", "ASC") , array $where = array()){
        global $db;
        $filter = implode(",", $filter);

        if(count($order)==2){
            if($order[1]=="DESC"){
                $order = $order[0]." DESC";
            }else if($order[1]=="ASC"){
                $order = $order[0]." ASC";
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
        $query = $db->prepare("SELECT $filter FROM picturefolder $whereSQL ORDER BY $order $limitSQL");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC); // string
        $query->closeCursor(); 
    }

    public static function get(int $id){
        global $db;
        $query = $db->prepare("SELECT * FROM picturefolder WHERE id = :id");
        $query->execute(array(
            ":id" => \class\security::cleanStr($id)
        ));
        return $query->fetch(\PDO::FETCH_ASSOC);
        $query->closeCursor();
    }

    public static function set(string $title, string $descript):int{
        global $db;
        $query = $db->prepare("INSERT INTO picturefolder (id, title, descript, author, cover, lastUpdate, createDate) VALUES (:id ,:title, :descript, :author, :cover, :lastUpdate, :lastUpdate)");
        $query->execute(array(
            ":id" => NULL,
            ":title" => \class\security::cleanStr($title),
            ":descript" => \class\security::cleanStr($descript),
            ":author" => $_SESSION["username"],
            ":cover" => NULL,
            ":lastUpdate" => date("Y-m-d H:i:s"),
            ":creationDate" => date("Y-m-d H:i:s")
        ));
        return $db->lastInsertId();
        $query->closeCursor();
    }
}