<?php

namespace App\Adapters;

use App\Types\GeolocationType;

interface IGeolocationDecoder
{

    public function geocode(string $address): GeolocationType;

}
