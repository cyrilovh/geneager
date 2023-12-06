<?php
    namespace class;

    /**
     * Class (POO) tag: to manage identification in videos
     */

     class tagVideo extends tag{
        protected ?time $startTime;
        protected ?time $endTime;

        public function __construct()
        {
            parent::__construct();
            $this->startTime = null;
            $this->endTime = null;
        }

        /* SETTERS */
        public function setStartTime(?time $startTime):void{
            $this->startTime = $startTime;
        }

        public function setEndTime(?time $endTime):void{
            $this->endTime = $endTime;
        }

        /* GETTERS */
        public function getStartTime():?time{
            return $this->startTime;
        }

        public function getEndTime():?time{
            return $this->endTime;
        }
     }