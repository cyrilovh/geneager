<?php
    namespace class;

    use class\userInfo;

    class token{

        // A TOKEN CONTAIN encrypted string: username * yyyy-mm-dd hh:mm:ss

        public static function gen():string{
            $token = userInfo::getUsername()." * ".date("Y-m-d H:i:s");
            return \class\security::encrypt($token, PASSWORD_TOKEN);
        }

        public static function check(string $token):bool{
            $tokenClear = \class\security::decrypt($token, PASSWORD_TOKEN); // i decrypt the token
            $returnValue = explode('*', $tokenClear); // i split the token in two parts: username and date
            if(count($returnValue) == 2){ // if the token is invalid
                if(userInfo::getUsername() == trim($returnValue[0])){ // i check if the username is the same
                    if(\class\validator::isDateTime(trim($returnValue[1]))){ // i check if the date is valid
                        $differenceInSeconds = strtotime(date('Y-m-d H:i:s')) - strtotime(trim($returnValue[1])); // i calculate the difference in seconds between the date of the token and the current date
                        $tokenLifetime = TOKEN_LIFETIME * 60; // convert minutes to seconds
                        if($differenceInSeconds <= $tokenLifetime){ // i check if the difference is less than the token lifetime
                            return true;
                        }
                        return false;
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
    }
?>