<?php
    namespace class;

    class ancestorList{
        private $ancestorList = array();

        public function __construct(){
            $this->ancestorList = array();
        }

        public function addAncestor(ancestor $ancestor){
            $this->ancestorList[] = $ancestor;
        }

        public function getAncestorList():array{
            return $this->ancestorList;
        }

        public function getAncestor(int $index):ancestor{
            return $this->ancestorList[$index];
        }

        public function count():int{
            return count($this->ancestorList);
        }

        /**
         * Return data AS array of array AND NOT AS array of object
         *
         * @return array
         */
        public function getArrayAsArray():array{
            $output = array();
            foreach($this->ancestorList as $ancestor){
                $output[] = $ancestor->getBasicAsArray();
            }
            return $output;
        }
    }