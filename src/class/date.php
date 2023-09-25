<?php
    namespace class;

    class date{
        // 0 = null or unknown
        private int $year = 0;
        private int $month = 0;
        private int $day = 0;

        public function __construct(int $year, int $month, int $day){
            $this->year = $year;
            $this->month = $month;
            $this->day = $day;
        }

        /**
         *  Check if date exist
          * example: 2018-06-31 (YMD) returns false (there 30 days in June)
         *  @return boolean
         */
        private function isDate():bool{
            if(checkdate($this->month, $this->day, $this->year)){
                return true;
            }
            return false;
        }

        private function dateToStr():string{
            $monthArr = array(
                "01" => "Janvier",
                "02" => "Février",
                "03" => "Mars",
                "04" => "Avril",
                "05" => "Mai",
                "06" => "Juin",
                "07" => "Juillet",
                "08" => "Août",
                "09" => "Septembre",
                "10" => "Octobre",
                "11" => "Novembre",
                "12" => "Décembre"
            );

            return $this->day." ".$monthArr[$this->month]." ".$this->year;
        }

        private function partialDateToStr(){
            global $gng_paramList;
            $day = ($this->day == 0) ? "??" : $this->day;
            $month = ($this->month == 0) ? "??" : $this->month;
            $year = ($this->year == 0) ? "??" : $this->year;
            if($day == "??" && $month == "??" && $year == "??"){
                return $gng_paramList->get("noDateText");
            }
            return $day."/".$month."/".$year;
        }

        /**
         * return true is the string is a valid number month
         *
         * @param integer|string $month
         * @return boolean
         */
        public static function isIntMonth(int|string $month):bool{
            if(is_numeric($month)){
                if($month >= 1 && $month <= 12){
                    return true;
                }
            }
            return false;
        }

        public static function isIntDay(int|string $day):bool{
            if(is_numeric($day)){
                if($day >= 1 && $day <= 31){
                    return true;
                }
            }
            return false;
        }

        public function getYear():int{
            return $this->year;
        }

        public function getMonth():int{
            return $this->month;
        }

        public function getDay():int{
            return $this->day;
        }

        public function getDate():string{
            if($this->isDate()){
                return $this->dateToStr();
            }else{
                return $this->partialDateToStr();
            }
        }

        public function setYear(int $year){
            $this->year = $year;
        }

        public function setMonth(int $month){
            $this->month = (self::isIntMonth($month)) ? $month : 0;
        }

        public function setDay(int $day){
            $this->day = (self::isIntDay($day)) ? $day : 0;
        }


    }
