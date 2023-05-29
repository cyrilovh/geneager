<?php
namespace class;

class document{
    public static ?bool $html = false;

    private int $id;
    private string  $filename;
    private ?string $title;
    private ?string $description;
    
    private ?string $cityID;
    private ?string $cityName;
    private ?string $accuracyLocation;

    private ?string $dateEvent;
    
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
        $this->dateEvent = null;
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
            'title' => $this->title,
            'description' => $this->description,
            'cityID' => $this->cityID,
            'cityName' => $this->cityName,
            'accuracyLocation' => $this->accuracyLocation,
            'dateEvent' => $this->dateEvent,
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

    public function setDateEvent(string|null $dateEvent):void{
        $this->dateEvent = $dateEvent;
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


}