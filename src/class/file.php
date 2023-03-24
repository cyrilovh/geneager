<?php 
    namespace class;

    class file{

        /**
         * Upload a file
         * 
         * This method permits to upload a file.
         * This method check:
         * - If the file type is allowed
         * - If the file size is allowed
         * - If the file is not too big
         * - If the file is not empty
         * - If the file feel be valid
         * - If it's a valid image when it's an image
         * - if the pdf feel be valid
         *
         * @param [type] $file
         * @param array $fileCategoryAllowed Types of file to upload (ex: picture, video, document, audio, ...) => Checkout the constant UPLOAD_FILETYPE_ALLOWED in the file config.php
         * @param string $target (folder or subfolder in /private/uploads/)
         * @param boolean $rename Rename the file with a random name
         * @param string|null $newName New name of the file (if $rename is true): if is blank or null the file will be renamed with a random name
         * @param int $maxSize Maximum size of the file to upload (EN: in bytes) (FR: en octets)
         * @param boolean $optimize Optimize the image (if it's an image) => convert to webp format
         * @param bool $ignoreMissingFileError Don't return the error "missing file" if is true
         * @return array
         */
        public static function upload($file, array $fileCategoryAllowed, string $target="", bool $rename = true, string|null $newName="" ,int $maxSizeAllowed = MAX_FILE_SIZE, bool $optimize = true, bool $ignoreMissingFileError = false):array{

            $fileType = UPLOAD_FILETYPE_ALLOWED; // array of allowed file type
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
                                    $fileExtension = format::htmlToLower(pathinfo($file["name"], PATHINFO_EXTENSION));
                                    if(in_array($file["type"], $fileAllowedList) || in_array($fileExtension, $fileAllowedList)){ // in check in array of allowed file if the type is autorised
                                        
                                        if($rename == true){
                                            if(validator::isNullOrEmpty($newName) ){ // if new name is empty
                                                // i rename the file with a random name
                                                $fileNewName = random::uuidv4().date('_Ymd_his').".".$fileExtension; // i set a random name for the file (security reasons)
                                            }else{
                                                // manual rename the file
                                                if(validator::isNullOrEmpty($newName) || $newName == ".".$fileExtension){ // if filename with extension is empty or if the filename and the extension are not the same
                                                    $return["error"][] = "Le nom du fichier est vide.";
                                                }else{
                                                    $fileNewName = security::cleanFilename($newName);
                                                }
                                            }
                                        }else{
                                            if(validator::isNullOrEmpty($file["name"]) || $file["name"] == ".".$fileExtension){ // if filename with extension is empty or if the filename and the extension are not the same
                                                $return["error"][] = "Le nom du fichier est vide.";
                                            }else{
                                                $fileNewName = $file["name"];
                                            }
                                        }
                                        
                                        // CHECK IF IMAGE IS VALID
                                        if(in_array("image/".$fileExtension, $fileType["picture"])){ // i check if it's an image enumerated in the array of allowed file types
                                            if(!exif_imagetype($file["tmp_name"])) {
                                                $return["error"][] = "Image invalide.";
                                            }
                                        }

                                        // CHECK IF PDF FEEL BE VALID
                                        if(in_array("application/".$fileExtension, $fileType["document"])){ // i check if it's a document enumerated in the array of allowed file types
                                            if($fileExtension == "pdf") {
                                                if(file::readFileContent($file["tmp_name"])){
                                                    $returnValue = substr(file::readFileContent($file["tmp_name"]), 0, 7);
                                                    if($returnValue){
                                                        if($returnValue == "%PDF-1."){
                                                            $returnValue = "pdf";
                                                        }else{
                                                            $return["error"][] = "Le fichier PDF semble être invalide.";
                                                        }
                                                    }
                                                }else{
                                                    $return["error"][] = "Lecture impossible du fichier PDF.";
                                                }
                                            }
                                        }
                                        
                                        // I CONTINUE PROCESS IF NO ERROR
                                        if(count($return["error"]) == 0){ // if there is no error
                                            if(move_uploaded_file($file["tmp_name"], $targetFullPath.$fileNewName)){ // i move the file

                                                if($optimize == true){
                                                    $convertToWebp = file::ConvertToWebP($targetFullPath.$fileNewName);

                                                    // if i can convert the image to webp format: i give the new name of the file converted to webp format
                                                    if(array_key_exists("name", $convertToWebp["file"])){
                                                        $newFileName = $convertToWebp["file"]["name"];
                                                    }
                                                }

                                                // if file converted to another format
                                                $finalFileName = (isset($newFileName)) ? $newFileName : $fileNewName;

                                                $return["file"] = array(
                                                    "originalName" => $file["name"],
                                                    "newName" => $finalFileName, // a continuer car format incorrect
                                                    "size" => $file["size"],
                                                    "type" => $file["type"],
                                                    "path" => UPLOAD_DIR.$target,
                                                    "messageList" => (isset($convertToWebp["file"]["messageList"])) ? $convertToWebp["file"]["messageList"] : array(),
                                                    "warningList" => (isset($convertToWebp["file"]["warningList"])) ? $convertToWebp["file"]["warningList"] : array()
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
                        if($ignoreMissingFileError == false){
                            $return["error"][] = "Pas de fichier envoyé.";
                        }
                    }
                }else{
                    if($ignoreMissingFileError == false){
                        $return["error"][] = "Pas de fichier envoyé.";
                    }
                }
            }else{
                $return["error"][] = "Erreur interne: Le dossier de destination n'est pas accessible en écriture";
            }

            return $return; // CONTAIN ARRAY WITH ERRORS AND NEW FILE NAME, ...
        }


        /**
         * Read the file as text
         * Return false if the file doesn't exist or if the file is not readable
         * Else return data of the file
         *
         * @param string $filename
         * @return string|boolean
         */
        public static function readFileContent(string $filename):string|bool{
            $file = fopen( $filename, "r" );
            
            if( $file == false ) {
               return false;
            }
            
            $filesize = filesize( $filename );
            $filetext = fread( $file, $filesize);
            fclose($file);
            
            return $filetext;
        }

        /**
         * Convert a file (jpeg, jpg, png) to webp
         *
         * @param string $source (full path + filename (with extesnsion))
         * @param integer $quality (0-100)
         * @param $removeOriginal (boolean) if true, the original file will be deleted after the conversion
         * @return array
         */
        public static function ConvertToWebP(string $source, int $quality=QUALITY_FILE_CONVERSION, $removeOriginal = true):array{

            $return = array(
                "file" => array(),
                "messageList" => array(),
                "warningList" => array(),
                "infoList" => array()
            );

            // extract the file name and extension
            $path_parts = pathinfo($source);
            $destination = $path_parts["dirname"]."/".$path_parts["filename"].".webp";
            $extension = $path_parts['extension'];

            // conversioon
            if ($extension == 'jpeg' || $extension == 'jpg'){
                $image = imagecreatefromjpeg($source);
            }elseif ($extension == 'png') {
                $image = imagecreatefrompng($source);
            }elseif ($extension == 'bmp') {
                $image = imagecreatefrombmp($source);
            }else{
                $return["unsupported"] = 1;
            }

            // if any error i continue the process
            if(!isset($return["unsupported"])){

                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);

                // save as webp
                if(imagewebp($image, $destination, $quality)){
                    $return["file"]["fullpath"] = $destination;
                    $return["file"]["name"] = $path_parts["filename"].".webp";

                    $reduce = (filesize($destination) * 100) / filesize($source);

                    if($reduce<100){
                        // if the webp is smaller than the original, we delete the original

                        $reduce_percent = 100 - round($reduce, 2);
                        $return["file"]["messageList"][] = "L'image à été réduite de ".$reduce_percent."%";

                        // remove the original file if the user want
                        if($removeOriginal){
                            if(is_writable($source)){
                                unlink($source);
                                if(file_exists($source)){
                                    $return["file"]["warningList"][] = "Le fichier original n'a pas pu être supprimé.";
                                }            
                            }else{
                                $return["file"]["warningList"][] = "Le fichier original n'a pas pu être supprimé.";
                            }

                        }
                    }else{
                        $return["file"]["infoList"][] = "L'image webp est plus lourde que l'image originale.";
                        // if the webp is bigger than the original, we delete the webp
                        if(!is_writable($destination)){
                            unlink($destination);
                            if(file_exists($destination)){
                                $return["file"]["warningList"][] = "Le fichier webp n'a pas pu être supprimé.";
                            }else{
                                $return["file"]["name"] = $path_parts["filename"].".".$extension;
                            }            
                        }else{
                            $return["file"]["name"] = $path_parts["filename"].".".$extension;
                            $return["file"]["warningList"][] = "Le fichier webp n'a pas pu être supprimé.";
                        }
                    }
    
                }else{
                    $return["file"]["warningList"][] = "Erreur lors de la conversion en webp. Fichier original non supprimé.";
                }
            }
            return $return;
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
                        @chmod($fullPath, 0777);
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