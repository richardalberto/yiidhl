<?php

class DHLCapabilityAndQuoteHandler extends DHLXmlPiManager {

    function queryCapability($options) {
        // retrive xml from view
        $this->_xml = $this->retrieveXmlFromView('capabilityRequest', $options);
        
        // make request & parse
        $response = simplexml_load_string($this->sendCallPI());
        
        // return null on order not found
        if (!$response)
            return null;
        elseif(isset($response->Response) && isset($response->Response->Status) && $response->Response->Status->ActionStatus == 'Error')
            return null;
        elseif(isset($response->Response) && isset($response->Response->Note) && isset($response->Response->Note))
            return null;

        $dhlCapabilityResponse = new DHLCapabilityResponse;

        // add services
        $srvs = $response->GetCapabilityResponse->BkgDetails->QtdShp;
        foreach ($srvs as $srv) {
            $service = new DHLService();
            $service->globalProductCode = (string) $srv->GlobalProductCode;
            $service->localProductCode = (string) $srv->LocalProductCode;
            $service->productShortName = (string) $srv->ProductShortName;
            $service->localProductName = (string) $srv->LocalProductName;
            $service->networkTypeCode = (string) $srv->NetworkTypeCode;
            $service->pOfferedCustAgreement = (string) $srv->POfferedCustAgreement;
            $service->transInd = (string) $srv->TransInd;
            $service->pickupDate = (string) $srv->PickupDate;
            $service->pickupCutoffTime = (string) $srv->PickupCutoffTime;
            $service->bookingTime = (string) $srv->BookingTime;
            $service->TotalTransitDays = (int) $srv->TotalTransitDays;
            $service->pickupPostalLocAddDays = (int) $srv->PickupPostalLocAddDays;
            $service->deliveryPostalLocAddDays = (int) $srv->DeliveryPostalLocAddDays;
            $service->deliveryDate = (string) $srv->DeliveryDate;
            $service->deliveryTime = (string) $srv->DeliveryTime;
            $service->dimensionalWeight = (float) $srv->DimensionalWeight;
            $service->weightUnit = (string) $srv->WeightUnit;
            $service->pickupDayOfWeekNum = (int) $srv->PickupDayOfWeekNum;
            $service->destinationDayOfWeekNum = (int) $srv->DestinationDayOfWeekNum;

            $dhlCapabilityResponse->services[] = $service;
        }

        return $dhlCapabilityResponse;
    }

}

?>
