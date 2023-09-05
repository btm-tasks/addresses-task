<?php

namespace App\Adapters\Implementation\GeolocationDecoder;

use App\Adapters\IGeolocationDecoder;
use App\Types\GeolocationType;
use Faker\Generator;

class TestingGeolocationDecoder implements IGeolocationDecoder
{

    public function geocode(string $address): GeolocationType
    {
        $location = fake()->localCoordinates();

        $geolocationType = new GeolocationType();
        $geolocationType
            ->setLatitude($location["latitude"])
            ->setLongitude($location["longitude"]);
        return $geolocationType;
    }

}
