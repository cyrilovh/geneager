<?php
namespace class;

class performance{
    /**
     * Check if OPcache is enabled
     *
     * @return boolean
     */
    public static function opcacheIsEnabled():bool{
        if (function_exists('opcache_get_status')) {
            $opcacheStatus = opcache_get_status();
        
            if ($opcacheStatus && $opcacheStatus['opcache_enabled']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Reset OPcache
     *
     * @return string
     */
    public static function opcacheReset():string{
        if(!self::opcacheIsEnabled()){
            return "OPcache n'est pas disponible.";
        }

        if (function_exists('opcache_reset')) {
            $exec = opcache_reset();
            return ($exec ?  "OPcache a été réinitialisé." : "Une erreur est survenue lors de la réinitialisation d'OPcache.");
        } else {
            return "OPcache_reset n'est pas disponible sur ce serveur.";
        }
    }
}
?>