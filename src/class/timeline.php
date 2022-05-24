<?php

    namespace class;
    // timeline for an ancestor
    class timeline{

        public function __construct(array $eventList){
            $this->eventList = $eventList;
        }

        /**
         * get array of eventList
         *
         * @return array
         */
        public function get():array{
            return $this->eventList;
        }

        // METHODE A CONTINUER DE DEVELOPPER
        public function getAsHTML():string{
            $eventList = array();
            foreach($this->eventList as $event){
                $html = "<li class='{$event->icon}'>";
                $html .= "{$event->date} &mdash; {$event->description} &mdash; {$event->accuracyLocation} {$event->city}";
                $html .= "</li>";
            }
            return "";
        }
        
        /**
         * Add event to timeline
         *
         * @param event $event
         * @return void
         */
        public function addEvent(event $event):void{
            $this->eventList[] = $event->get();
        }

    }