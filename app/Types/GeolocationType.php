<?php

namespace App\Types;

class GeolocationType
{

    private ?string $latitude = null;
    private ?string $longitude = null;

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }


}
