<?php
    namespace model;

    /**
     * Class tag: to manage identification in documents
     */

     class tag{
        /**
         * Get all tags by idPicture (ancestor (id), coordinates, pictureID)
         * @param int $idPicture
         * @return array
         */
        public static function getByIDPicture(int $idPicture):array{
            global $db;
            $query = $db->prepare("SELECT * FROM picturetag WHERE pictureID=:idPicture");
            $query->execute(['idPicture' => $idPicture]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

        public static function getByIDPictureWithIdentity(int $idPicture):array{
            global $db;
            $query = $db->prepare("SELECT picturetag.coordinates, ancestor.id as ancestorID, ancestor.firstNameList, ancestor.lastNameList, ancestor.birthNameList, ancestor.marriedNameList FROM picturetag INNER JOIN ancestor ON picturetag.ancestor = ancestor.id WHERE picturetag.pictureID=:idPicture");
            $query->execute(['idPicture' => $idPicture]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

        /**
         * Check if tag exist for a picture
         * If exist return true, else return false
         *
         * @param integer $idPicture
         * @param integer $idAncestor
         * @return boolean
         */
        public static function checkIfTagExist(int $idPicture, int $idAncestor):bool{
            global $db;
            $query = $db->prepare("SELECT * FROM picturetag WHERE pictureID=:idPicture AND ancestor=:idAncestor");
            $query->execute(['idPicture' => $idPicture, 'idAncestor' => $idAncestor]);
            return $query->rowCount() > 0;
            $query->closeCursor();
        }

        public static function addTag(int $idPicture, int $idAncestor, string $coordinates):bool{
            global $db;
            $query = $db->prepare("INSERT INTO picturetag (pictureID, ancestor, coordinates) VALUES (:idPicture, :idAncestor, :coordinates)");
            $query->execute(['idPicture' => $idPicture, 'idAncestor' => $idAncestor, 'coordinates' => $coordinates]);
            return $query->rowCount() > 0;
            $query->closeCursor();
        }
     }