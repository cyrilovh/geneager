<?php
    namespace class;
    // "Sub" class for timeline
    class event{

        public bool $html = false;

        private string $icon = "fas fa-location-dot";
        private string $date; // as string. ex: 202201, 20220101, 2022  (YM, YMD, Y)
        private ?string $title;
        private ?string $description;
        private ?int $cityID;
        private ?string $cityName;
        private ?string $locationAccuracy;
        private ?string $attachmentText;
        private ?string $attachmentLink; // URL to document or other media

        public function __construct(string $icon, string $date, ?string $title = null, ?string $description = null, ?int $cityID = null, ?string $cityName = null, ?string $locationAccuracy = null, ?string $attachmentText = null, ?string $attachmentLink = null){
            $this->icon = $icon;
            $this->date = $date;
            $this->title = $title;
            $this->description = $description;
            $this->cityID = $cityID;
            $this->cityName = $cityName;
            $this->locationAccuracy = $locationAccuracy;
            $this->attachmentText = $attachmentText;
            $this->attachmentLink = $attachmentLink;
        }

        // ADD GETERS AND SETERS
        public function getAll(){
            return [
                "icon" => $this->icon,
                "date" => $this->date,
                "title" => $this->title,
                "description" => $this->description,
                "cityID" => $this->cityID,
                "cityName" => $this->cityName,
                "locationAccuracy" => $this->locationAccuracy,
                "attachmentText" => $this->attachmentText,
                "attachmentLink" => $this->attachmentLink
            ];
        }



    }
?>