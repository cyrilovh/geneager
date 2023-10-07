<?php
namespace class;

class archive extends document{
    protected ?string $callNumber;

    public function __construct(int $id, string $filename, string $createDate, string $author)
    {
        parent::__construct($id, $filename, $createDate, $author);
        $this->callNumber = null;
    }

    public function setCallNumber(string $callNumber):void{
        $this->callNumber = $callNumber;
    }

    public function getCallNumber():?string{
        return $this->callNumber;
    }

    public function getAll(){
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'title' => $this->title,
            'description' => $this->description,
            'folder' => $this->folder,
            'event' => $this->event,
            'tags' => $this->tags,
            'author' => $this->author,
            'createDate' => $this->createDate,
            'lastUpdate' => $this->lastUpdate,
            'callNumber' => $this->callNumber,
        ];
    }
}