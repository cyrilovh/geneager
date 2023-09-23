<?php
namespace class;
/**
 * This class permit to manage timeline
 * In other words:
 * - sort events
 * - display events as HTML format or as Object (POO)
 */
class timeline{
    private array $eventList;

    public function __construct(){
        $this->eventList = [];
    }

    /**
     * Sort events by date (ASC) (from oldest to newest)
     *
     * @return void
     */
    public function ksortByDate():void{
        usort($this->eventList, function($a, $b){
            return $a->getDate() <=> $b->getDate();
        });
    }

    /**
     * Add event to timeline
     *
     * @param event $event
     * @return void
     */
    public function addEvent(event $event):void{
        $this->eventList[] = $event;
    }

    /**
     * Get all events
     *
     * @return array
     */
    public function getEventList():array{
        return $this->eventList;
    }

    /**
     * Get event by index
     *
     * @param integer $index
     * @return event
     */
    public function getEventByIndex(int $index):event{
        return $this->eventList[$index];
    }

    public function genHTMLTimeline():string{
        *** CODE ***
    }

}
?>