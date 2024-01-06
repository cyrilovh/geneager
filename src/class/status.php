<?php
    namespace class;

    class status{
        public const SUCCESS = 'success';
        public const INFO = 'info';
        public const WARNING = 'warning';
        public const ERROR = 'error';

        private ?string $status;
        
        public function __construct(){
            $this->status = null;
        }

        public function setSuccess():void{
            $this->status = self::SUCCESS;
        }

        public function setInfo():void{
            $this->status = self::INFO;
        }

        public function setWarning():void{
            $this->status = self::WARNING;
        }

        public function setError():void{
            $this->status = self::ERROR;
        }

        public function getStatus():string{
            return $this->status;
        }

    }