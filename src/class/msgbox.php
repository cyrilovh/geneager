<?php
    namespace class;
    use \enumList\msgboxType as type;
    /*
    *   This class is used to display a message box (success, warning, error, info)
    */
    class msgbox{
        private array $success;
        private array $warning;
        private array $error;
        private array $info;

        public function __construct(){
            $this->success = array();
            $this->warning = array();
            $this->error = array();
            $this->info = array();
        }

        private function add(string $type, string $msg):void{
            switch($type){
                case type::SUCCESS:
                    $this->success[] = $msg;
                    break;
                case type::WARNING:
                    $this->warning[] = $msg;
                    break;
                case type::ERROR:
                    $this->error[] = $msg;
                    break;
                case type::INFO:
                    $this->info[] = $msg;
                    break;
                default:
                    trigger_error("msgbox::add(): type not found", E_USER_WARNING);
            }
        }

        /* SETTERS */
        /* Add a message to the message box */
        public function setSuccess($msg):void{
            $this->add(type::SUCCESS, $msg);
        }

        public function setWarning($msg):void{
            $this->add(type::WARNING, $msg);
        }

        public function setError($msg):void{
            $this->add(type::ERROR, $msg);
        }

        public function setInfo($msg):void{
            $this->add(type::INFO, $msg);
        }
        /* Remove all message and one */
        public function replaceSuccess(string $msg):void{
            self::clearSuccess();
            $this->add(type::SUCCESS, $msg);
        }

        public function replaceWarning(string $msg):void{
            self::clearWarning();
            $this->add(type::WARNING, $msg);
        }

        public function replaceError(string $msg):void{
            self::clearError();
            $this->add(type::ERROR, $msg);
        }

        public function replaceInfo(string $msg):void{
            self::clearInfo();
            $this->add(type::INFO, $msg);
        }

        /* Erase list */
        public function clearSuccess():void{
            $this->success = array();
        }

        public function clearWarning():void{
            $this->warning = array();
        }

        public function clearError():void{
            $this->error = array();
        }

        public function clearInfo():void{
            $this->info = array();
        }

        /* GETTERS */
        public function getSuccess():array{
            return $this->success;
        }

        public function getWarning():array{
            return $this->warning;
        }

        public function getError():array{
            return $this->error;
        }

        public function getInfo():array{
            return $this->info;
        }

        /* ADVANCED GETTERS */
        public function getSuccessHTML():string{
            $html = "";
            foreach($this->success as $msg){
                $html .= "<div class='alert alert-success' role='alert'>".$msg."</div>";
            }
            return $html;
        }

        public function getWarningHTML():string{
            $html = "";
            foreach($this->warning as $msg){
                $html .= "<div class='alert alert-warning' role='alert'>".$msg."</div>";
            }
            return $html;
        }

        public function getErrorHTML():string{
            $html = "";
            foreach($this->error as $msg){
                $html .= "<div class='alert alert-danger' role='alert'>".$msg."</div>";
            }
            return $html;
        }

        public function getInfoHTML():string{
            $html = "";
            foreach($this->info as $msg){
                $html .= "<div class='alert alert-info' role='alert'>".$msg."</div>";
            }
            return $html;
        }

        /* Count */
        public function countSuccess():int{
            return count($this->success);
        }

        public function countWarning():int{
            return count($this->warning);
        }

        public function countError():int{
            return count($this->error);
        }

        public function countInfo():int{
            return count($this->info);
        }

        public function countAll():int{
            return count($this->success) + count($this->warning) + count($this->error) + count($this->info);
        }

        /* check if empty */
        public function isEmptySuccess():bool{
            return (self::countSuccess() == 0);
        }

        public function isEmptyWarning():bool{
            return (self::countWarning() == 0);
        }

        public function isEmptyError():bool{
            return (self::countError() == 0);
        }

        public function isEmptyInfo():bool{
            return (self::countInfo() == 0);
        }

        public function isEmpty():bool{
            return (self::countAll() == 0);
        }

    }