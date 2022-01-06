<?php
/**
 * class for change the default title, description, ....
 * 
 */
    namespace class;
    class metaTitle{
        /**
         * Constructor
         *
         * @param string $meta_title
         * @param string $meta_description
         * @param string $meta_keyword
         * @param string $meta_favicon
         * @param string $meta_author
         * @param string $meta_robot
         */
        public function __construct(string $meta_title, string $meta_description, string $meta_keyword, string $meta_favicon, string $meta_author, string $meta_robot){
            $this->title = trim($meta_title);
            $this->description = $meta_description;
            $this->keyword = $meta_keyword;
            $this->favicon = (empty($meta_favicon) ? "favicon" : $meta_favicon);
            $this->author = $meta_author;
            $this->robot = $meta_robot;
        }     
        
        /**
         * Get Data from the object
         *
         * @param string $data
         * @return string
         */
        public function getData(string $data):string{
            return $this->$data;
        }

        /**
         * Set title with: page title + separator + Website Name
         *
         * @param string $title
         * @return void
         */
        public static function setTitle(string $title):void{
            global $meta_separator;
            global $meta_title;
            $meta_title = $title.$meta_separator.$meta_title;
        }
    }
?>