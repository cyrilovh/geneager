<?php
    namespace gng;

    
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
                    return \gng\mcv::loadFiles($url); // i call the good files
                }else{ // else we return 404 page
                    return \gng\mcv::loadFiles("404");
                }
            }else{ // if $url is blank or empty
                return \gng\mcv::loadFiles("home"); // if "/" or "/router"
            }
        }

        /* 2 - INCLUDE THE GOOD FILES MCV IN TEMPLATE (BODY) */
        public static function loadFiles($url){ // CHECK IF FILE EXIST AND INCLUDE IT
            global $include_MVC;
            $include_MVC = array();
            $folder = array("model","controller"); // the view MUST BE include in controller (here we load model firstly then controller)
            foreach($folder as $k => $v){
                $file = MVC.$v."/".$url.".".$v.".php"; // example: ../src/view/accueil.model.php
                if(file_exists($file)){
                    \gng\mcv::addModelController($file,$v); // add controller or model in the header
                }else{
                    if($v=="controller"){ // if controller don't exist we try to load the view
                        $view = MVC."view/".$url.".view.php";
                        if(file_exists($view)){
                            \gng\mcv::addView($url); // if controller don't exist: i add view in main
                        }else{
                            \gng\mcv::addView("404"); // controller and view are missing or doesn't exist: add view 404 in main
                        }
                    }
                }
            }
            return $include_MVC;
        }

        // Function for filter if it's controller or model
        /*

        doesn't works !!!

        public static function filterFileMC($type){
            foreach(\gng\mcv::load() as $f){
                $explode = explode(":", $f);
                if($explode[0]==$type){ // first i load the model
                    //echo "load $explode[1]";
                    include_once $explode[1];
                }
            }
        }
        */
        // Function for add view file in main
        public static function addView($page){ // $page must contain filename only without file extensions
            global $include_MVC;
            array_push($include_MVC, "view:".MVC."view/".$page.".view.php");
        }

        // Function for add Model or Controller files
        public static function addModelController($page,$type){ // function for add view file in main
            global $include_MVC;
            array_push($include_MVC, $type.":".$page);
        }
    }

/*****************************************************************************************************


            _     _ _ _   _                         _      _      _____         
           | |   | (_) | (_)                       | |    | |    / ____|        
   __ _  __| | __| |_| |_ _  ___  _ __  _ __   __ _| |    | |___| |     ___ ___ 
  / _` |/ _` |/ _` | | __| |/ _ \| '_ \| '_ \ / _` | |_   | / __| |    / __/ __|
 | (_| | (_| | (_| | | |_| | (_) | | | | | | | (_| | | |__| \__ \ |____\__ \__ \
  \__,_|\__,_|\__,_|_|\__|_|\___/|_| |_|_| |_|\__,_|_|\____/|___/\_____|___/___/
                                                                                                                                                                   
    
    class additionnalJsCss: for add additionnals JS and CSS files in template 
    YOU MUST use this class in the controller of YOUR (new) page
    /!\ Every files must separated by a comma

*****************************************************************************************************/
    $include_JsCss = array();
    class additionnalJsCss{
        public static function set($filename){ // filename = name + file extension. example: slide.js
            global $include_JsCss;
            array_push($include_JsCss, $filename);
        }
        public static function get($filter){ // $filter= "css" OR "js"
            global $include_JsCss; // 1 - retrieve list
            $result = "";
            foreach($include_JsCss as $f){ // 2 - foreach file
                $extension = strtolower(array_reverse(explode(".",$f))[0]); // here i retrieve file extension
                $filter = strtolower($filter); // here i convert extension
                if($extension==$filter){ // i check if extension and filter match
                    if($extension=="css"){ // if CSS
                        $result .= "<link rel='Stylesheet' type='text/css' href='/public/asset/$f' />\n";
                    }else if($extension=="js"){ // if JS
                        $result .=  "<script type='text/javascript' src='/public/asset/$f' defer></script>\n";  
                    }else{
                        $result .= "<!-- $f is incorrect -->\n";
                    }
                    
                    // else we ignore
                }
            }
            return $result;
        }
    }

/*****************************************************************************************************

  __  __      _     _______ _ _   _      
 |  \/  |    | |   |__   __(_) | | |     
 | \  / | ___| |_ __ _| |   _| |_| | ___ 
 | |\/| |/ _ \ __/ _` | |  | | __| |/ _ \
 | |  | |  __/ || (_| | |  | | |_| |  __/
 |_|  |_|\___|\__\__,_|_|  |_|\__|_|\___|
                                         
class for change the default title, description, ....
YOU MUST use this class in the controller of YOUR (new) page

*****************************************************************************************************/
  
    class MetaTitle{
        public function __construct($meta_title, $meta_description, $meta_keyword, $meta_author){
            $this->title = $meta_title;
            $this->description = $meta_description;
            $this->keyword = $meta_keyword;
            $this->author = $meta_author;
        }     
        
        public function getData($data){
            return $this->$data;
        }
    }


