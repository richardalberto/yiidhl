<?php

/**
 * This is the model class "Shipper".
 */
class Consignee extends CModel
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
    
    public function attributeNames() {
        return array();
    }
}