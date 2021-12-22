<?php
/*                                                                    

class additionnalJsCss: for add additionnals JS and CSS files in template 
YOU MUST use this class in the controller of YOUR (new) page
/!\ Every files must separated by a comma

*/
    namespace gng;
    
    class additionnalJsCss{
        // for add stylesheet ou javascript (declaration in the second controller)
        public static function set(string $filename):void{ // filename = name + file extension. example: slide.js
            global $include_JsCss;
            array_push($include_JsCss, $filename);
        }
        public static function get(string $filter):string{ // $filter= "css" OR "js"
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
?>