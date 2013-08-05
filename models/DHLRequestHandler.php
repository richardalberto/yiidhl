<?php
class DHLRequestHandler extends DHLXmlPiManager {        

    function bookRequest() {
        // retrive xml from view
        $this->_xml = $this->retrieveXmlFromView('bookRequest');
        
        // make request & parse
        $abi = simplexml_load_string($this->sendCallPI());
        
        var_dump($abi); die();
        
        // return null on order not found
        if(!$abi)
            return null;
        elseif(isset($abi->Response->Status) && $abi->Response->Status == DHLTracker::STATUS_FAILURE)
            return null;
        elseif($abi->AWBInfo->Status->ActionStatus == DHLTracker::STATUS_NO_SHIPMENT_FOUND)
            return null;
        
        $awb = new DHLOrderInfo;        
        // data
        $awb->number = (string) $abi->AWBInfo->AWBNumber;
        $awb->status = (string) $abi->AWBInfo->Status->ActionStatus;
        $awb->originServiceArea = (string) $abi->AWBInfo->ShipmentInfo->OriginServiceArea->Description;
        $awb->destinationServiceArea = (string) $abi->AWBInfo->ShipmentInfo->DestinationServiceArea->Description;
        $awb->shipper = new Shipper(
            (string) $abi->AWBInfo->ShipmentInfo->ShipperName,
            (string) $abi->AWBInfo->ShipmentInfo->ShipperReference->ReferenceID,
            (string) $abi->AWBInfo->ShipmentInfo->Shipper->City,
            (string) $abi->AWBInfo->ShipmentInfo->Shipper->DivisionCode,
            (string) $abi->AWBInfo->ShipmentInfo->Shipper->PostalCode,
            (string) $abi->AWBInfo->ShipmentInfo->Shipper->CountryCode
        );
        $awb->consignee = new Consignee(
            (string) $abi->AWBInfo->ShipmentInfo->ConsigneeName,
            (string) $abi->AWBInfo->ShipmentInfo->Consignee->City,
            (string) $abi->AWBInfo->ShipmentInfo->Consignee->PostalCode,
            (string) $abi->AWBInfo->ShipmentInfo->Consignee->CountryCode
        );
        $awb->shipperAccountNumber = (string) $abi->AWBInfo->ShipmentInfo->ShipperAccountNumber;
        $awb->pieces = (string) $abi->AWBInfo->ShipmentInfo->Pieces;
        $awb->weight = (string) $abi->AWBInfo->ShipmentInfo->Weight;
        $awb->weightUnit = (string) $abi->AWBInfo->ShipmentInfo->WeightUnit;
        $awb->weightUnit = (string) $abi->AWBInfo->ShipmentInfo->WeightUnit;
        $awb->globalProductCode = (string) $abi->AWBInfo->ShipmentInfo->GlobalProductCode;
        $awb->shipmentDesc = (string) $abi->AWBInfo->ShipmentInfo->ShipmentDesc;
        $awb->dlvyNotificationFlag = (string) $abi->AWBInfo->ShipmentInfo->DlvyNotificationFlag;
        
        // events
        $events = $abi->AWBInfo->ShipmentInfo->ShipmentEvent;
        if(count($events) > 0){
            foreach($events as $e){
                $event = new ShipmentEvent(
                        (string) $e->Date, 
                        (string) $e->Time, 
                        (string) $e->ServiceEvent->Description, 
                        (string) $e->Signatory, 
                        (string) $e->ServiceArea->Description
                );
                
                $awb->addEvent($event);
            }
        }
        
        return $awb;
    }
}

?>