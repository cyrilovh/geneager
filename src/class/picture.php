<?php
    namespace class;

    class picture extends document{
        public static ?bool $html = true;

        public function __construct(int $id, string $filename, string $createDate, string $author)
        {
            parent::__construct($id, $filename, $createDate, $author);
        }
    }

?>