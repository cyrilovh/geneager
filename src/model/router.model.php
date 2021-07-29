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
        public static function loadFiles(string $url){ // CHECK IF FILE EXIST AND INCLUDE IT
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
        public static function addView(string $page){ // $page must contain filename only without file extensions
            global $include_MVC;
            array_push($include_MVC, "view:".MVC."view/".$page.".view.php");
        }

        // Function for add Model or Controller files
        public static function addModelController(string $page, string $type){ // function for add view file in main
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
        public static function set(string $filename){ // filename = name + file extension. example: slide.js
            global $include_JsCss;
            array_push($include_JsCss, $filename);
        }
        public static function get(string $filter){ // $filter= "css" OR "js"
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
        public function __construct(string $meta_title, string $meta_description, string $meta_keyword, string $meta_author){
            $this->title = $meta_title;
            $this->description = $meta_description;
            $this->keyword = $meta_keyword;
            $this->author = $meta_author;
        }     
        
        public function getData(string $data):string{
            return $this->$data;
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
    
    public function get(string $data){
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
/*
  ______ ____  _____  __  __  _____ 
 |  ____/ __ \|  __ \|  \/  |/ ____|
 | |__ | |  | | |__) | \  / | (___  
 |  __|| |  | |  _  /| |\/| |\___ \ 
 | |   | |__| | | \ \| |  | |____) |
 |_|    \____/|_|  \_\_|  |_|_____/ 
                                    
                                    
*/

class form{
    /*
        object = <form ...></form>
        $method = get/post
        $action = URL where data must be send
        $element => array with the input, select, textarea 
    */
    public $method;
    public $action;
    public $element;

    public function __construct(string $method, string $action, array $element = array()){
        $this->method = $method;
        $this->action = $action;
        $this->element = $element;
    }

    /*
        Function for add elements in form (object)
        $type = submit/button/text/email/[...]/textarea
        $attribut = array (key => $value). example: value => "Enter your password"
    */
    public function setElement(string $type, array $attribut){ /* array */
        // input, button
        $type = strtolower($type);
        if($type=="input" || $type=="button"){
            $element = "<$type";
            foreach($attribut as $k => $v){
                $element .= " $k='$v'";
            }
            $element .= " />";
            $this->element[] = $element;
        // Textarea
        }else if($type=="textarea"){
            $element = "<textarea";
            foreach($attribut as $k => $v){
                $k = strtolower($k);
                if($k!="value"){ // here the attributes
                    $element .= " $k='$v'";
                }
            }
            $element .= ">";
            $value ="";
            if (array_key_exists("value",$attribut)){
                $value = $attribut["value"]; // the value of textarea if tje key value exist
            }
            $element .= "$value</textarea>";
            $this->element[] = $element;
        // select
        }else if($type=="select"){
            $attr = "";
            foreach($attribut as $key => $array){
                if(str_starts_with($key, "attr:")){
                    if(gettype($array)!="array"){ // i check if it's not an array
                        trigger_error("<p class='dev_critical'>The value of select with the key 'attr:' MUST contain an array !</p>", E_USER_ERROR);
                    }else{ // if it's an array
                        foreach($array as $k => $v){
                            $attr.= " $k='$v'";
                        }
                    }
                }
            }
            $element = "<select$attr>";
            foreach($attribut as $k => $v){
                if(!str_starts_with($k, "attr:")){
                    $element .= "<option value='$k'>$v</option>";
                }
                // echo "$v";
            }
            $element .= "</select>";
            $this->element[] = $element;
        }else{
            trigger_error("<p class='dev_critical'>Error &laquo; $type &raquo; : is not yet compatible...</p>", E_USER_ERROR);
        }
    }

    /*
        function for display form
    */
    public function display(){
        //$implode = implode("\r\n\t", $this->element);
        //return "";
        $return = "<form action='{$this->action}' method='{$this->method}'>";
        foreach($this->element as $v){
            $return .= $v;
        }
        $return .="</form>";
        return $return;
    }

}
/*
   _____       _______       ____           _____ ______ 
 |  __ \   /\|__   __|/\   |  _ \   /\    / ____|  ____|
 | |  | | /  \  | |  /  \  | |_) | /  \  | (___ | |__   
 | |  | |/ /\ \ | | / /\ \ |  _ < / /\ \  \___ \|  __|  
 | |__| / ____ \| |/ ____ \| |_) / ____ \ ____) | |____ 
 |_____/_/    \_\_/_/    \_\____/_/    \_\_____/|______|                                                   
                                                        
 */
// https://phpdelusions.net/pdo_examples/select
class db{
    public static function connect(){
        global $db_host;
        global $db_name;
        global $db_user;
        global $bd_password;
        global $db;
        try
        {
            $db = new \PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $bd_password);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // Obligatoire pour la suite
        }catch (\PDOException $error){
            http_response_code(500);
            echo "<p>Erreur n°'{$error->getCode()}</p>";
            die("<p>Erreur : {$error->getMessage()}</p>");
        }
    }
}


/*
  _____         _____ _______          ______  _____  _____  
 |  __ \ /\    / ____/ ____\ \        / / __ \|  __ \|  __ \ 
 | |__) /  \  | (___| (___  \ \  /\  / / |  | | |__) | |  | |
 |  ___/ /\ \  \___ \\___ \  \ \/  \/ /| |  | |  _  /| |  | |
 | |  / ____ \ ____) |___) |  \  /\  / | |__| | | \ \| |__| |
 |_| /_/    \_\_____/_____/    \/  \/   \____/|_|  \_\_____/ 
                                                                                                                      
*/
class password{
    public static function hash(string $password, string $algo = "ripemd320"){
        global $password_salt;
        $password_time = strval(time());
        $hash = hash($algo, $password_salt.$password_time.$password);
        return $password_time.",".$hash;
    }

    public static function match(string $data, string $password, string $algo = "ripemd320"){ // first parameter come from db (salt,hash) and the second password (clear to compare)
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

    public static function genPassword(){
        $length = rand(8,10); // password length
        
        $data = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcefghjkmnpqrstuvwxyz'; // 0oO are excludes
        return substr(str_shuffle($data), 0, $length);
    }
}

/*
  ______ ____  _____  __  __       _______ 
 |  ____/ __ \|  __ \|  \/  |   /\|__   __|
 | |__ | |  | | |__) | \  / |  /  \  | |   
 |  __|| |  | |  _  /| |\/| | / /\ \ | |   
 | |   | |__| | | \ \| |  | |/ ____ \| |   
 |_|    \____/|_|  \_\_|  |_/_/    \_\_|   
                                           
                                           
*/
class format{
    public static function phone($n){
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/','\1.\2.\3.\4.\5',$n);
    }
    public static function phoneInternational($n){
        return preg_replace('/^0/', "+33", $n);
    }
    public static function mailProtect($str){
        return str_replace("@","<i class='fas fa-at'></i>",$str);
    }
}
?>