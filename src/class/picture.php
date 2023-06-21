<?php
    namespace class;

    class picture{

        public static $html = true;

        private ?int $id;
        private string $title;
        private ?string $descript;
        private ?string $filename;
        private ?string $author;        
        private ?int $locationID;
        private ?string $locationCity;
        private ?string $locationStateDepartement;
        private ?string $locationCountry;
        private ?string $accuracyLocation;
        private ?int $yearEvent;
        private ?int $monthEvent;
        private ?int $dayEvent;
        private ?string $sourceText;
        private ?string $sourceLink;
        private ?int $folderID;
        private ?string $folderTitle;
        private ?string $lastUpdate;
        private ?string $createDate;

        public function __construct(int $id, string $filename, string $createDate, string $author){
            global $gng_paramList;

            $this->id = $id;
            $this->title = $gng_paramList->get("untitleText");
            $this->descript = $gng_paramList->get("noDescriptionText");
            $this->filename = $filename;
            $this->author = $author;
            $this->locationID = null;
            $this->locationCity = null;
            $this->locationStateDepartement = null;
            $this->locationCountry = null;
            $this->accuracyLocation = null;
            $this->yearEvent = null;
            $this->monthEvent = null;
            $this->dayEvent = null;
            $this->sourceText = null;
            $this->sourceLink = null;
            $this->folderID = null;
            $this->folderTitle = null;
            $this->lastUpdate = null;
            $this->createDate = $createDate;
        }

        /* SETTERS */

        public function setID(int $id):void{
            $this->id = $id;
        }

        public function setTitle(string|null $title):void{
            if(!is_null($title)){
                $this->title = $title;
            }
        }

        public function setDescript(string|null $descript):void{
            $this->descript = $descript;
        }

        public function setFilename(string $filename):void{
            $this->filename = $filename;
        }

        public function setAuthor(string $author):void{
            $this->author = $author;
        }

        public function setLocationID(int|null $locationID):void{
            $this->locationID = $locationID;
        }

        public function setLocationCity(string|null $locationCity):void{
            $this->locationCity = $locationCity;
        }

        public function setLocationStateDepartement(string|null $locationStateDepartement):void{
            $this->locationStateDepartement = $locationStateDepartement;
        }

        public function setLocationCountry(string|null $locationCountry):void{
            $this->locationCountry = $locationCountry;
        }

        public function setAccuracyLocation(string|null $accuracyLocation):void{
            $this->accuracyLocation = $accuracyLocation;
        }

        public function setYearEvent(int|null $yearEvent):void{
            $this->yearEvent = $yearEvent;
        }

        public function setMonthEvent(int|null $monthEvent):void{
            $this->monthEvent = $monthEvent;
        }

        public function setDayEvent(int|null $dayEvent):void{
            $this->dayEvent = $dayEvent;
        }

        public function setSourceText(string|null $sourceText):void{
            $this->sourceText = $sourceText;
        }

        public function setSourceLink(string|null $sourceLink):void{
            $this->sourceLink = $sourceLink;
        }

        public function setFolderID(int $folderID):void{
            $this->folderID = $folderID;
        }

        public function setFolderTitle(string $folderTitle):void{
            $this->folderTitle = $folderTitle;
        }

        public function setLastUpdate(string $lastUpdate):void{
            $this->lastUpdate = $lastUpdate;
        }

        public function setCreateDate(string $createDate):void{
            $this->createDate = $createDate;
        }

        /* GETTERS */

        public function getID():int{
            return $this->id;
        }

        public function getTitle():string|null{
            if(is_null($this->title)){
                return null;
            }
            return (self::$html) ? "<h1><i class='fas fa-heading'></i> ".htmlentities($this->title, ENT_QUOTES, ENCODE)."</h1>" : $this->title;
        }

        public function getDescript():string|null{
            if(is_null($this->descript)){
                return null;
            }
            return (self::$html) ? "<p><i class='fa-solid fa-align-left'></i> ".htmlentities($this->descript, ENT_QUOTES, ENCODE)."</p>" : $this->descript;
        }

        public function getFilename():string{
            return $this->filename;
        }

        public function getAuthor():string|null{
            global $gng_paramList;
            $author = (is_null($this->author)) ? $gng_paramList->get("undefinedText") : $this->author;
            return (self::$html) ? "<p><i class='fas fa-user'></i>$author</p>" : $author;
        }

        public function getLocationID():int|null{
            return $this->locationID;
        }

        public function getLocationCity():string|null{
            return $this->locationCity;
        }

        public function getLocationStateDepartement():string|null{
            return $this->locationStateDepartement;
        }

        public function getLocationCountry():string|null{
            return $this->locationCountry;
        }

        public function getAccuracyLocation():string|null{
            return $this->accuracyLocation;
        }

        public function getYearEvent():int|null|string{
            return (self::$html) ? "<p><i class='fas fa-calendar-days'></i> ".htmlspecialchars($this->yearEvent)."</p>" : $this->yearEvent;
        }

        public function getMonthEvent():int|null{
            return $this->monthEvent;
        }

        public function getDayEvent():int|null{
            return $this->dayEvent;
        }

        public function getSourceText():string|null{
            return $this->sourceText;
        }

        public function getSourceLink():string|null{
            return $this->sourceLink;
        }

        public function getFolderID():int{
            return $this->folderID;
        }

        public function getFolderTitle():string{
            return (self::$html) ? "<p ><a href='/userPictureList/".$this->folderID."'><i class='fas fa-folder'></i> ".htmlspecialchars($this->folderTitle)."</a></p>" : $this->folderTitle;
        }

        public function getLastUpdate():string|null{
            return $this->lastUpdate;
        }

        public function getCreateDate():string{
            return $this->createDate;
        }

        /* ADVANCED GETTERS */

        /**
         * Get the full location of the event
         *
         * @return string|null
         */
        public function getFullLocation():string|null{
            $location = null;

            if(!is_null($this->accuracyLocation)){
                $location = $this->accuracyLocation;
            }
            
            if(!is_null($this->locationCity)){
                $location .= (!is_null($location)) ? ', ' : '';
                $location .= $this->locationCity;
            }
            if(!is_null($this->locationStateDepartement)){
                $location .= (!is_null($location)) ? ', ' : '';
                $location .= $this->locationStateDepartement;
            }
            if(!is_null($this->locationCountry)){
                $location .= (!is_null($location)) ? ', ' : '';
                $location .= $this->locationCountry;
            }

            if(self::$html && !is_null($location)){
                return '<p><span class="fa-solid fa-location-dot"></span> '.$location.'</p>';
            }else{
                return $location;
            }
        }

        /**
         * Get the date of the event as default format (ex: YMD)
         *
         * @return string|null
         */
        public function getDateEvent():string|int{
            global $gng_paramList;
            $date = format::strToDate(format::YMDtoStr($this->yearEvent, $this->monthEvent, $this->dayEvent));
            $date = is_null($date) ? $gng_paramList->get("undefinedText"): $date; 
            return (self::$html) ? "<p><i class='fas fa-calendar-days'></i> ".$date."</p>" : $date;
        }

        /**
         * Get the source of the event
         *
         * @return string|null
         */
        public function getSource():string|null{
            $source = null;

            if(!is_null($this->sourceText) && !is_null($this->sourceLink)){
                $source = '<a href="'.$this->sourceLink.'" target="_blank" class="btn btn-primary btn-sm"><span class="fas fa-link"></span> Source: '.$this->sourceText.'</a>';
            }elseif(!is_null($this->sourceText)){
                $source = "<p>Source:".$this->sourceText."</p>";
            }elseif(!is_null($this->sourceLink)){
                $source = '<a href="'.$this->sourceLink.'" target="_blank" class="btn btn-primary btn-sm"><span class="fas fa-link"></span> Source</a>';
            }

            return $source;
        }

        /**
         * Get the picture of the event as HTML format automatically
         *
         * @return string
         */
        public function getPicture():string{
            return '<img src="/picture/family/'.$this->filename.'" style="max-width:100vw;">';
        }
    }