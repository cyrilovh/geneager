<?php
namespace class;

class health extends security{
    /**
     * Check if the tokens are changed
     *
     * @return array
     */
    private static function checkTokens():array{
        $global_salt_password = "qs--ZU=FxG8eCYCesQ";
        $global_crsf_token = "CHANGE-YOUR-TOK3N";

        $messageList = array("warning" => array(), "critical" => array(), "info" => array());

        if(SALT_PASSWORD == $global_salt_password || validator::isNullOrEmpty(SALT_PASSWORD)){
            array_push($messageList["warning"], "Vous devez changer la clé de chiffrement des mots de passe dans le fichier &laquo; /src/config.php &raquo;.");
        }

        if(PASSWORD_TOKEN == $global_crsf_token){
            array_push($messageList["warning"], "Vous devez changer la valeur du jeton anti-CRSF dans le fichier &laquo; /src/config.php &raquo;.");
        }

        return $messageList;
    }

    /**
     * Check if the site is in production mode
     *
     * @return array
     */
    private static function checkDevMode():array{
        $messageList = array("warning" => array(), "critical" => array(), "info" => array());

        if(PROD == false){
            array_push($messageList["warning"], "Le site en mode production est activé. Remplacez la valeur &laquo; false &raquo; par &laquo; true &raquo; de la superglobale &laquo; PROD &raquo; dans le fichier &laquo; /src/config.php &raquo; si vous êtes ne faites de développement.");
        }

        return $messageList;
    }
    
    /**
     * Check if the setup folder is present: FUNCTION CURRENTLY UNAVAILABLE
     *
     * @return array
     */
    private static function checkSetupFolder():array{
        $messageList = array("warning" => array(), "critical" => array(), "info" => array());

        // if(file_exists(SRC_DIR."view/setup/")){
        //     array_push($messageList["critical"], "Le dossier d'installation est &laquo; ".SRC_DIR."view/setup/ &raquo; toujours présent. Supprimez le pour des raisons de sécurité.");
        // }

        return $messageList;
    }

    private static function password(){
        // check parameter passwordMinLength into database
    }

    public static function status():array{
        $messageList = array();

        $messageList["warning"] = array_merge(self::checkDevMode()["warning"], self::checkTokens()["warning"], self::checkSetupFolder()["warning"]);
        $messageList["critical"] = array_merge(self::checkDevMode()["critical"], self::checkTokens()["critical"], self::checkSetupFolder()["critical"]);
        $messageList["info"] = array_merge(self::checkDevMode()["info"], self::checkTokens()["info"], self::checkSetupFolder()["info"]);

        return $messageList;
    }
}
?>