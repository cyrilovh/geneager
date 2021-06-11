<?php
    namespace geneager;

    /* class mcv = program for include models, (view), controllers about URL */

    global $includeView;
    class mcv{

        public $includeView;

        public function __construct($includeView){
            $this->includeView =  $includeView;
        }   

        public function addInclude($includeView){
           $this->includeView .= ",".$includeView;
        }

        public function returnInclude(){
            return $this->includeView;
         }

        /* 2 - INCLUDE THE GOOD FILES MCV IN TEMPLATE (BODY) */
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
                            //echo "oups $view don't exist";
                            include MVC."view/404.view.php";
                        }
                    }
                }
            }
        }

        /* 1 - FIRST CHECK AND PARSE URL */
        public static function load(){ // FUNCTION mcv
            $parts = explode('/', FULLPATH); // parse url
            $url = $parts[1];  // first word after slash
            if($url!=""){ // if not blank
                if (ctype_alnum($url) && $url!="index"){ // if path is alphanumeric string. example: https://abc.xyz/abc -> abc IS GOOD
                    \geneager\mcv::loadFiles($url);
                }else{ // else we return 404 page
                    \geneager\mcv::loadFiles("404");
                }
            }else{ // if $url is blank or empty
                echo \geneager\mcv::loadFiles("home");
            }
        }
    }

    /*
        class additionnalJsCss: for add additionnals JS and CSS files in template 
        YOU MUST use this class in the controller of YOUR (new) page
        /!\ Every files must separated by a comma
    */
    class additionnalJsCss{

        public $filesCss;
        public $filesJs;

        public function __construct($filesCss, $filesJs){

        }

    }

    /*
        class for change the default title, description, ....
        YOU MUST use this class in the controller of YOUR (new) page
    */

    global $titre;
    global $description;
    global $keyword;
    
    class MetaTitle{

        public $title;
        public $description;
        public $keyword;

        public function __construct($title, $description, $keyword){
            $this->title =  $title;
            $this->description = $description;
            $this->keyword = $keyword;
        }     
        
        public function getTitle(){
            return $this->title;
        }

    }
?>