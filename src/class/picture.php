<?php

    namespace class;

    class picture extends file{

        public static function pictureToBase64(string $picture, $path = UPLOAD_DIR_FULLPATH."picture/"){
            $imgData = base64_encode(file_get_contents($path.$picture));
            $src = 'data: '.mime_content_type($path.$picture).';base64,'.$imgData;
            return $src;
        }
    }