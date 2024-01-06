<?php
    namespace class;

    class json{
        private ?status $status;
        private ?string $message;
        private ?array $data;

        public function __construct(){
            $this->status = null;
            $this->message = null;
            $this->data = array();
        }

        public function setStatus(status $status):void{
            $this->status = $status;
        }

        public function setMessage(string $message):void{
            $this->message = $message;
        }

        public function setData(array $data):void{
            $this->data = $data;
        }

        public function addData(array $data):void{
            $this->data = array_merge($this->data, $data);
        }

        /**
         * empties the table
         *
         * @return void
         */
        public function emptyData():void{
            $this->data = array();
        }

        public function getStatus():status{
            return $this->status;
        }

        public function getMessage():?string{
            return $this->message;
        }

        public function getData():array{
            return (is_null($this->data))? array() : $this->data;
        }

        public function getJSON():string{
            $output = array();
            $output['status'] = $this->status->getStatus();
            $output['message'] = $this->getMessage();
            $output['data'] = $this->getData();
            return json_encode($output, JSON_PRETTY_PRINT);
        }
    }