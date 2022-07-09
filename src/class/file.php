<?php 
    namespace class;

    class file{

        /**
         * Upload a file
         *
         * @param [type] $file
         * @param string $target (folder or subfolder in /private/uploads/)
         * @param array $fileAllowed Types of file to upload (ex: picture, video, document, audio, ...)
         * @param int $maxSize Maximum size of the file to upload (EN: in bytes) (FR: en octets)
         * @param boolean $override force override file if it already exists
         * 
         * @return array
         */
        public static function upload($file, array $fileCategoryAllowed, string $target="", bool $rename = true, int $maxSizeAllowed = MAX_FILE_SIZE, bool $override = true):array{

            $error = []; // array of errors
            $fileType = array(
                "picture" => array("image/png", "image/jpeg", "image/gif"),
                "video" => array("video/mp4", "video/ogg", "video/webm"),
                "audio" => array("audio/mp3", "audio/ogg", "audio/webm"),
                "document" => array("application/pdf"),
            ); // array of file types
            $return = []; // array of the data returned
            $return["error"] = []; // array of errors

            $targetFullPath = UPLOAD_DIR_FULLPATH.$target; // we add the target to the upload directory
        
            $fileAllowedList = []; // array of allowed file types (MIME)
            $extensionAllowedList = []; // array of allowed file extensions

            /* i add into $fileAllowedList the mime allowed */
            foreach($fileCategoryAllowed as $key => $value){ // we loop through the array of allowed file types
                if(array_key_exists($value, $fileType)){ // if the category of document exist
                    $fileAllowedList = array_merge($fileAllowedList, $fileType[$value]); // we add the category of document to the array of allowed file types

                    // i this next loop, i add into $extensionAllowedList the extension allowed for the category of document
                    foreach($fileType[$value] as $key => $value){ // we loop through the array of allowed file types
                        $extensionAllowedList[] = explode("/", $value)[1]; // we get the extension of the file type
                    }
                }else{
                    if(PROD == false){
                        trigger_error("The file type ".$value." is not allowed", E_USER_WARNING);
                    }
                }
            }
            if(file::isWritable($targetFullPath)){ // i check if the target folder is writable
                if(!empty($file)){
                    if(!empty($file["name"])){
                        if(!empty($file["size"])){
                            if($file["size"]<$maxSizeAllowed){
                                if(array_key_exists("error", $file)){
                                    $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
                                    if(in_array($file["type"], $fileAllowedList) || in_array($fileExtension, $fileAllowedList)){ // in check in array of allowed file if the type is autorised
                                        $fileNewName = random::uuidv4().date('_Ymd_his').".".$fileExtension; // i set a random name for the file (security reasons)
                                        
                                        if(in_array("image/".$fileExtension, $fileType["picture"])){ // i check if it's an image enumerated in the array of allowed file types
                                            if(!exif_imagetype($file["tmp_name"])) {
                                                $return["error"][] = "Image invalide.";
                                            }
                                        }
                                        
                                        if(count($return["error"]) == 0){ // if there is no error
                                            if(move_uploaded_file($file["tmp_name"], $targetFullPath.$fileNewName)){ // i move the file
                                                $return["file"] = array(
                                                    "originalName" => $file["name"],
                                                    "newName" => $fileNewName, // a continuer car format incorrect
                                                    "size" => $file["size"],
                                                    "type" => $file["type"],
                                                    "path" => UPLOAD_DIR.$target
                                                );
                                            }else{
                                                $return["error"][] = "Erreur interne lors du transfert du fichier.";
                                            }
                                        }
                                    }else{
                                        $return["error"][] = "Le type de fichier non-autorisé (type MIME ou extension non autorisé).";
                                    }
                                }else{
                                    $return["error"][] = "Error while uploading the file";
                                }
                            }else{
                                $return["error"][] = "File is too big";
                            }
                        }else{
                            $return["error"][] = "Pas de fichier à envoyé ou fichier vide.";
                        }
                    }else{
                        $return["error"][] = "Pas de fichier envoyé.";
                    }
                }else{
                    $return["error"][] = "Pas de fichier envoyé.";
                }
            }else{
                $return["error"][] = "Erreur interne: Le dossier de destination n'est pas accessible en écriture";
            }

            return $return; // CONTAIN ARRAY WITH ERRORS AND NEW FILE NAME, ...
        }

        /**
         * Convert a file (jpeg, jpg, png) to webp
         *
         * @param string $source
         * @param string $destination
         * @param integer $quality (0-100)
         * @return mixed Check again the type of value returned
         */
        public static function ConvertToWebP(string $source, string $destination, int $quality=80):mixed{
            $extension = strtolower(pathinfo($source, PATHINFO_EXTENSION));
            if ($extension == 'jpeg' || $extension == 'jpg'){
                $image = imagecreatefromjpeg($source);
            }elseif ($extension == 'png') {
                $image = imagecreatefrompng($source);
            }
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            return imagewebp($image, $destination, $quality);
        }

        /**
         * Check if a file or folder is writable
         *
         * @param string $fullPath Full path to the file or folder
         * @param boolean $makeItWritable Change chmod to 777 if it's not writable AND if $makeItWritable is true
         * @param boolean $createIfNotExists Create the folder ONLY if it doesn't exist (can't be apply for a file)
         * @return boolean
         */
        public static function isWritable(string $fullPath, bool $makeItWritable = true, bool $createIfNoExist = false):bool{
            if (is_writable($fullPath)) {
                return true;
            } else {
                if(file_exists($fullPath)){ // IF FILE OR FOLDER EXIST
                    if($makeItWritable){ // if $makeItWritable is true, change chmod to 777 and check again
                        chmod($fullPath, 0777);
                        if (is_writable($fullPath)) {
                            return true;
                        }
                    }
                }else{
                    if($createIfNoExist){ // if allow 
                        if (!mkdir($fullPath, 0777, true)) {
                            return false;
                        }
                        if (is_writable($fullPath)) {
                            return true;
                        }
                    }
                }
                echo $fullPath;
                return false;
            }
        }

        public static function isReadable(string $fullPath, bool $makeItWritable):bool{
            if(file_exists($fullPath)){
                if (is_readable($fullPath)) {
                    return true;
                }
            }
            return false;
        }

    }
?>