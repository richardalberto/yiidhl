<?php

/**
 * This is the model class "DHLOrderInfo".
 */
class DHLOrderInfo
{
    // awb info
    public $number;
    public $status;
    
    // shipment info
    public $originServiceArea;
    public $destinationServiceArea;
    public $shipperAccountNumber;
    public $pieces;
    public $weight;
    public $weightUnit;
    public $globalProductCode;
    public $shipmentDesc;
    public $dlvyNotificationFlag;
    public $shipper;
    public $consignee;
    
    // events array
    public $events = array();    
    
    public function addEvent($event){
        $this->events[] = $event;
    }
}