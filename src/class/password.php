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
    public static function hash(string $password, string $algo = DEFAULT_ALGO){
        global $password_salt;
        $password_time = strval(time());
        $hash = hash($algo, $password_salt.$password_time.$password);
        return $password_time.",".$hash;
    }

    /**
     * Check if the provided password (from form) is the same that in the DB.
     *
     * @param string $data password from db
     * @param string $password  password from to compare
     * @param string $algo  algo to use
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
     * @return string
     */
    public static function gen():string{
        $length = rand(8,10); // password length
        
        $data = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcefghjkmnpqrstuvwxyz'; // 0oO are excludes
        return substr(str_shuffle($data), 0, $length);
    }

    /**
     * Check if the password is strong enough
     *
     * @param string $password
     * @param integer $minlength
     * @param integer $maxlength
     * @return boolean
     */
    public static function passwordAllowed(string $password, int $minlength, int $maxlength):bool{
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < $minlength || strlen($password) > $maxlength) {
            return false;
        }else{
            return true;
        }
    }
}
?>