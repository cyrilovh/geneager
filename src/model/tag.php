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
            $query = $db->prepare("SELECT picturetag.id, picturetag.coordinates, picturetag.pictureID, ancestor.id as ancestorID, ancestor.firstNameList, ancestor.lastNameList, ancestor.birthNameList, ancestor.marriedNameList FROM picturetag INNER JOIN ancestor ON picturetag.ancestor = ancestor.id WHERE picturetag.pictureID=:idPicture");
            $query->execute(['idPicture' => $idPicture]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
            $query->closeCursor();
        }
     }