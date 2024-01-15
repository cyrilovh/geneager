<?php
    namespace class;

    class ancestor{
        public static ?bool $html = false;

        private int $id;
        private ?string $firstNameList;
        private ?string $lastNameList;
        private ?string $otherIdentityList;
        private ?string $marriedNameList;
        private ?string $birthNameList;
        private ?string $nickNameList;

        private ?string $photo;
        private ?int $gender;

        private ?string $biography;

        private ?event $birth;
        private ?event $death;
        private ?location $cemetery;

        private ?string $author;
        private ?string $lastUpdate;
        private ?string $createDate;

        private ?array $relationList; // array of array: array( array("idRelationship"=> 0, "idAncestor"=> 0, "strRelashipType" => "uncle"),  ... )
        private ?array $eventList; //   special class event ???
        private ?array $archiveList; // object archive ???
        private ?array $pictureList; // object picture ???
        private ?array $videoList; // Object video ???
        
        public function __construct(int $id)
        {
            $this->id = $id;
            $this->firstNameList = null;
            $this->lastNameList = null;
            $this->marriedNameList = null;
            $this->birthNameList = null;
            $this->nickNameList = null;
            $this->otherIdentityList = null;

            $this->photo = null;
            $this->gender = null;

            $this->biography = null;

            $this->birth = null;
            $this->death = null;
            $this->cemetery = null;

            $this->author = null;
            $this->createDate = null;
            $this->lastUpdate = null;

            $this->relationList = array();
            $this->eventList = array();
            $this->archiveList = array();
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

        public function setMarriedNameList(string|null $marriedNameList):void{
            $this->marriedNameList = $marriedNameList;
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

        public function setarchiveList(array $archiveList):void{ // WARNING CHANGE TO DOCUMENT CLASS
            $this->archiveList = $archiveList;
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

        public function getFirstNameList():?string{
            return format::htmlToUpperFirst($this->firstNameList, self::$html);
        }

        public function getlastNameList():?string{
            return format::htmlToUpper($this->lastNameList, self::$html);
        }

        public function getBirthNameList():?string{
            return format::htmlToUpper($this->birthNameList, self::$html);
        }

        public function getMarriedNameList():?string{
            return format::htmlToUpper($this->marriedNameList, self::$html);
        }

        public function getotherIdentityList():?string{
            return format::htmlToUpper($this->otherIdentityList, self::$html);
        }

        public function getNickNameList():?string{
            return format::htmlToUpperFirst($this->nickNameList, self::$html);
        }

        /**
         * Give standard identity of the ancestor (firstnames, lastnames, birthname, marriedname and nicknames)
         * can be used for search
         * @return string|null
         */
        public function getFullIdentityUnformatted():?string
        {
            $allNames = array_filter([
                $this->firstNameList,
                $this->lastNameList,
                $this->birthNameList,
                $this->marriedNameList,
                $this->otherIdentityList,
                $this->nickNameList
            ]);
            return implode(" ", $allNames);
        }

        /**
         * Give standard identity of the ancestor (firstnames, lastnames, birthname, marriedname)
         * firstnames = prénoms
         * lastnames = noms de famille/JF
         * birthname = nom de naissance (né sous un autre nom, pb orthographe, ...)
         * marriedname = nom marital
         * @param boolean $html
         * @return string
         */
        public function getFullIdentityDisplay(bool $html = true): string
        {
            $allNames = array_filter([
                format::htmlToUpperFirst($this->firstNameList, $html),
                format::htmlToUpper($this->lastNameList, $html),
                format::htmlToUpper($this->birthNameList, $html),
                format::htmlToUpper($this->marriedNameList, $html)
            ]);
        
            return $allNames ? implode(" ", $allNames) : "Anonyme";
        }

        /**
         * Return same as getFullIdentityDisplay but with shorter 2nd, 3rd [...] lastname
         * example Pierre Richard Freddy JACKSON => Pierre R. F. JACKSON
         *
         * @param boolean $html
         * @return string
         */
        public function getFullIdentityDisplayShorter(bool $htmlFormat = true): string
        {
            $allNames = [];
        
            if (!validator::isNullOrEmpty($this->firstNameList)) {
                $lastNamesListArr = explode(" ", $this->lastNameList);
                foreach ($lastNamesListArr as $i => $lastName) {
                    $allNames[] = ($i === 0)
                        ? format::htmlToUpperFirst($lastName, $htmlFormat)
                        : substr(format::htmlToUpper($lastName, $htmlFormat), 0, 1) . ".";
                }
            }
        
            $allNames[] = format::htmlToUpper($this->lastNameList, $htmlFormat);
            $allNames[] = format::htmlToUpper($this->birthNameList, $htmlFormat);
            $allNames[] = format::htmlToUpper($this->marriedNameList, $htmlFormat);
        
            return $allNames ? implode(" ", $allNames) : "Anonyme";
        }

        public function getPhoto():?string{
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

        public function getBiography():?string{
            return format::htmlToUpperFirst($this->biography, self::$html);
        }

        public function getBirth():?event{
            return $this->birth;
        }

        public function getDeath():?event{
            return $this->death;
        }

        public function getCemetery():?location{
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
        

        /**
         * Return basic information of the ancestor as ARRAY
         * In particular for JSON response: $json->addData( $ancestorObj->getBasicAsArray() );
         * 
         * @return array
         */
        public function getBasicAsArray(): array {
            $birthYear = !is_null($this->getBirth()->getYear()) ? strval($this->getBirth()->getYear()) : "???";
            $deathYear = !is_null($this->getDeath()->getYear()) ? strval($this->getDeath()->getYear()) : "???";

            return array(
                "id" => $this->getID(),
                "picture" => $this->getPhoto(),
                "identity" => $this->getFullIdentityDisplayShorter(),
                "birthYear" => $birthYear,
                "deathYear" => $deathYear
            );
        }
        
    }
?>