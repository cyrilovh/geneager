<?php
    namespace class;

    class source{
        protected ?string $text;
        protected ?string $link;

        public function __construct(?string $text, ?string $link)
        {
            $this->text = $text;
            $this->link = $link;
        }

        public function setText(?string $text):void{
            $this->text = $text;
        }

        public function setLink(?string $link):void{
            $this->link = $link;
        }

        public function getText():?string{
            return $this->text;
        }

        public function getLink():?string{
            return $this->link;
        }

        public function toHTML():string{
            global $gng_paramList;
            
            if($this->linkIsValid() && !validator::isNullOrEmpty($this->text)){
                return "<a href='".$this->link."' target='_blank'>".$this->text."</a>";
            }else if($this->linkIsValid()){
                return "<a href='".$this->link."' target='_blank'>".$this->link."</a>";
            }else if(!validator::isNullOrEmpty($this->text)){
                return $this->text;
            }else{
                return $gng_paramList->get("noSourceText");
            }
        }

        public function linkIsValid():bool{
            return (filter_var($this->link, FILTER_VALIDATE_URL) ? true : false);
        }

    }