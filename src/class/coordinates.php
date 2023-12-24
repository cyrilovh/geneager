<?php
    namespace class;

    /**
     * Used to identify an ancestor in a photo or video.
     * X1,Y1: top left corner
     * X2,Y2: bottom right corner
     */
    class coordinates{
        protected int $x1; 
        protected int $y1;

        protected int $x2;
        protected int $y2;
        
        public function __construct(int $x1, int $y1, int $x2, int $y2)
        {
            $this->x1 = $x1;
            $this->y1 = $y1;
            $this->x2 = $x2;
            $this->y2 = $y2;
        }

        public function get():array{
            return array(
                'x1' => $this->x1,
                'y1' => $this->y1,
                'x2' => $this->x2,
                'y2' => $this->y2
            );
        }

        public function getString():string{
            return $this->x1.",".$this->y1.",".$this->x2.",".$this->y2;
        }

        public function getCSS():string{
            return "top:".$this->y1."px; left:".$this->x1."px; width:".($this->x2 - $this->x1)."px; height:".($this->y2 - $this->y1)."px;";
        }

    }
?>