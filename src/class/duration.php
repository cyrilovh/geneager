<?php
    namespace class;

    /**
     * POO class: video/audio duration
     */
    class duration{
        private int $duration; // in seconds


        public function __construct(int $duration)
        {
            $this->duration = $duration;
        }

        public function setDuration(int $duration):void{
            $this->duration = $duration;
        }

        /**
         * Return the duration in seconds only
         *
         * @return integer
         */
        public function getDurationInSeconds():int{
            return $this->duration;
        }

        /**
         * Return the duration in a string format (HH:MM:SS)
         *
         * @return string
         */
        public function getDuration():string{
            $hours = floor($this->duration / 3600);
            $minutes = floor(($this->duration / 60) % 60);
            $seconds = $this->duration % 60;

            return $hours . ':' . $minutes . ':' . $seconds;
        }
    }