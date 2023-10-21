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
    protected ?folder $folder;
    protected ?event $event;
    protected ?array $tags; // ID ancestor identified in this document (picture, archive, ...)
    protected string $author;
    protected ?source $source;
    protected date $createDate;
    protected ?date$lastUpdate;


    public function __construct(int $id, string $filename, date $createDate, string $author)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->title = null;
        $this->description = null;
        $this->folder = null;
        $this->event = null;
        $this->tags = null;
        $this->author = $author;
        $this->source = null;
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

    public function setTitle(?string $title):void{
        $this->title = $title;
    }

    public function setDescription(?string $description):void{
        $this->description = $description;
    }

    public function setFolder(folder $folder):void{
        $this->folder = $folder;
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

    public function setSource(source $source):void{
        $this->source = $source;
    }

    public function setCreateDate(date $createDate):void{
        $this->createDate = $createDate;
    }

    public function setLastUpdate(?date $lastUpdate):void{
        $this->lastUpdate = $lastUpdate;
    }

    // GETTERS


    public function getID():int{
        return $this->id;
    }

    public function getFilename():string{
        return $this->filename;
    }

    public function getTitle():?string{
        global $gng_paramList;
        return is_null($this->title) ? $gng_paramList->get("untitleText") : $this->title;
    }

    public function getDescription():?string{
        global $gng_paramList;
        return is_null($this->description) ? $gng_paramList->get("noDescriptionText") : $this->description;
    }

    public function getFolder():?folder{
        return $this->folder;
    }

    public function getEvent():?event{
        return $this->event;
    }

    public function getTags():?array{
        return $this->tags;
    }

    public function getAuthor():string{
        return $this->author;
    }

    public function getSource():?source{
        return $this->source;
    }

    public function getCreateDate():date{
        return $this->createDate;
    }

    public function getLastUpdate():?date{
        return $this->lastUpdate;
    }
}