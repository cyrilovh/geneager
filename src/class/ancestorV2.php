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
        // private ?\enumList\gender $genderStr;

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

        public function setID(int $id){
            $this->id = $id;
        }

        public function setFirstnameList(string|null $firstNameList){
            $this->firstNameList = $firstNameList;
        }

        public function setlastNameList(string|null $lastNameList){
            $this->lastNameList = $lastNameList;
        }

        public function setBirthNameList(string|null $birthNameList){
            $this->birthNameList = $birthNameList;
        }

        public function setMaidenNameList(string|null $maidenNameList){
            $this->maidenNameList = $maidenNameList;
        }

        public function setNickNameList(string|null $nickNameList){
            $this->nickNameList = $nickNameList;
        }

        public function setotherIdentityList(string|null $otherIdentityList){
            $this->otherIdentityList = $otherIdentityList;
        }

        public function setPhoto(string|null $photo){
            $this->photo = $photo;
        }

        public function setGender(int|null $gender){
            $this->gender = $gender;
        }

        public function setBirthdayY(int|null $birthdayY){
            $this->birthdayY = $birthdayY;
        }

        public function setBirthdayM(int|null $birthdayM){
            $this->birthdayM = $birthdayM;
        }

        public function setBirthdayD(int|null $birthdayD){
            $this->birthdayD = $birthdayD;
        }

        public function setBirthCity(int|null $birthCity){
            $this->birthCity = $birthCity;
        }

        public function setBirthCityName(string|null $birthCityName){
            $this->birthCityName = $birthCityName;
        }

        public function setBirthAccuracyLocation(string|null $birthAccuracyLocation){
            $this->birthAccuracyLocation = $birthAccuracyLocation;
        }

        public function setDeathdayY(int|null $deathdayY){
            $this->deathdayY = $deathdayY;
        }

        public function setDeathdayM(int|null $deathdayM){
            $this->deathdayM = $deathdayM;
        }

        public function setDeathdayD(int|null $deathdayD){
            $this->deathdayD = $deathdayD;
        }

        public function setDeathCity(int|null $deathCity){
            $this->deathCity = $deathCity;
        }

        public function setDeathCityName(string|null $deathCityName){
            $this->deathCityName = $deathCityName;
        }

        public function setDeathAccuracyLocation(string|null $deathAccuracyLocation){
            $this->deathAccuracyLocation = $deathAccuracyLocation;
        }

        public function setCemeteryCity(int|null $cemeteryCity){
            $this->cemeteryCity = $cemeteryCity;
        }

        public function setCemeteryCityName(string|null $cemeteryCityName){
            $this->cemeteryCityName = $cemeteryCityName;
        }

        public function setCemeteryAccuracyLocation(string|null $cemeteryAccuracyLocation){
            $this->cemeteryAccuracyLocation = $cemeteryAccuracyLocation;
        }

        public function setBiography(string|null $biography){
            $this->biography = $biography;
        }

        public function setAuthor(string $author){
            $this->author = $author;
        }

        public function setLastUpdate(string $lastUpdate){
            $this->lastUpdate = $lastUpdate;
        }

        public function setCreateDate(string $createDate){
            $this->createDate = $createDate;
        }

        public function setRelationList(array $relationList){
            $this->relationList = $relationList;
        }

        public function setEventList(array $eventList){ // WARNING CHANGE TO EVENT CLASS
            $this->eventList = $eventList;
        }

        public function setDocumentList(array $documentList){ // WARNING CHANGE TO DOCUMENT CLASS
            $this->documentList = $documentList;
        }

        public function setPictureList(picture $pictureList){
            $this->pictureList = $pictureList;
        }

        public function setVideoList(array $videoList){ // WARNING CHANGE TO VIDEO CLASS
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

        
        
    }