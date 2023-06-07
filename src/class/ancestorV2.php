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

        private ?int $birthdayY;
        private ?int $birthdayM;
        private ?int $birthdayD;
        // private ?int $fullBirthDate;

        private ?int $birthCity; // id city
        private ?string $birthCityName; // name city, state, country
        private ?string $birthAccuracyLocation;

        

        private ?int $deathdayY;
        private ?int $deathdayM;
        private ?int $deathdayD;
        // private ?int $fullDeathDate;

        private ?int $deathCity; // id city
        private ?string $deathCityName; // name city, state, country
        private ?string $deathAccuracyLocation;
        // private ?string $fullDeathLocation;

        private ?int $cemeteryCity;
        private ?string $cemeteryCityName; // name city, state, country
        private ?string $cemeteryAccuracyLocation;

        private ?string $biography;

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

            $this->birthdayY = null;
            $this->birthdayM = null;
            $this->birthdayD = null;
            // $this->fullBirthDate = null;

            $this->birthCity = null;
            $this->birthAccuracyLocation = null;
            // $this->fullBirthLocation = null;

            $this->deathdayY = null;
            $this->deathdayM = null;
            $this->deathdayD = null;
            // $this->fullDeathDate = null;

            $this->deathCity = null;
            $this->deathAccuracyLocation = null;
            // $this->fullDeathLocation = null;

            $this->cemeteryCity = null;
            $this->cemeteryAccuracyLocation = null;

            $this->biography = null;

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

        public function setBirthdayY(int|null $birthdayY):void{
            $this->birthdayY = $birthdayY;
        }

        public function setBirthdayM(int|null $birthdayM):void{
            $this->birthdayM = $birthdayM;
        }

        public function setBirthdayD(int|null $birthdayD):void{
            $this->birthdayD = $birthdayD;
        }

        public function setBirthCity(int|null $birthCity):void{
            $this->birthCity = $birthCity;
        }

        public function setBirthCityName(string|null $birthCityName):void{
            $this->birthCityName = $birthCityName;
        }

        public function setBirthAccuracyLocation(string|null $birthAccuracyLocation):void{
            $this->birthAccuracyLocation = $birthAccuracyLocation;
        }

        public function setDeathdayY(int|null $deathdayY):void{
            $this->deathdayY = $deathdayY;
        }

        public function setDeathdayM(int|null $deathdayM):void{
            $this->deathdayM = $deathdayM;
        }

        public function setDeathdayD(int|null $deathdayD):void{
            $this->deathdayD = $deathdayD;
        }

        public function setDeathCity(int|null $deathCity):void{
            $this->deathCity = $deathCity;
        }

        public function setDeathCityName(string|null $deathCityName):void{
            $this->deathCityName = $deathCityName;
        }

        public function setDeathAccuracyLocation(string|null $deathAccuracyLocation):void{
            $this->deathAccuracyLocation = $deathAccuracyLocation;
        }

        public function setCemeteryCity(int|null $cemeteryCity):void{
            $this->cemeteryCity = $cemeteryCity;
        }

        public function setCemeteryCityName(string|null $cemeteryCityName):void{
            $this->cemeteryCityName = $cemeteryCityName;
        }

        public function setCemeteryAccuracyLocation(string|null $cemeteryAccuracyLocation):void{
            $this->cemeteryAccuracyLocation = $cemeteryAccuracyLocation;
        }

        public function setBiography(string|null $biography):void{
            $this->biography = $biography;
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

        public function setPictureList(picture $pictureList):void{
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

        public function getBirthdayY():int|null{
            return $this->birthdayY;
        }

        public function getBirthdayM():int|null{
            return $this->birthdayM;
        }

        public function getBirthdayD():int|null{
            return $this->birthdayD;
        }

        /**
         * Return birthday as string (not as int)
         * for example: 
         * @return string
         */
        public function getBirthdayStr():string{
            $birthdayStr = format::strToDate(format::YMDtoStr($this->birthdayY, $this->birthdayM, $this->birthdayD));
            if(self::$html){
                return (is_null($birthdayStr)) ? "" : "<i class='fas fa-baby-carriage'></i> $birthdayStr";
            }else{
                return (is_null($birthdayStr)) ? "" : $birthdayStr;
            }
        }

        public function getBirthCityID():int|null{
            return $this->birthCity;
        }

        public function getBirthCityName():string|null{
            return format::htmlToUpperFirst($this->birthCityName, self::$html);
        }

        public function getBirthAccuracyLocation():string|null{
            return format::htmlToUpperFirst($this->birthAccuracyLocation, self::$html);
        }

        public function getBirthLocation():string|null{
            $location = "";

            $location .= (is_null($this->birthAccuracyLocation)) ? "" : $this->birthAccuracyLocation;
            if(!validator::isNullOrEmpty($location) && !validator::isNullOrEmpty($this->birthCityName)){
                $location .= ", ";
            }
            $location .= (is_null($this->birthCityName)) ? "" : $this->birthCityName;
            return $location;
        }

        public function getDeathdayY():int|null{
            return $this->deathdayY;
        }

        public function getDeathdayM():int|null{
            return $this->deathdayM;
        }

        public function getDeathdayD():int|null{
            return $this->deathdayD;
        }

        public function getDeathDateStr():string{
            $deathDateStr = format::strToDate(format::YMDtoStr($this->deathdayY, $this->deathdayM, $this->deathdayD));
            if(self::$html){
                return (is_null($deathDateStr)) ? "" : "<i class='fas fa-skull-crossbones'></i> $deathDateStr";
            }else{
                return (is_null($deathDateStr)) ? "" : $deathDateStr;
            }
        }

        public function getDeathCityID():int|null{
            return $this->deathCity;
        }

        public function getDeathCityName():string|null{
            return format::htmlToUpperFirst($this->deathCityName, self::$html);
        }

        public function getDeathAccuracyLocation():string|null{
            return format::htmlToUpperFirst($this->deathAccuracyLocation, self::$html);
        }

        public function getDeathLocation():string|null{
            $location = "";

            $location .= (is_null($this->deathAccuracyLocation)) ? "" : $this->deathAccuracyLocation;
            if(!validator::isNullOrEmpty($location) && !validator::isNullOrEmpty($this->deathCityName)){
                $location .= ", ";
            }
            $location .= (is_null($this->deathCityName)) ? "" : $this->deathCityName;

            return $location;
        }

        public function getCemeteryCityID():int|null{
            return $this->cemeteryCity;
        }

        public function getCemeteryCityName():string|null{
            return format::htmlToUpperFirst($this->cemeteryCityName, self::$html);
        }

        public function getCemeteryAccuracyLocation():string|null{
            return format::htmlToUpperFirst($this->cemeteryAccuracyLocation, self::$html);
        }

        public function getCemeteryLocation():string|null{
            $location = "";

            $location .= (is_null($this->cemeteryAccuracyLocation)) ? "" : $this->cemeteryAccuracyLocation;
            if(!validator::isNullOrEmpty($location) && !validator::isNullOrEmpty($this->cemeteryCityName)){
                $location .= ", ";
            }
            $location .= (is_null($this->cemeteryCityName)) ? "" : $this->cemeteryCityName;
            return $location;
        }

        public function getBiography():string|null{
            return format::htmlToUpperFirst($this->biography, self::$html);
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