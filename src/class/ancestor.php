<?php
    namespace class;
    class ancestor{
        public function __construct(array $infoList, string $relation = null){
            $this->ancestor = $infoList;
            $this->relation = $relation;
        }

        public function get():array{
            return $this->ancestor;
        }

        // return full identity
        // $html = true ----> for return value as HTML format
        public function getFullIdentity(bool $html = false):string{
            $ancestor = $this->get();
            if($html == true){
                $familyNames = (format::normalize($ancestor["maidenName"])!="") ? " ".format::htmlToUpperFirst($ancestor["firstNameList"])." ".format::htmlToUpper($ancestor["lastName"])." (".format::htmlToUpper($ancestor["maidenName"]).")" : " ".format::htmlToUpperFirst($ancestor["firstNameList"])." ".format::htmlToUpper($ancestor["lastName"]);
            }else{
                $familyNames = (format::normalize($ancestor["maidenName"])!="") ? " ".ucfirst($ancestor["firstNameList"])." ".strtoupper($ancestor["lastName"])." (".strtoupper($ancestor["maidenName"]).")" : " ".ucfirst($ancestor["firstNameList"])." ".strtoupper($ancestor["lastName"]);
            }
            return $familyNames;
        }
    }
?>