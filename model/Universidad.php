<?php
/**
 * Clase que crea y utiliza usuarios en la aplicación.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 01/02/2022
 * @version 2.0
 */
class Universidad {
    private $name;
    private $country;
    private $website;
    private $code;
    private $state_province;

    function __construct($name, $country, $website, $code, $state_province) {
        $this->name = $name;
        $this->country = $country;
        $this->website = $website;
        $this->code = $code;
        $this->state_province = $state_province;
    }
    
    function getName() {
        return $this->name;
    }

    function getCountry() {
        return $this->country;
    }

    function getWebsite() {
        return $this->website;
    }

    function getCode() {
        return $this->code;
    }

    function getState_province() {
        return $this->state_province;
    }
}