<?php

/**
 * Weather API interface.
 *
 * @author Daniel Kleebinder
 */
class Weather {

    public $zipCode;
    public $response;

    public function __construct($zipCode) {
        $this->zipCode = $zipCode;
        $this->getResponse();
    }

    public function getResponse() {
        $url = "http://wsf.cdyne.com/WeatherWS/Weather.asmx/GetCityForecastByZIP";
        $url .= "?ZIP=" . $this->zipCode;
        $this->response = simplexml_load_file($url) or die("ERROR");
    }

}
