<?php
namespace class;

    
/*****************************************************************************************************

     __  __  _______      __
    |  \/  |/ ____\ \    / /
    | \  / | |     \ \  / / 
    | |\/| | |      \ \/ /  
    | |  | | |____   \  /   
    |_|  |_|\_____|   \/                     

    The PHP class "MCV" is the main class (structure) managing the call of the files and the display.

*****************************************************************************************************/

    /* class mcv = program for include models, (view), controllers about URL */
    class mcv{
        
        /* 1 - FIRST CHECK AND PARSE URL */
        public static function load(){ // FUNCTION mcv
            $parts = explode('/', FULLPATH); // parse url
            $url = $parts[1];  // first word after slash
            if($url!=""){ // if not blank
                if (ctype_alnum($url) && $url!="router"){ // if path is alphanumeric string. example: https://abc.xyz/abc -> abc IS GOOD
                    return mcv::loadFiles($url); // i call the good files
                }else{ // else we return 404 page
                    return mcv::loadFiles("404");
                }
            }else{ // if $url is blank or empty
                return mcv::loadFiles("home"); // if "/" or "/router"
            }
        }

        /* 2 - INCLUDE THE GOOD FILES MCV IN TEMPLATE (BODY) */
        protected static function loadFiles(string $url){ // CHECK IF FILE EXIST AND INCLUDE IT
            global $include_MVC;
            $include_MVC = array();
            $file = MVC."controller/".$url.".php"; // example: ../src/view/accueil.php
            if(file_exists($file)){
                mcv::addModelController($file,"controller"); // add controller in the header
            }else{
                $view = MVC."view/".$url.".php";
                if(file_exists($view)){
                    mcv::addView($url); // if controller don't exist: i add view in main
                }else{
                    mcv::addView("404"); // controller and view are missing or doesn't exist: add view 404 in main
                }
            }
            return $include_MVC;
        }

        // Function for add view file in main
        public static function addView(string $page):void{ // $page must contain filename only without file extensions
            global $include_MVC;
            array_push($include_MVC, "view:".MVC."view/".$page.".php");
        }

        // Function for add Model or Controller files
        public static function addModelController(string $page, string $type):void{ // function for add view file in main
            global $include_MVC;
            array_push($include_MVC, $type.":".$page);
        }
    }
?>