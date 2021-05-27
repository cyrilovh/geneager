<?php
    class autoload{
        public static function loadFiles($url){ // check if view, model or controller file exist
            $folder = array("model","controller"); // the view MUST BE include in controller (here we load model firstly then controller)
            foreach($folder as $k => $v){
                $file = MVC.$v."/".$url.".".$v.".php"; // example: ../src/view/accueil.view.php
                if(file_exists($file)){
                    include $file;
                }else{
                    if($v=="controller"){ // if conntroller don't exist we try to load the view
                        $view = MVC."view/".$url.".view.php";
                        if(file_exists($view)){
                            include $view;
                        }
                    }
                }
            }
        }

        public static function load(){ // FUNCTION AUTOLOAD
            $url = ltrim(FULLPATH, '/');
            if (ctype_alnum($url) && $url!="index"){ // if path is alphanumeric string. example: https://abc.xyz/abc -> abc IS GOOD
                autoload::loadFiles($url);
            }else{ // else we return 404 page
                autoload::loadFiles("404");
            }
        }

    }
?>