<?php
    namespace class;

    class random{
        public static function uuidv4():string {
            return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        
                // 16 bits for "time_mid"
                mt_rand( 0, 0xffff ),
        
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand( 0, 0x0fff ) | 0x4000,
        
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand( 0, 0x3fff ) | 0x8000,
        
                // 48 bits for "node"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );
        }

        /**
         * Give a random string of alpha numeric characters (except letters L & O (lower and uppercase) and the number zero ).
         *
         * @param integer $min
         * @param integer $max
         * @return string
         */
        public static function alphaNum(int $min = 4 , int $max = 5):string{
            $max = ($max < $min) ? $min+1 : $max; // If $max is lower than $min, $max is set to $min+1
            $length = rand($min, $max);
            $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++){
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }