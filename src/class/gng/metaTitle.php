<?php
/*
                                         
class for change the default title, description, ....
YOU MUST use this class in the controller of YOUR (new) page

*/
    namespace gng;
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
        public static function setTitle(string $title):void{
            global $meta_separator;
            global $meta_title;
            $meta_title = $title.$meta_separator.$meta_title;
        }
    }
?>