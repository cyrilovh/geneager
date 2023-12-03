<?php
    namespace class;

    /**
     * Class (POO) tag: to manage identification in documents
     */
    class tag{
        protected int $idAncestor;
        protected ?string $ancestor;

        protected ?time $startTime;
        protected ?time $endTime;

        protected ?coordinates $coordinates;

        public function __construct(int $idAncestor)
        {
            $this->idAncestor = $idAncestor;
            $this->ancestor = null;
            $this->startTime = null;
            $this->endTime = null;
            $this->coordinates = null;
        }

        /* SETTERS */

        public function setIDAncestor(int $idAncestor):void{
            $this->idAncestor = $idAncestor;
        }

        public function setAncestor(?string $Ancestor):void{
            $this->ancestor = $Ancestor;
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

        public function getIDAncestor():int{
            return $this->idAncestor;
        }

        public function getAncestor():?string{
            return $this->ancestor;
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
        public function getLink():string{
            $Ancestor = (validator::isNullOrEmpty($this->ancestor))? "Anc&eacute;tre n°".$this->idAncestor: $this->ancestor;
            return "<a href='/ancestor/{$this->idAncestor}'>{$Ancestor}</a>";
        }


    }
?>