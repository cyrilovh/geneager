<?php
namespace class;

class document{
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





}