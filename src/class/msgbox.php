<?php
    namespace class;

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

        public function add($type, $msg){
            switch($type){
                case "success":
                    $this->success[] = $msg;
                    break;
                case "warning":
                    $this->warning[] = $msg;
                    break;
                case "error":
                    $this->error[] = $msg;
                    break;
                case "info":
                    $this->info[] = $msg;
                    break;
                default:
                    $this->info[] = $msg;
                    break;
            }
        }

        /* SETTERS */
        /* Add a message to the message box */
        public function setSuccess($msg):void{
            $this->add("success", $msg);
        }

        public function setWarning($msg):void{
            $this->add("warning", $msg);
        }

        public function setError($msg):void{
            $this->add("error", $msg);
        }

        public function setInfo($msg):void{
            $this->add("info", $msg);
        }
        /* Remove all message and one */
        public function replaceSuccess(string $msg):void{
            self::clearSuccess();
            $this->add("success", $msg);
        }

        public function replaceWarning(string $msg):void{
            self::clearWarning();
            $this->add("warning", $msg);
        }

        public function replaceError(string $msg):void{
            self::clearError();
            $this->add("error", $msg);
        }

        public function replaceInfo(string $msg):void{
            self::clearInfo();
            $this->add("info", $msg);
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