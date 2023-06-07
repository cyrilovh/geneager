<?php
    namespace class;
    class ancestor{

        private $ancestor;
        private $relation;

        public function __construct(array $infoList, string $relation = null){
            $this->ancestor = $infoList;
            $this->relation = $relation;
        }
        /**
         * Return all informations of the ancestor
         *
         * @return array
         */
        public function get():array{
            return $this->ancestor;
        }

        // return full identity
        // $html = true ----> for return value as HTML_entities format
        public function getFullIdentity(bool $html = true):string{
            $ancestor = $this->get();
                $allNames = (format::normalize($ancestor["maidenNameList"])!="") ? " ".format::htmlToUpperFirst($ancestor["firstNameList"], $html)." ".format::htmlToUpper($ancestor["lastNameList"], $html)." (".format::htmlToUpper($ancestor["maidenNameList"], $html).")" : " ".format::htmlToUpperFirst($ancestor["firstNameList"], $html)." ".format::htmlToUpper($ancestor["lastNameList"], $html);
                $allNames .= (format::normalize($ancestor["birthNameList"])!="") ? " (".format::normalize($ancestor["birthNameList"]).")" : "";
            return trim($allNames);
        }

        public function getFullIdentity2(array $firstNameList){

        }
    }
?>