/*****************************************************************************************************
   _  _____   ____   _____ _______ 
  | ||  __ \ / __ \ / ____|__   __|
 / __) |__) | |  | | (___    | |   
 \__ \  ___/| |  | |\___ \   | |   
 (   / |    | |__| |____) |  | |   
  |_||_|     \____/|_____/   |_|   
                                                                         
Basic functionality
Use this class when you want retrieve $post data for security reasons

*****************************************************************************************************/
    
    class post{
        public static function init(){
            global $post;
            $post = array();
            if(isset($_POST)){
                foreach($_POST as $k => $v){
                    if (ctype_alnum($k)) {
                        $post[$k] = htmlentities($v, ENT_QUOTES, ENCODE);
                    }else{
                        trigger_error("<p class='dev_critical'>Error \$post: only alphanumerics characters.</p>", E_USER_ERROR); 
                    }
                }
            }
        }

        public static function get($param){
            global $post;

            if(trim($param)==""){
                unset($param);
            }
            if(isset($_POST) && isset($post)){ // i check if request POST and if $post exist (have been init)
                if($param !== NULL){ // if param is NULL
                        if(count($post)>=0 && count($_POST)>0){ // if $post is not empty
                            if(array_key_exists($param, $post)) { // if the key exist
                                return $post[$param];
                            }else{
                                trigger_error("<p class='dev_critical'>Error \$post: can't return undefined parameter.</p>", E_USER_ERROR);
                            }
                        }else{
                            trigger_error("<p class='dev_critical'>Error \$post: can't return empty array.</p>", E_USER_ERROR);
                        }
                }else{
                        return var_dump($post);
                }
            }else{ // if post is !isset we return empty array (for limit bugs)
                    trigger_error("<p class='dev_critical'>Error \$post: is undefined use \gng\get::init(); in router.controller.php !</p> ", E_USER_ERROR);
            }

        }
    }

/*****************************************************************************************************
   _   _____ ______ _______ 
  | | / ____|  ____|__   __|
 / __) |  __| |__     | |   
 \__ \ | |_ |  __|    | |   
 (   / |__| | |____   | |   
  |_| \_____|______|  |_|   
                                                                                                         
Basic functionality
Use this class when you want retrieve $get data for security reasons form URL

*****************************************************************************************************/
class get{

    public static function init(){

        global $get;
        $get = array();
        $parse_get_o = parse_url(FULLPATH, PHP_URL_QUERY); // i retrieve parameters form URL ($_GET)
        $parse_get = explode("&", $parse_get_o); // for explode 1 parameter with is own value
        if(count($parse_get)>=1 && strlen($parse_get_o)>1){ // if url
            foreach($parse_get as $pv){
                $explode = explode("=", $pv);
                if(isset($explode[0])){ // if there is not a trap in URL
                    $k = $explode[0];
                    if (ctype_alnum($k)) { // if the key is alphanumeric
                        $v = $explode[0];
                        if(isset($explode[1])){ // i check if value of the parameter is not undefined
                            $v = htmlentities($explode[1], ENT_QUOTES, ENCODE);
                        }else{
                            $v = NULL;
                        }
                        $get[$k] = $v; // i use htmlentities for security reasons

                    }else{
                        trigger_error("<p class='dev_critical'>Error \$get: only alphanumerics characters OR bad request.</p>", E_USER_ERROR); 
                    }
                }
            }
        }
    }

    public static function get($param = NULL){
        global $get;
        if(trim($param)==""){
            unset($param);
        }
        if(isset($get)){ // si $get exist
            if(isset($param)){
                if(count($get)>0){ // if my Array is not empty
                    if(array_key_exists($param, $get)) { // if my parameter (key) exist
                        return $get[$param];
                    }else{ // if dev call an undefined parameter
                        trigger_error("<p class='dev_critical'>Error \$get: can't return undefined parameter.</p>", E_USER_ERROR);
                    }
                }else{ // if param is defined BUT EMPTY array
                    trigger_error("<p class='dev_critical'>Error \$get: can't return parameter of empty array (\$_GET).</p>", E_USER_ERROR);
                }
            }else{
                    return var_dump($get);
            }
        }else{
            trigger_error("<p class='dev_critical'>Error \$get: is undefined use \gng\get::init(); in router.controller.php !</p>", E_USER_ERROR);
        }
    }
}
/*****************************************************************************************************
  _    _ ______          _____  ______ _____  
 | |  | |  ____|   /\   |  __ \|  ____|  __ \ 
 | |__| | |__     /  \  | |  | | |__  | |__) |
 |  __  |  __|   / /\ \ | |  | |  __| |  _  / 
 | |  | | |____ / ____ \| |__| | |____| | \ \ 
 |_|  |_|______/_/  __\_\_____/|______|_|  \_\
 | \ | |   /\ \    / /  _ \   /\   |  __ \    
 |  \| |  /  \ \  / /| |_) | /  \  | |__) |   
 | . ` | / /\ \ \/ / |  _ < / /\ \ |  _  /    
 | |\  |/ ____ \  /  | |_) / ____ \| | \ \    
 |_|_\_/_/___ \_\/__ |____/_/____\_\_|__\_\   
 |  ____/ __ \ / __ \__   __|  ____|  __ \    
 | |__ | |  | | |  | | | |  | |__  | |__) |   
 |  __|| |  | | |  | | | |  |  __| |  _  /    
 | |   | |__| | |__| | | |  | |____| | \ \    
 |_|    \____/ \____/  |_|  |______|_|  \_\   
                                                                                     
                                              
Basic function if user want change the default header, navbar or footer in the page

*****************************************************************************************************/
class customHNF{
    public function __construct($include_header, $include_navbar, $include_footer){
        $this->header = $include_header;
        $this->navbar = $include_navbar;
        $this->footer = $include_footer;
    }     
    
    public function get($data){
        $v = $this->$data;
        if(trim($v)!=""){
            $f = MVC."inc/".$v.".inc.php";
            if(file_exists($f)){
                require_once $f;
            }else{
                require_once MVC."inc/".$data.".inc.php";
                trigger_error("<p class='dev_critical'><b>$f</b> is missing.</p>", E_USER_WARNING);
            }
        }else{
            require_once MVC."inc/".$data.".inc.php";
        }
    }
}


?>