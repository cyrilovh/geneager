<?php
    namespace class;

    class picture extends document{
        public static $html = true;

        protected folder $folder;

        public function __construct(int $id, string $filename, string $createDate, string $author, folder $folder)
        {
            parent::__construct($id, $filename, $createDate, $author);
            $this->folder = $folder;
        }

        public function setFolder(folder $folder):void{
            $this->folder = $folder;
        }

        public function getFolder():folder{
            return $this->folder;
        }
    }