<?php

class DHLService {

    public $globalProductCode;
    public $localProductCode;
    public $productShortName;
    public $localProductName;
    public $networkTypeCode;
    public $pOfferedCustAgreement;
    public $transInd;
    public $pickupDate;
    public $pickupCutoffTime;
    public $bookingTime;
    public $totalTransitDays;
    public $pickupPostalLocAddDays;
    public $deliveryPostalLocAddDays;
    public $pickupNonDHLCourierCode;
    public $deliveryNonDHLCourierCode;
    public $deliveryDate;
    public $deliveryTime;
    public $dimensionalWeight;
    public $weightUnit;
    public $pickupDayOfWeekNum;
    public $destinationDayOfWeekNum;

    public function getBookingTime() {
        if(!strstr('H', $this->bookingTime))
            return DateTime::createFromFormat('\P\TH\H', $this->bookingTime)->format('H:i:s');
        else
            return DateTime::createFromFormat('\P\TH\Hi\M', $this->bookingTime)->format('H:i:s');
    }
    
    public function getPickupCutOffTime() {
        if(!strstr('H', $this->pickupCutoffTime))
            return DateTime::createFromFormat('\P\TH\H', $this->pickupCutoffTime)->format('H:i:s');
        else
            return DateTime::createFromFormat('\P\TH\Hi\M', $this->pickupCutoffTime)->format('H:i:s');
    }
}

?>
