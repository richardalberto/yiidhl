<?php

/**
 * This is the model class "AWBInfo".
 */
class AWBInfo extends CModel
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
    
    public function attributeNames() {
        return array();
    }
}