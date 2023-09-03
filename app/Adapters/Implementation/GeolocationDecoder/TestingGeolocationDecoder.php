<?php

namespace App\Adapters\Implementation\GeolocationDecoder;

use App\Adapters\IGeolocationDecoder;
use App\Types\GeolocationType;

class TestingGeolocationDecoder implements IGeolocationDecoder
{

    public function geocode(string $address): GeolocationType
    {
        $geolocationType = new GeolocationType();
        $geolocationType
            ->setLatitude("30.033333")
            ->setLongitude("31.233334");
        return $geolocationType;
    }

}
