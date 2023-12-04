<?php
    namespace class;

    /**
     * Class (POO) tag: to manage identification in documents
     */
    class tag{
        protected ?ancestor $ancestor;

        protected ?time $startTime;
        protected ?time $endTime;

        protected ?coordinates $coordinates;

        public function __construct()
        {
            $this->ancestor = null;
            $this->startTime = null;
            $this->endTime = null;
            $this->coordinates = null;
        }

        /* SETTERS */

        public function setAncestor(ancestor $ancestor):void{
            $this->ancestor = $ancestor;
        }

        public function setStartTime(?time $startTime):void{
            $this->startTime = $startTime;
        }

        public function setEndTime(?time $endTime):void{
            $this->endTime = $endTime;
        }

        public function setCoordinates(?coordinates $coordinates):void{
            $this->coordinates = $coordinates;
        }

        /* GETTERS */

        public function getAncestor():?ancestor{
            return $this->ancestor;
        }

        public function getAncestorID():int{
            return $this->ancestor->getID();
        }

        public function getAncestorName():string{
            return $this->ancestor->getFullIdentityDisplayShorter(true);
        }

        public function getStartTime():?time{
            return $this->startTime;
        }

        public function getEndTime():?time{
            return $this->endTime;
        }

        public function getCoordinates():?coordinates{
            return $this->coordinates;
        }

        /* ADVANCED METHODS */
        /**
         * Get the link to the ancestor
         *
         * @return string
         */
        public function getLink(): string {
            $ancestorName = $this->getAncestorName();
            $ancestorID = $this->getAncestorID();
        
            $display = $ancestorName ?: "Ancêtre n°$ancestorID";
        
            return "<a href='/ancestor/$ancestorID'>$display</a>";
        }
        


    }
?>