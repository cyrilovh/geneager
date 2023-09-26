<?php
    namespace class;

 /*
  ____  ______ _______       
 |  _ \|  ____|__   __|/\    
 | |_) | |__     | |  /  \   
 |  _ <|  __|    | | / /\ \  
 | |_) | |____   | |/ ____ \ 
 |____/|______|  |_/_/    \_\
                             
*/

    class ancestor{
        public static ?bool $html = false;

        private int $id;
        private ?string $firstNameList;
        private ?string $lastNameList;
        private ?string $otherIdentityList;
        private ?string $maidenNameList;
        private ?string $birthNameList;
        private ?string $nickNameList;

        // private ?string $fullIdentity;

        private ?string $photo;
        private ?int $gender; // check for use EnumList INT ?
        private ?\enumList\gender $genderStr;

        private ?string $biography;

        private ?event $birth;
        private ?event $death;
        private ?location $cemetery;

        private string $author;
        private string $lastUpdate;
        private string $createDate;

        private ?array $relationList; // array of array: array( array("idRelationship"=> 0, "idAncestor"=> 0, "strRelashipType" => "uncle"),  ... )
        private ?array $eventList; //   special class event ???
        private ?array $documentList; // object document ???
        private ?array $pictureList; // object picture ???
        private ?array $videoList; // Object video ???
        
        public function __construct(string $author, string $lastUpdate, string $createDate)
        {
            $this->id = null;
            $this->firstNameList = null;
            $this->lastNameList = null;
            $this->maidenNameList = null;
            $this->birthNameList = null;
            $this->nickNameList = null;
            $this->otherIdentityList = null;
            // $this->fullIdentity = null;

            $this->photo = null;
            $this->gender = null;
            $this->genderStr = null;

            $this->biography = null;

            $this->birth = null;
            $this->death = null;
            $this->cemetery = null;

            $this->author = $author;
            $this->lastUpdate = $createDate;
            $this->createDate = $lastUpdate;

            $this->relationList = array();
            $this->eventList = array();
            $this->documentList = array();
            $this->pictureList = array();
            $this->videoList = array();

        }

        public function setID(int $id):void{
            $this->id = $id;
        }

        public function setFirstnameList(string|null $firstNameList):void{
            $this->firstNameList = $firstNameList;
        }

        public function setlastNameList(string|null $lastNameList):void{
            $this->lastNameList = $lastNameList;
        }

        public function setBirthNameList(string|null $birthNameList):void{
            $this->birthNameList = $birthNameList;
        }

        public function setMaidenNameList(string|null $maidenNameList):void{
            $this->maidenNameList = $maidenNameList;
        }

        public function setNickNameList(string|null $nickNameList):void{
            $this->nickNameList = $nickNameList;
        }

        public function setotherIdentityList(string|null $otherIdentityList):void{
            $this->otherIdentityList = $otherIdentityList;
        }

        public function setPhoto(string|null $photo):void{
            $this->photo = $photo;
        }

        public function setGender(int|null $gender):void{
            $this->gender = $gender;
        }

        public function setBiography(string|null $biography):void{
            $this->biography = $biography;
        }

        public function setBirth(event $birth):void{
            $this->birth = $birth;
        }

        public function setDeath(event $death):void{
            $this->death = $death;
        }

        public function setCemetery(location $cemetery):void{
            $this->cemetery = $cemetery;
        }

        public function setAuthor(string $author):void{
            $this->author = $author;
        }

        public function setLastUpdate(string $lastUpdate):void{
            $this->lastUpdate = $lastUpdate;
        }

        public function setCreateDate(string $createDate):void{
            $this->createDate = $createDate;
        }

        public function setRelationList(array $relationList):void{
            $this->relationList = $relationList;
        }

        public function setEventList(array $eventList):void{ // WARNING CHANGE TO EVENT CLASS
            $this->eventList = $eventList;
        }

        public function setDocumentList(array $documentList):void{ // WARNING CHANGE TO DOCUMENT CLASS
            $this->documentList = $documentList;
        }

        public function setPictureList(array $pictureList):void{
            $this->pictureList = $pictureList;
        }

        public function setVideoList(array $videoList):void{ // WARNING CHANGE TO VIDEO CLASS
            $this->videoList = $videoList;
        }

        public function getID(): int{
            return $this->id;
        }

        public function getFirstNameList(): string|null{
            return format::htmlToUpperFirst($this->firstNameList, self::$html);
        }

        public function getlastNameList(): string|null{
            return format::htmlToUpper($this->lastNameList, self::$html);
        }

        public function getBirthNameList(): string|null{
            return format::htmlToUpper($this->birthNameList, self::$html);
        }

        public function getMaidenNameList(): string|null{
            return format::htmlToUpper($this->maidenNameList, self::$html);
        }

        public function getotherIdentityList(): string|null{
            return format::htmlToUpper($this->otherIdentityList, self::$html);
        }

        public function getNickNameList(): string|null{
            return format::htmlToUpperFirst($this->nickNameList, self::$html);
        }

        public function getPhoto(): string|null{
            $photo = (validator::isNullOrEmpty($this->photo)) ? DEFAULTPICTUREANCESTOR : $this->photo;
            return (self::$html) ? "<img src='$photo' onerror=\"this.src='".DEFAULTPICTUREANCESTOR."'\">" : $photo; 
        }

        public function getGender():int|null{
            return $this->gender;
        }

        /**
         * Return gender as string (not as int)
         *
         * @return string
         */
        public function getGenderStr():string{
            $genderStr = \enumList\gender::getByID($this->gender);
            return (self::$html) ? "<i class='fas fa-venus-mars'></i> $genderStr" : $genderStr;
        }

        public function getBiography():string|null{
            return format::htmlToUpperFirst($this->biography, self::$html);
        }

        public function getBirth():event|null{
            return $this->birth;
        }

        public function getDeath():event|null{
            return $this->death;
        }

        public function getCemetery():location|null{
            return $this->cemetery;
        }

        public function getAuthor():string{
            $author = format::htmlToUpperFirst($this->author, self::$html);
            return (self::$html) ? "<i class='fas fa-user'>$author</i>" : $author;
        }

        public function getCreationDate():string{
            return format::htmlToUpperFirst($this->createDate, self::$html);
        }

        public function getModificationDate():string{
            return format::htmlToUpperFirst($this->lastUpdate, self::$html);
        }
        
    }