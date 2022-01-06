<?php
namespace class;
class password extends security{
    /**
     * Hash password (can't decrypt data after)
     *
     * @param string $password
     * @param string $algo
     * @return void
     */
    public static function hash(string $password, string $algo = "ripemd320"){
        global $password_salt;
        $password_time = strval(time());
        $hash = hash($algo, $password_salt.$password_time.$password);
        return $password_time.",".$hash;
    }

    /**
     * Check if the provided password (from form) is the same that in the DB.
     *
     * @param string $data
     * @param string $password
     * @param string $algo
     * @return boolean
     */
    public static function match(string $data, string $password, string $algo = "ripemd320"):bool{ // first parameter come from db (salt,hash) and the second password (clear to compare)
        global $password_salt;
        $password1_time = explode(",",$data)[0]; // salt form $data
        $password1_hash = explode(",",$data)[1]; // password hash form $data

        $password2_hash = hash($algo, $password_salt.$password1_time.$password); // password (2) to compare

        if($password1_hash==$password2_hash){ // check if hash is same
            return true;
        }else{
            return false;
        }
    }

    /**
     * Generate random password (8 to 10 characters)
     *
     * @return void
     */
    public static function gen(){
        $length = rand(8,10); // password length
        
        $data = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcefghjkmnpqrstuvwxyz'; // 0oO are excludes
        return substr(str_shuffle($data), 0, $length);
    }
}
?>