<?php

/**
 * This is the model class "Shipper".
 */
class Shipper extends CModel
{
    public $name;
    public $referenceId;
    public $city;
    public $divisionCode;
    public $postalCode;
    public $countryCode;
    
    public function Shipper($name, $referenceId, $city, $divisionCode, $postalCode, $countryCode){
        $this->name = $name;
        $this->referenceId = $referenceId;
        $this->city = $city;
        $this->divisionCode = $divisionCode;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }
    
    public function attributeNames() {
        return array();
    }
}