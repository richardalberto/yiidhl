<?php

/**
 * This is the model class "ShipmentEvent".
 */
class ShipmentEvent
{
    public $date;
    public $time;
    public $serviceEvent;
    public $signatory;
    public $serviceArea;
    
    public function ShipmentEvent($date, $time, $serviceEvent, $signatory, $serviceArea){
        $this->date = $date;
        $this->time = $time;
        $this->serviceEvent = $serviceEvent;
        $this->signatory = $signatory;
        $this->serviceArea = $serviceArea;
    }
}