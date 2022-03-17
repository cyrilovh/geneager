<?php
    namespace class;
    class ancestor{
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
        // $html = true ----> for return value as HTML format
        public function getFullIdentity(bool $html = false):string{
            $ancestor = $this->get();
                $allNames = (format::normalize($ancestor["maidenName"])!="") ? " ".format::htmlToUpperFirst($ancestor["firstNameList"], $html)." ".format::htmlToUpper($ancestor["lastName"], $html)." (".format::htmlToUpper($ancestor["maidenName"], $html).")" : " ".format::htmlToUpperFirst($ancestor["firstNameList"], $html)." ".format::htmlToUpper($ancestor["lastName"], $html);
                $allNames .= (format::normalize($ancestor["birthNameList"])!="") ? " (".format::normalize($ancestor["birthNameList"]).")" : "";
            return trim($allNames);
        }

        public function getFullIdentity2(array $firstNameList){

        }
    }
?>