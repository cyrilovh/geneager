<?php
    namespace class;

    class video extends document{
        public static $html = true;

        public function __construct(int $id, string $filename, string $createDate, string $author, folder $folder)
        {
            parent::__construct($id, $filename, $createDate, $author);
        }

    }