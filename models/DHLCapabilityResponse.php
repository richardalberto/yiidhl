<?php

/**
 * This is the model class "DHLCapabilityResponse".
 */
class DHLCapabilityResponse
{
    public $services = array();
    
    public function hasServices(){
        return count($this->services) > 0;
    }
    
    public function getServiceByLocalProductCode($code){
        foreach($this->services as $service){
            if($service->localProductCode == $code) return $service;
        }
    }
}