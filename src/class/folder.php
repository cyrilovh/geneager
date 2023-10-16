<?php
    namespace class;

    class folder{
        private int $id;
        private ?string $title;
        private ?string $descript;
        private string $author;
        private ?string $cover;
        private string $createDate;
        private ?string $lastUpdate;
        private bool $publicVisibility;
        // private (type) $picture/$pictureList;

        public function __construct(int $id, string  $author, string $createDate, string $lastUpdate){
            $this->id = $id;
            $this->title = null;
            $this->descript = null;
            $this->author = $author;
            $this->cover = null;
            $this->createDate = $createDate;
            $this->lastUpdate = null;
            $this->publicVisibility = false;
        }

        public function setID(int $id):void{
            $this->id = $id;
        }

        public function setTitle(string $title):void{
            $this->title = $title;
        }

        public function setDescript(string $descript):void{
            $this->descript = $descript;
        }

        public function setAuthor(string $author):void{
            $this->author = $author;
        }

        public function setCover(?string $cover):void{
            $this->cover = $cover;
        }

        public function setCreateDate(string $createDate):void{
            $this->createDate = $createDate;
        }

        public function setLastUpdate(string $lastUpdate):void{
            $this->lastUpdate = $lastUpdate;
        }

        public function setPublicVisibility(bool $publicVisibility):void{
            $this->publicVisibility = $publicVisibility;
        }

        // GETTERS

        public function getID():int{
            return $this->id;
        }

        public function getTitle():?string{
            return $this->title;
        }

        public function getDescript():?string{
            return $this->descript;
        }

        public function getAuthor():string{
            return $this->author;
        }

        public function getCover():?string{
            return $this->cover;
        }

        public function getCreateDate():string{
            return $this->createDate;
        }

        public function getLastUpdate():?string{
            return $this->lastUpdate;
        }

        public function getPublicVisibility():bool{
            return $this->publicVisibility;
        }
        
    }