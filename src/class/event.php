<?php
    namespace class;
    // "Sub" class for timeline
    class event{

        public bool $html = false;
        public string $defaultIcon = "fas fa-location-dot";

        private ?int $id = 0;
        private string $icon = "fas fa-location-dot";
        private ?int $dayEvent;
        private ?int $monthEvent;
        private ?int $yearEvent;
        private ?string $title;
        private ?string $description;
        private ?int $cityID;
        private ?string $cityName;
        private ?string $locationAccuracy;
        private ?string $attachmentText; // text for link
        private ?string $attachmentLink; // URL to document or other media

        // string $icon, string $date, ?string $title = null, ?string $description = null, ?int $cityID = null, ?string $cityName = null, ?string $locationAccuracy = null, ?string $attachmentText = null, ?string $attachmentLink = null
        public function __construct(){
            $this->id = 0;
            $this->icon = null;
            $this->dayEvent = null;
            $this->monthEvent = null;
            $this->yearEvent = null;
            $this->title = null;
            $this->description = null;
            $this->cityID = null;
            $this->cityName = null;
            $this->locationAccuracy = null;
            $this->attachmentText = null;
            $this->attachmentLink = null;
        }

        // ADD GETERS AND SETERS
        public function getAll(){
            return [
                "id" => $this->id,
                "icon" => $this->icon,
                "date" => self::getDate(),
                "title" => $this->title,
                "description" => $this->description,
                "cityID" => $this->cityID,
                "cityName" => $this->cityName,
                "locationAccuracy" => $this->locationAccuracy,
                "attachmentText" => $this->attachmentText,
                "attachmentLink" => $this->attachmentLink
            ];
        }


        // GETTERS

        public function getID():int{
            return $this->id;
        }

        public function getIcon():string|null{
            return (validator::isNullOrEmpty($this->icon)) ? self::$defaultIcon : $this->icon;
        }

        public function getDate():string{
            $dateStr = format::strToDate(format::YMDtoStr($this->yearEvent, $this->monthEvent, $this->dayEvent));
            return $dateStr;
        }

        public function getTitle():string|null{
            return $this->title;
        }

        public function getDescription():string|null{
            return $this->description;
        }

        public function getCityID():int|null{
            return $this->cityID;
        }

        public function getCityName():string|null{
            return $this->cityName;
        }

        public function getLocationAccuracy():string|null{
            return $this->locationAccuracy;
        }

        public function getAttachmentText():string|null{
            return $this->attachmentText;
        }

        public function getAttachmentLink():string|null{
            return $this->attachmentLink;
        }

        public function getSource():string|null{
            $attachment = null;

            if(!is_null($this->attachmentText) && !is_null($this->attachmentLink)){
                $attachment = '<a href="'.$this->attachmentLink.'" target="_blank" class="btn btn-primary btn-sm"><span class="fas fa-link"></span> attachment: '.$this->attachmentText.'</a>';
            }elseif(!is_null($this->attachmentText)){
                $attachment = "<p>attachment:".$this->attachmentText."</p>";
            }elseif(!is_null($this->attachmentLink)){
                $attachment = '<a href="'.$this->attachmentLink.'" target="_blank" class="btn btn-primary btn-sm"><span class="fas fa-link"></span> attachment</a>';
            }

            return $attachment;
        }


        // SETTERS

        public function setID():void{
            $this->id = intval($this->id) + 1; // i use intval for fix eventual bug
        }

        public function setIcon(string $icon):void{
            $this->icon = (validator::isNullOrEmpty($icon)) ? self::$defaultIcon : $icon;
        }

        public function setDate(int $dayEvent, int $monthEvent, int $yearEvent):void{
            self::setDayEvent($dayEvent);
            self::setMonthEvent($monthEvent);
            self::setYearEvent($yearEvent);
        }

        public function setDayEvent(int $dayEvent):void{
            $this->dayEvent = (validator::isIntDay($dayEvent)) ? $dayEvent : NULL;
        }

        public function setMonthEvent(int $monthEvent):void{
            $this->monthEvent = (validator::isIntMonth($monthEvent)) ? $monthEvent : NULL;
        }

        public function setYearEvent(int $yearEvent):void{
            $this->yearEvent = (is_numeric($yearEvent)) ? $yearEvent : NULL;
        }

        public function setTitle(string $title):void{
            global $gng_paramList;
            $this->title = (validator::isNullOrEmpty($title)) ? $gng_paramList->get("untitleText") : $title;
        }

        public function setDescription(string $description):void{
            global $gng_paramList;
            $this->description = (validator::isNullOrEmpty($description)) ? $gng_paramList->get("noDescriptionText") : $description;
        }

        public function setCityID(int $cityID):void{
            $this->cityID = (is_numeric($cityID)) ? $cityID : NULL;
        }

        public function setCityName(string $cityName):void{
            $this->cityName = (validator::isNullOrEmpty($cityName)) ? NULL : $cityName;
        }

        public function setLocationAccuracy(string $locationAccuracy):void{
            $this->locationAccuracy = (validator::isNullOrEmpty($locationAccuracy)) ? NULL : $locationAccuracy;
        }

        public function setAttachmentText(string $attachmentText):void{
            $this->attachmentText = (validator::isNullOrEmpty($attachmentText)) ? NULL : $attachmentText;
        }

        public function setAttachmentLink(string $attachmentLink):void{
            $this->attachmentLink = (validator::isNullOrEmpty($attachmentLink)) ? NULL : $attachmentLink;
        }

        public getXXXXXXX(){
            return $this->XXXXXXX;
        }
        /**

        _____ ____  _   _ _______ _____ _   _ _    _ ______ _____  
        / ____/ __ \| \ | |__   __|_   _| \ | | |  | |  ____|  __ \ 
        | |   | |  | |  \| |  | |    | | |  \| | |  | | |__  | |__) |
        | |   | |  | | . ` |  | |    | | | . ` | |  | |  __| |  _  / 
        | |___| |__| | |\  |  | |   _| |_| |\  | |__| | |____| | \ \ 
        \_____\____/|_| \_|  |_|  |_____|_| \_|\____/|______|_|  \_\
                                                                    
                                                                    

        */



    }
?>