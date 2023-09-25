<?php
namespace class;

/**
 * Abstract class for all documents (archive, picture, video, ...)
 */
abstract class document{
    public static ?bool $html = false;

    protected int $id;
    protected string  $filename;
    protected ?string $title;
    protected ?string $description;
    protected ?event $event;
    protected ?array $tags; // ID ancestor identified in this document (picture, archive, ...)
    protected string $author;
    protected string $createDate;
    protected ?string $lastUpdate;


    public function __construct(int $id, string $filename, string $createDate, string $author)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->title = null;
        $this->description = null;
        $this->event = null;
        $this->tags = null;
        $this->author = $author;
        $this->createDate = $createDate;
        $this->lastUpdate = null;
    }

    // SETTERS
    public function setID(int $id):void{
        $this->id = $id;
    }

    public function setFilename(string $filename):void{
        $this->filename = $filename;
    }

    public function setTitle(string $title):void{
        $this->title = $title;
    }

    public function setDescription(string $description):void{
        $this->description = $description;
    }
    
    public function setEvent(event $event):void{
        $this->event = $event;
    }

    /**
     * set the tags of the document as array
     *
     * @param array $tags
     * @return void
     */
    public function setTags(array $tags):void{
        $this->tags = $tags;
    }

    /**
     * Add a tag to the document (in array)
     *
     * @param integer $tagID
     * @return void
     */
    public function addTag(int $tagID):void{
        $this->tags[] = $tagID;
    }

    public function setAuthor(string $author):void{
        $this->author = $author;
    }

    // DATE POO -----> TYPAGE
}