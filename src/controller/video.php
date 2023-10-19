<?php
    namespace class;

    // ABSTRACT CLASS OF PICTURE ??????

    class video extends document{
        public static $html = true;

        protected duration $duration; // in seconds only
        protected string $cover;
        protected string $resume;
        protected string $conversation;


        public function __construct(int $id, string $filename, string $createDate, string $author, duration $duration)
        {
            parent::__construct($id, $filename, $createDate, $author);
            $this->duration = $duration;
            $this->cover = null;
            $this->resume = null;
            $this->conversation = null;
        }

        public function setDuration(duration $duration):void{
            $this->duration = $duration;
        }

        public function setCover(string $cover):void{
            $this->cover = $cover;
        }

        public function setResume(string $resume):void{
            $this->resume = $resume;
        }

        public function setConversation(string $conversation):void{
            $this->conversation = $conversation;
        }

        /**
         * Return object
         * Use submethods to get specific data
         *
         * @return duration
         */
        public function getDuration():duration{
            return $this->duration;
        }

        public function getCover():?string{
            return $this->cover;
        }

        public function getResume():?string{
            return $this->resume;
        }

        public function getConversation():?string{
            return $this->conversation;
        }
    }