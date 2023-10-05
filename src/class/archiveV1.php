<?php
namespace class;

class archiveV1{
    public static ?bool $html = false;

    private int $id;
    private string  $filename;
    private ?string $title;
    private ?string $description;
    
    private ?string $cityID;
    private ?string $cityName;
    private ?string $accuracyLocation;
    private ?string $locationCountry;

    private ?string $yearEvent;
    private ?string $monthEvent;
    private ?string $dayEvent;
    
    private string $createDate;
    private string $author;

    private ?string $sourceText;
    private ?string $sourceLink;
    private ?string $callNumber;

    private ?array $tags; // table ancestorArchive

    public function __construct(int $id, string $filename, string $createDate, string $author)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->title = null;
        $this->description = null;
        $this->cityID = null;
        $this->cityName = null;
        $this->accuracyLocation = null;
        $this->locationCountry = null;
        $this->yearEvent = null;
        $this->monthEvent = null;
        $this->dayEvent = null;
        $this->createDate = $createDate;
        $this->author = $author;
        $this->sourceText = null;
        $this->sourceLink = null;
        $this->callNumber = null;
        $this->tags = null;  
    }

    // ADD SETTERS AND GETTERS
    public function getAll(){
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'title' => self::getTitle(),
            'description' => self::getDescription(),
            'cityID' => $this->cityID,
            'cityName' => $this->cityName,
            'locationCountry' => $this->locationCountry,
            'accuracyLocation' => $this->accuracyLocation,
            'yearEvent' => $this->yearEvent,
            'monthEvent' => $this->monthEvent,
            'dayEvent' => $this->dayEvent,
            'createDate' => $this->createDate,
            'author' => $this->author,
            'sourceText' => $this->sourceText,
            'sourceLink' => $this->sourceLink,
            'callNumber' => $this->callNumber,
            'tags' => $this->tags
        ];
    }

    public function setID(int $id):void{
        $this->id = $id;
    }

    public function setFilename(string $filename):void{
        $this->filename = $filename;
    }

    public function setTitle(string|null $title):void{
        $this->title = $title;
    }

    public function setDescription(string|null $description):void{
        $this->description = $description;
    }

    public function setCityID(string|null $cityID):void{
        $this->cityID = $cityID;
    }

    public function setCityName(string|null $cityName):void{
        $this->cityName = $cityName;
    }

    public function setAccuracyLocation(string|null $accuracyLocation):void{
        $this->accuracyLocation = $accuracyLocation;
    }

    public function setYearEvent(string|null $dateEvent):void{
        $this->yearEvent = $dateEvent;
    }

    public function setMonthEvent(string|null $monthEvent):void{
        $this->monthEvent = $monthEvent;
    }

    public function setDayEvent(string|null $dayEvent):void{
        $this->dayEvent = $dayEvent;
    }

    public function setCreateDate(string $createDate):void{
        $this->createDate = $createDate;
    }

    public function setAuthor(string $author):void{
        $this->author = $author;
    }

    public function setSourceText(string|null $sourceText):void{
        $this->sourceText = $sourceText;
    }

    public function setSourceLink(string|null $sourceLink):void{
        $this->sourceLink = $sourceLink;
    }

    public function setCallNumber(string|null $callNumber):void{
        $this->callNumber = $callNumber;
    }

    public function setTags(array|null $tags):void{
        $this->tags = $tags;
    }

    // AJOUTER GETTERS ET VOIR POUR METHOD addTag()

    public function getID():int{
        return $this->id;
    }

    public function getFilename():string{
        return $this->filename;
    }

    public function getTitle():?string{
        global $gng_paramList;
        return ($this->title == null) ? $gng_paramList->get("untitleText") : $this->title;
    }

    public function getDescription():?string{
        global $gng_paramList;
        return ($this->description == null) ? $gng_paramList->get("noDescriptionText") : $this->description;
    }

    public function getCityID():?string{
        return $this->cityID;
    }

    public function getCityName():?string{
        return $this->cityName;
    }

    public function getAccuracyLocation():?string{
        return $this->accuracyLocation;
    }

    public function getFullLocation():?string{
        $location = null;

        if(!is_null($this->accuracyLocation)){
            $location = $this->accuracyLocation;
        }

        if(!is_null($this->cityName)){
            $location .= (!is_null($location)) ? ', ' : '';
            $location = $this->cityName;
        }

        if(!is_null($this->locationCountry)){
            $location .= (!is_null($location)) ? ', ' : '';
            $location = $this->locationCountry;
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
    public function getSource():?string{
        $source = null;
        $cote = (!is_null($this->callNumber)) ? " (C&ocirc;te: ".$this->callNumber.")" : "";
        if(!is_null($this->sourceText) && !is_null($this->sourceLink)){
            $source = "<a href='".$this->sourceLink."' target='_blank' class='btn btn-primary btn-sm'><span class='fas fa-link'></span> Source: $this->sourceText $cote</a>";
        }elseif(!is_null($this->sourceText)){
            $source = "<p>Source: $this->sourceText $cote</p>";
        }elseif(!is_null($this->sourceLink)){
            $source = "<a href='$this->sourceLink' target='_blank' class='btn btn-primary btn-sm'><span class='fas fa-link'></span> Source $cote</a>";
        }

        return $source;
    }

    /**
     * Retrieves photo identifiers (contact details, identity, etc.)
     */
    public function getTagList():array|null{
        if(!self::$html){
            return $this->tags;
        }else{
            if(!is_null($this->tags)){
                $tags = "<p><span class='fa-solid fa-user'></span> ";
                foreach($this->tags as $tag){
                    $ancestor = new ancestor($tag);
                    $identity = $ancestor->getFullIdentity(false);
                    $idAncestor = $tag["ancestorID"];
                    $identityLink = "<a href='/ancestor/$idAncestor'>$identity</a>";
                    $tags .= "<span class='badge badge-primary'>$identityLink</span> ";
                }
                $tags .= "</p>";
                return $tags;
            }else{
                return "";
            }
        }
    }

}