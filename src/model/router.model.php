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
        protected static function loadFiles(string $url){ // CHECK IF FILE EXIST AND INCLUDE IT
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
        // for add stylesheet ou javascript (declaration in the second controller)
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
                        $result .= "<link rel='Stylesheet' type='text/css' href='/assets/css/$f' />\n";
                    }else if($extension=="js"){ // if JS
                        $result .=  "<script type='text/javascript' src='/assets/js/$f' defer></script>\n";  
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
    class metaTitle{
        public function __construct(string $meta_title, string $meta_description, string $meta_keyword, string $meta_favicon, string $meta_author, string $meta_robot){
            $this->title = trim($meta_title);
            $this->description = $meta_description;
            $this->keyword = $meta_keyword;
            $this->favicon = (empty($meta_favicon) ? "favicon" : $meta_favicon);
            $this->author = $meta_author;
            $this->robot = $meta_robot;
        }     
        
        // get Data from the object
        public function getData(string $data):string{
            return $this->$data;
        }

        // set title with: page title + separator + Website Name
        public static function setTitle(string $title){
            global $meta_separator;
            global $meta_title;
            $meta_title = $title.$meta_separator.$meta_title;
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
    
    // get data from object (header/navbar/footer)
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
/*
  _       _ _   
 (_)     (_) |  
  _ _ __  _| |_ 
 | | '_ \| | __|
 | | | | | | |_ 
 |_|_| |_|_|\__|
                            
*/
// initialize the  connection to datbase
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

/*
                      _ 
                     | |
   ___ _ __ _   _  __| |
  / __| '__| | | |/ _` |
 | (__| |  | |_| | (_| |
  \___|_|   \__,_|\__,_|

  Create
  Read
  Update
  Delete/Drop
                                              
*/

    /* get parameters form database */
    public static function getParameter(string $param = NULL){
        global $db;

        if($param!==NULL){ // if the parameter is specified i return the value
            $query = $db->prepare("SELECT * FROM parameter WHERE parameter=:param");
            $query->execute(['param' => $param]);
            return $query->fetch(\PDO::FETCH_ASSOC)["value"]; // string
            $query->closeCursor();
        }else{ // the paramters is not defined (null): i return an array (key => value)
            $return = array();
            $query = $db->query("SELECT * FROM parameter WHERE parameter NOT LIKE 'sn%'");
            
            while($row = $query->fetch(\PDO::FETCH_ASSOC)){
                $return[$row["parameter"]] = $row["value"];
            }
            return $return;
            $query->closeCursor();
        }
    }

    /* get social network links */
    public static function getSocialLink(){
        global $db;
        $return = array(); // string to return
        $query = $db->query("SELECT * FROM parameter WHERE parameter LIKE 'sn%'"); // i check all line with the parameter start with "sn"
        while($row = $query->fetch(\PDO::FETCH_ASSOC)){ // i do a loop
            $nickname = $row["value"];
            if(trim($nickname)){ // if there is a username (not empty value)
                $v = strtolower(substr($row["parameter"],2)); // i retrieve the value of the row "parameter", then substr (for remove the 2 firsts characters), then i convert to lower case. ex: snFacebook -> facebook
                $return[] = "<i class='fab fa-$v' data-href='https://$v.com/$nickname' data-target='blank' rel='nofollow'></i>"; // i add the value in the array
            }
        }
        if(count($return)>0){ // if there is 1 link or more
            return "<p class='title'>Réseaux sociaux</p><p>".implode(" ", $return)."</p>"; // i return a string
        }
        $query->closeCursor();
    }

    /* get user data informations (1 user only) */
    public static function getUserInfo(string $username, array $filter=array("*")){ // username: username/nickname; filter: columns to filter (default: all) exemple: array("id", "username","password").
        global $db;
        $filter_str = implode(",", $filter);
        $query = $db->prepare("SELECT $filter_str FROM user WHERE username=:username");
        $query->execute(['username' => \gng\format::cleanStr($username)]);
        if($query->rowCount()>0){
            if(count($filter)==0){ // if i've any result
                trigger_error("The array filter can't be empty: try to keep blank the parameter filter or add values inside.", E_USER_ERROR);
                return NULL;
            }else{ // if there 1 column or more i return the value(s) as a string or as an array
                if(count($filter)>1 || $filter[0]=="*"){ // if all columns => i return the data as an array
                    return $query->fetchAll(\PDO::FETCH_ASSOC);
                }else{ // if have 1 column i return the value as string
                    return $query->fetch(\PDO::FETCH_ASSOC)[$filter[0]];  
                }
            }
        }else{
            return array();
        }
        $query->closeCursor();
    }
}



/*
   _____ ______ _____ _    _ _____  _____ _________     __
  / ____|  ____/ ____| |  | |  __ \|_   _|__   __\ \   / /
 | (___ | |__ | |    | |  | | |__) | | |    | |   \ \_/ / 
  \___ \|  __|| |    | |  | |  _  /  | |    | |    \   /  
  ____) | |___| |____| |__| | | \ \ _| |_   | |     | |   
 |_____/|______\_____|\____/|_|  \_\_____|  |_|     |_|   
                                                                                                                  
*/
class security{
    // for encrypt data
    public static function encrypt(string $str, string $password){
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($str, $cipher, $password, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $password, $as_binary=true);
        return base64_encode( $iv.$hmac.$ciphertext_raw);
    }
    // for decrypt data
    public static function decrypt(string $str, string $password){
        $c = base64_decode($str);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $password, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $password, $as_binary=true);
        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
        {
            return $original_plaintext."\n";
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
class password extends security{
    // for hash password
    public static function hash(string $password, string $algo = "ripemd320"){
        global $password_salt;
        $password_time = strval(time());
        $hash = hash($algo, $password_salt.$password_time.$password);
        return $password_time.",".$hash;
    }

    // Check if the provided password (from form) is the same that in the DB.
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

    // generate random password (8 to 10 characters)
    public static function gen(){
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
    // return phone number (Ten character) pair per pair with a dot between
    public static function phone(mixed $n){
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/','\1.\2.\3.\4.\5',$n);
    }
    // convert a french phone number to international format
    public static function phoneInternational(mixed $n){
        return preg_replace('/^0/', "+33", $n);
    }
    // replace the character "@" by the "@" of font-awesome (spam prevent)
    public static function mailProtect(string $str){
        return str_replace("@","<i class='fas fa-at'></i>",$str);
    }
    public static function cleanStr(string $str){
        return htmlentities(trim($str), ENT_QUOTES, "UTF-8");
    }
}
?>