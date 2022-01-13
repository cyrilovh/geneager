<?php
/* automatic loading of classes if necessary */
class autoloader{
    /**
     * Autoloader
     *
     * @return void
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class_name){
        $class_name = str_replace('\\', '/', $class_name);
        require $class_name.".php";
    }
}
?>