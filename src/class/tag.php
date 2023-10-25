<?php
    namespace class;

    /**
     * Class (POO) tag: to manage identification in documents
     */
    class tag{
        protected int $idAncestor;
        protected ?string $text;

        protected ?time $startTime;
        protected ?time $endTime;

        protected ?coordinates $coordinates;

        public function __construct(int $idAncestor)
        {
            $this->idAncestor = $idAncestor;
            $this->text = null;
            $this->startTime = null;
            $this->endTime = null;
            $this->coordinates = null;
        }

        /* SETTERS */

        public function setIDAncestor(int $idAncestor):void{
            $this->idAncestor = $idAncestor;
        }

        public function setText(?string $text):void{
            $this->text = $text;
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

        public function getText():?string{
            return $this->text;
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


    }
?>