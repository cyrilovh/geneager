<?php
    namespace class;

    /**
     * Class (POO) time: to manage time in videos
     * Default unit: seconds
     */
    class time{
        protected int $time; // in seconds

        public function __construct(int $time)
        {
            $this->time = $time;
        }

        /* GETTERS/SETTERS */
        public function getTime():int{
            return $this->time;
        }

        public function setTime(int $time):void{
            $this->time = $time;
        }

        /* ADVANCED METHODS */
        public function getTimeHMS():string{
            $hours = floor($this->time / 3600);
            $minutes = floor(($this->time / 60) % 60);
            $seconds = $this->time % 60;

            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
    }
?>