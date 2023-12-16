<?php
    namespace class;

    class tagList{
        private array $tagList;

        public function __construct()
        {
            $this->tagList = [];
        }

        public function addTag(tag $tag):void{
            $this->tagList[] = $tag;
        }

        public function getTagList():array{
            return $this->tagList;
        }

        /**
         * Return a string linkable with all tags separated by a comma
         *
         * @return string
         */
        public function getTagListString():string{
            $tagListString = "";
            foreach($this->tagList as $tag){
                $tagListString .= $tag->getLink().", ";
            }
            return (!validator::isEmpty($tagListString) > 0 ? substr($tagListString, 0, -2) : "Aucune identification");
        }

        public function getTagListByType(string $type):array{
            $tagList = [];
            foreach($this->tagList as $tag){
                if($tag->getType() == $type){
                    $tagList[] = $tag;
                }
            }
            return $tagList;
        }

        public function getTagListByTypeAndID(string $type, int $id):array{
            $tagList = [];
            foreach($this->tagList as $tag){
                if($tag->getType() == $type && $tag->getID() == $id){
                    $tagList[] = $tag;
                }
            }
            return $tagList;
        }

        public function getTagListByTypeAndIDAndStartTime(string $type, int $id, time $startTime):array{
            $tagList = [];
            foreach($this->tagList as $tag){
                if($tag->getType() == $type && $tag->getID() == $id && $tag->getStartTime() == $startTime){
                    $tagList[] = $tag;
                }
            }
            return $tagList;
        }

        public function getTagListByTypeAndIDAndEndTime(string $type, int $id, time $endTime):array{
            $tagList = [];
            foreach($this->tagList as $tag){
                if($tag->getType() == $type && $tag->getID() == $id && $tag->getEndTime() == $endTime){
                    $tagList[] = $tag;
                }
            }
            return $tagList;
        }

        public function getTagListByTypeAndIDAndStartTimeAndEndTime(string $type, int $id, time $startTime, time $endTime):array{
            $tagList = [];
            foreach($this->tagList as $tag){
                if($tag->getType() == $type && $tag->getID() == $id && $tag->getStartTime() == $startTime && $tag->getEndTime() == $endTime){
                    $tagList[] = $tag;
                }
            }
            return $tagList;
        }
    }