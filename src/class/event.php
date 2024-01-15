<?php
    namespace class;
  
    class event{

        public static ?bool $html = false;
        public static string $defaultIcon = "fas fa-location-dot";

        private ?int $id = 0;
        private string $icon = "fas fa-location-dot";
        private ?date $date;
        private ?string $title;
        private ?string $description;
        private ?location $location;
        private ?string $attachmentText; // text for link
        private ?string $attachmentLink; // URL to document or other media

        public function __construct(?string $title = null, ?date $date = null, ?location $location = null){
            $this->id = 0;
            $this->icon = self::$defaultIcon;
            $this->date = $date;
            $this->title = $title;
            $this->description = null;
            $this->location = $location;
            $this->attachmentText = null;
            $this->attachmentLink = null;
        }

        public function getAll(){
            return [
                "id" => $this->id,
                "icon" => $this->icon,
                "date" => self::getDate(),
                "title" => $this->title,
                "description" => $this->description,
                "location" => $this->location,
                "attachmentText" => $this->attachmentText,
                "attachmentLink" => $this->attachmentLink
            ];
        }

        // GETTERS
        public function getID():int{
            return $this->id;
        }

        public function getIcon():?string{
            return (validator::isNullOrEmpty($this->icon)) ? self::$defaultIcon : $this->icon;
        }

        public function getDate():string{
            return $this->date->getDate();
        }

        public function getYearStr():?int{
            return $this->date->getYear();
        }

        public function getTitle():?string{
            return $this->title;
        }

        public function getDescription():?string{
            return $this->description;
        }

        public function getLocation():location|null{
            return $this->location;
        }

        public function getAttachmentText():?string{
            return $this->attachmentText;
        }

        public function getAttachmentLink():?string{
            return $this->attachmentLink;
        }

        public function getSource():?string{
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

        public function setDate(date $date):void{
            $this->date = $date;
        }

        public function setTitle(string $title):void{
            global $gng_paramList;
            $this->title = (validator::isNullOrEmpty($title)) ? $gng_paramList->get("untitleText") : $title;
        }

        public function setDescription(string $description):void{
            global $gng_paramList;
            $this->description = (validator::isNullOrEmpty($description)) ? $gng_paramList->get("noDescriptionText") : $description;
        }

        public function setLocation(location $location):void{
            $this->location = $location;
        }

        public function setAttachmentText(string $attachmentText):void{
            $this->attachmentText = (validator::isNullOrEmpty($attachmentText)) ? NULL : $attachmentText;
        }

        public function setAttachmentLink(string $attachmentLink):void{
            $this->attachmentLink = (validator::isNullOrEmpty($attachmentLink)) ? NULL : $attachmentLink;
        }
    }
?>