<?php

/**
 * This is the model class "Consignee".
 */
class Consignee
{
    public $name;
    public $city;
    public $postalCode;
    public $countryCode;
    
    public function Consignee($name, $city, $postalCode, $countryCode){
        $this->name = $name;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }
}