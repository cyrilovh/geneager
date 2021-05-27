<?php
    namespace geneager;

    class autoload{

        public static function loadFiles($url){ // CHECK IF FILE EXIST AND INCLUDE IT
            $folder = array("model","controller"); // the view MUST BE include in controller (here we load model firstly then controller)
            foreach($folder as $k => $v){
                $file = MVC.$v."/".$url.".".$v.".php"; // example: ../src/view/accueil.view.php
                if(file_exists($file)){
                    include $file;
                }else{
                    if($v=="controller"){ // if controller don't exist we try to load the view
                        $view = MVC."view/".$url.".view.php";
                        if(file_exists($view)){
                            include $view;
                        }else{
                            echo "oups $view don't exist";
                        }
                    }
                }
            }
        }

        public static function load(){ // FUNCTION AUTOLOAD
            $parts = explode('/', FULLPATH); // parse url
            $url = $parts[1];  // first word after slash
            if($url!=""){ // if not blank
                if (ctype_alnum($url) && $url!="index"){ // if path is alphanumeric string. example: https://abc.xyz/abc -> abc IS GOOD
                    \geneager\autoload::loadFiles($url);
                }else{ // else we return 404 page
                    \geneager\autoload::loadFiles("404");
                }
            }else{
                echo \geneager\autoload::loadFiles("home");
            }
        }

    }
?>