<?php
    namespace model;
    class picture{
        /**
         * Return all informations of a picture
         *
         * @param integer $id
         * @param array $filter
         * @return array
         */
        static function get(int $id, array $filter = array("*")):array{
            global $db;
            $filter_str = implode(",", $filter);
            $query = $db->prepare("SELECT $filter_str FROM picture WHERE id=:id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }

 /**
         * Return the list of pictures
         *
         * @param array $filter name of the mySQL column
         * @param integer $start start of the result list (offset) - ignored if $limit is null or not an integer
         * @param integer $limit number of results (limit)
         * @return array
         */

        public static function getList(array $where = array(), array $filter = array("*"), int $start=0 ,int $limit=NULL, array $order = array("lastUpdate", "ASC")):array{
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
            $query = $db->prepare("SELECT $filter FROM picture $whereSQL ORDER BY $order $limitSQL");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC); // string
            $query->closeCursor(); 
        }


        /**
         * Insert a new picture in the database after uploading it
         *
         * @param array $data
         * @return boolean
         */
        public static function insert(array $data):bool{
            global $db;
            $query = $db->prepare("INSERT INTO picture (id, filename, folder, createDate) VALUES (NULL, :filename, :folder, :createDate)");
            $query->execute(\class\security::cleanArr($data));
            return $query->fetch(\PDO::FETCH_ASSOC); // string
            $query->closeCursor();
        }

        /**
         * Return data of a picture from a file name
         *
         * @param array $data
         * @param array $filter name of the mySQL column
         * @return boolean
         */
        public static function getByFilename(string $filename, array $filter=array("*")):array|bool{
            global $db;
            $filter = implode(",", $filter);

            $query = $db->prepare("SELECT $filter FROM picture WHERE filename=:filename");
            $query->execute(['filename' => $filename]);
            return $query->fetch(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

        /**
         * Check if a picture exist in the database
         */
        public static function fileExistInDatabase(string $filename):bool{
            $result = self::getByFilename($filename);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        /**
         * Get informations of a picture and the album where it is
         * @param int $id id of the picture
         */
        public static function getPictureAndAlbumByID(int $id):array|bool{
            global $db;
            $query = $db->prepare("SELECT picture.*, picturefolder.id as idAlbum, picturefolder.title as titleAlbum, picturefolder.descript as descriptAlbum, picturefolder.author as authorAlbum, picturefolder.cover as coverAlbum, picturefolder.lastUpdate as lastUpdateAlbum, picturefolder.createDate as createDateAlbum, picturefolder.public as publicAlbum FROM picture INNER JOIN picturefolder ON picture.folder = picturefolder.id WHERE picture.id=:id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

        /**
         * Get informations of a picture and the album where it is
         * @param int $filename filename of the picture
         */
        public static function getPictureAndAlbumByName(string $filename):array|bool{
            global $db;
            $query = $db->prepare("SELECT picture.*, picturefolder.id as idAlbum, picturefolder.title as titleAlbum, picturefolder.descript as descriptAlbum, picturefolder.author as authorAlbum, picturefolder.cover as coverAlbum, picturefolder.lastUpdate as lastUpdateAlbum, picturefolder.createDate as createDateAlbum, picturefolder.public as publicAlbum FROM picture INNER JOIN picturefolder ON picture.folder = picturefolder.id WHERE picture.filename=:filename");
            $query->execute(['filename' => $filename]);
            return $query->fetch(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

                /**
         * Get informations of a picture and the album where it is
         * @param int $filename filename of the picture
         */
        public static function getPictureAndAlbumByNameAndLocation(string $filename):array|bool{
            global $db;
            $query = $db->prepare("SELECT picture.*, picturefolder.id as idAlbum, picturefolder.title as titleAlbum, picturefolder.descript as descriptAlbum, picturefolder.author as authorAlbum, picturefolder.cover as coverAlbum, picturefolder.lastUpdate as lastUpdateAlbum, picturefolder.createDate as createDateAlbum, picturefolder.public as publicAlbum, city.id as idCity, city.name as cityName, stateDepartement.id as idStateDepartement, stateDepartement.name as stateDepartementName, stateDepartement.country as country FROM picture INNER JOIN picturefolder ON picture.folder = picturefolder.id LEFT JOIN city ON picture.location = city.id LEFT JOIN stateDepartement ON city.stateDepartement = stateDepartement.id WHERE picture.filename=:filename");
            $query->execute(['filename' => $filename]);
            return $query->fetch(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }
    }
?>